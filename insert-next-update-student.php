<?php
    require_once 'database-connection.php';
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    $department_id = $_SESSION['department_id'];
    $qury = "SELECT * FROM department WHERE department_id = '".$department_id."'";
    if($result=$mysqli->query($qury)){
        if(mysqli_num_rows($result)>0){
            $row = $result->fetch_assoc();
            $department_name = $row['department_name'];
        }
    }
    $student_id = $_SESSION['student-id'];
    $mobile = $_POST['mobile'];
    $email = strtolower($_POST['email']);
    $address = ucwords($_POST['address']);
    $qury = "SELECT * FROM student WHERE student_id = '".$student_id."'";
    if($result=$mysqli->query($qury)){
        if(mysqli_num_rows($result)>0){
            $row = $result->fetch_assoc();
            $student_name = $row['student_name'];
            $qury = "SELECT student_mobile FROM student WHERE student_mobile ='".$mobile."' AND NOT 
            student_id = '".$student_id."'";
            if($result=$mysqli->query($qury)){
                if(mysqli_num_rows($result)>0){
                    $_SESSION['message'] = "Mobile number is already registered.";
                    header('location: student-update.php');
                }
                else{
                    $qury = "UPDATE student SET student_mobile = '".$mobile."', student_email = 
                    '".$email."', student_address = '".$address."' WHERE student_id = 
                    '".$student_id."'";
                    if(mysqli_query($mysqli,$qury)){
                        $_SESSION['message'] = $student_name. " is successfully updated.";
                        if($department_name == 'Admin'){
                            header('location: admin-index.php');
                        }
                        else if($department_name == 'Admission'){
                            header('location: admission-index.php');
                        }
                        else if($department_name == 'HR'){
                            header('location: hr-index.php');
                        }
                        else if($department_name == 'Finance'){
                            header('location: finance-index.php');
                        }
                    }
                }
            }
        }
    }
    mysqli_close($mysqli);
?>