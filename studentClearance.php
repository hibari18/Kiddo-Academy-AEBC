<?php    
    include "db_connect.php";

    // $studid = $_POST['txtStudentId'];
    // $studid = '17001'; // debugging purposes... 
    $studids = array();

    if(!isset($_POST['txtStudentId'])){
        $studids = array_column(mysqli_fetch_all(mysqli_query($con, "
            select distinct tblStudentId 
            from   tblStudent s, tblstudenroll se
            where 
                s.tblStudentFlag=1 and 
                s.tblStudentType!='PROMOTED' and
                se.tblStudEnroll_tblStudentId = s.tblStudentId and
                se.tblStudEnroll_tblSchoolYrId=$syid and 
                se.tblStudEnrollClearance is NULL
            "), MYSQLI_ASSOC), 'tblStudentId');
    } else {
        $studentid = $_POST['txtStudentId'];
        // $studentid = '17005'; // debugging purposes... 
        if(mysqli_num_rows(mysqli_query($con, "
            select distinct tblStudentId 
            from   tblStudent s, tblstudenroll se
            where 
                s.tblStudentId=$studentid and
                s.tblStudentFlag=1 and 
                s.tblStudentType!='PROMOTED' and
                se.tblStudEnroll_tblStudentId = s.tblStudentId and
                se.tblStudEnroll_tblSchoolYrId=$syid and 
                se.tblStudEnrollClearance is NULL
        "))>0)
            $studids[] += $studentid;
    }

    // die(var_dump($studids));
    
    function isPaid($account){
        return $account['tblAccPaid'] == 'PAID';
    }

    /* set autocommit to off */
    $con->autocommit(FALSE);

    foreach($studids as $studid){
        // die($studid);


        // check if all fees are paid
        $result = mysqli_query($con, "
            select * from tblAccount 
            where   tblAcc_tblStudentId='$studid' 
            and     tblAccFlag=1");

        // die(var_dump($result->fetch_all(MYSQLI_ASSOC))); // debugging purposes... 

        // count no of fees for student 
        $fee_count = $result->num_rows;
        // count paid fees 
        $paid_count = count(array_filter($result->fetch_all(MYSQLI_ASSOC), "isPaid"));

        // echo $fee_count.' '.$paid_count;

        // if all fees are paid
        if($fee_count == $paid_count){
            // check if student passed 
            $result = mysqli_query($con, "
                select * 
                from    tblgradeave 
                where   tblGenAve_tblStudentId='$studid' 
                and     tblGenAve_tblSchoolYrId='$syid' 
                and     tblGenAveId IN 
                        (
                            select max(tblGenAveId) 
                            from tblgradeave 
                            group by tblGenAve_tblStudentId 
                            order by tblGenAveId desc
                        )
                limit 1
                ");
            
            $row = mysqli_fetch_assoc($result);
            
            if($row['tblGenAveStatus'] == 'PASSED'){
                
                // update clearance to 'Y'
                mysqli_query($con, "
                    update tblstudenroll 
                    set tblStudEnrollClearance='Y'
                    where tblStudEnroll_tblStudentId='$studid'
                    and tblStudEnroll_tblSchoolYrId='$syid'
                ");
                
                // update level
                $current_level = mysqli_fetch_assoc(mysqli_query($con, "select tblStudent_tblLevelId from tblStudent where tblStudentId='$studid' limit 1"))['tblStudent_tblLevelId'];

                $max_level = mysqli_fetch_assoc(mysqli_query($con, "select tblLevelId from tblLevel order by tblLevelId desc limit 1"))['tblLevelId'];

                $next_level = $current_level < $max_level ? $current_level + 1 : $max_level;

                // die(var_dump($current_level, $max_level, $next_level));

                // update student status to 'PROMOTED'
                mysqli_query($con, "
                    update  tblstudent 
                    set tblStudentType='PROMOTED',
                        tblStudent_tblLevelId=$next_level,
                        tblStudent_tblSectionId=NULL
                    where   tblStudentId='$studid' 
                    and     tblStudentFlag=1
                ");

                /* commit transaction */
                if (!$con->commit()) {
                    print("Transaction commit failed\n");
                    exit();
                }

                // echo 'Cleared';

            } else if($row['tblGenAveStatus'] == 'FAILED') {
                // failed
                mysqli_query($con, "
                    update  tblstudent 
                    set tblStudentType='FAILED'
                    where   tblStudentId='$studid' 
                    and     tblStudentFlag=1
                ");
            }
        } else {
            // not fully paid
            // echo 'Not fully paid';
        }
    }

    /* commit transaction */
    if (!$con->commit()) {
        print("Transaction commit failed\n");
        exit();
    }