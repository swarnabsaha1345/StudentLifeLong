<?php 
    require_once 'database-connection.php';
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    $department_id = $_SESSION['department_id'];
    $qury = "SELECT * FROM department WHERE department_id = '".$department_id."'";
    if($result=$mysqli->query($qury)){
        if(mysqli_num_rows($result)>0){
            $row = $result->fetch_assoc();
            $department_name = $row['department_name'];
            if($department_name == 'Admin'){
                require_once 'admin-header.php';
            }   
            else if($department_name == 'Admission'){
                require_once 'admission-header.php';
            }   
            else if($department_name == 'HR'){
                require_once 'hr-header.php';
            }
            else if($department_name == 'Finance'){
                require_once 'finance-header.php';
            }    
        }
    }
    $admission_id = $_POST['suggestions'];
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    $qury = "SELECT admission.admission_id,admission.admission_date,student.student_name,
    course.course_name FROM admission,student,course WHERE admission.student_id = 
    student.student_id AND student.course_id = course.course_id";
    if($result=$mysqli->query($qury)){
        if(mysqli_num_rows($result)>0){
            $row = $result->fetch_assoc();
        }
    }
?>

<!-- Navber content -->
<div class="d-flex justify-content-center mt-5">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb nav-bread">
        <?php
            if($department_name == 'Admin'){
                echo '
                <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>';
            }   
            else if($department_name == 'Admission'){
                echo '
                <li class="breadcrumb-item"><a href="admission-index.php">Home</a></li>';
            } 
            else if($department_name == 'HR'){
                echo '
                <li class="breadcrumb-item"><a href="hr-index.php">Home</a></li>';
            } 
            else if($department_name == 'Finance'){
                echo '
                <li class="breadcrumb-item"><a href="finance-index.php">Home</a></li>';
            }
        ?>
        <li class="breadcrumb-item active" aria-current="page">Search Admission</li>
    </ol>
    </nav>
</div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-8 form-bg">
                <div class="mb-3">
                    <h4 class="text-center field-top">Admission</h4>
                </div>
                <div class="mb-1">
                    <label class="form-label" for=""><b>Admission No :</b>  
                    <span><?php echo $row['admission_id'];?></span></label>
                </div>
                <div class="mb-1">
                    <label class="form-label" for=""><b>Admission Date :</b>
                    <span><?php echo $row['admission_date'];?></span></label>
                </div>
                <div class="mb-1">
                    <label class="form-label" for=""><b>Student Name :</b> 
                    <span><?php echo $row['student_name'];?></span></label>
                </div>
                <div class="mb-1">
                    <label class="form-label" for=""><b>Course Name :</b>
                    <span><?php echo $row['course_name'];?></span></label>
                </div>
                <div class="text-center">
                    <?php
                        if($department_name == 'Admin'){
                            echo '<a class="btn btn-danger" href="admin-index.php">Exit</a>';
                        }   
                        else if($department_name == 'Admission'){
                            echo '<a class="btn btn-danger" href="admission-index.php">Exit</a>';
                        } 
                        else if($department_name == 'HR'){
                            echo '<a class="btn btn-danger" href="hr-index.php">Exit</a>';
                        }
                        else if($department_name == 'Finance'){
                            echo '<a class="btn btn-danger" href="finance-index.php">Exit</a>';
                        }   
                    ?> 
                </div>
            </div>
        </div>      
    </div>
<?php 
    if($department_name == 'Admin'){
        require_once 'admin-footer.php';
        echo '
        <script>
            document.getElementById("admin-title").innerHTML = 
            "Student LifeLong | Search Admission";
        </script>'; 
    }   
    else if($department_name == 'Admission'){
        require_once 'admission-footer.php';
        echo '
        <script>
            document.getElementById("admission-title").innerHTML = 
            "Student LifeLong | Search Admission";
        </script>'; 
    }
    else if($department_name == 'HR'){
        require_once 'hr-footer.php';
        echo '
        <script>
            document.getElementById("hr-title").innerHTML = "Student LifeLong | Search Admission";
        </script>'; 
    }
    else if($department_name == 'Finance'){
        require_once 'finance-footer.php';
        echo '
        <script>
            document.getElementById("finance-title").innerHTML = 
            "Student LifeLong | Search Admission";
        </script>'; 
    }  
    mysqli_close($mysqli);
?>