<?php
// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header('Location: login.php');
//     exit;
// }
include("db.php");

$count_query = "SELECT COUNT(*) AS user_count FROM users";
$count_result = mysqli_query($conn, $count_query);
$user_count = mysqli_fetch_assoc($count_result)['user_count'];

$student_count_query = "SELECT COUNT(*) AS student_count FROM users WHERE role = 'Student'";
$student_count_result = mysqli_query($conn, $student_count_query);
$student_count = mysqli_fetch_assoc($student_count_result)['student_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tresmagia SmartLock</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"s>
    <!-- Navbar Brand-->
    
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
       
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<br><br>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                     
                    <a class="nav-link" href="usersList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Users
                    </a>
                    
                    <a class="nav-link" href="studentList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Student
                    </a>
                    <a class="nav-link" href="teacherList.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Faculty
                    </a><a class="nav-link" href="attendance.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Attendance
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                  <div class="small">Logged in as: Admin</div>
                <?php //echo $_SESSION['username']; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
        <div class="container-fluid px-4">

<!-- Page Heading -->

    <h1>Dashboard</h1>


<!-- Content Row -->
<div class="row">
    <!-- Active Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body"> 
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Active</div>
                        <div class="h1 mb-0 font-weight-bold text-gray-800">3</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- Number of Users Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Number of Users</div>
                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php echo $user_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Students Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Number of Students</div>
                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php echo $student_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Faculty Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Number of Faculty</div>
                        <div class="h1 mb-0 font-weight-bold text-gray-800">3</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Pending Requests Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</div> 
<div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Recently Logged-in Users
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>User Type</th>
                                    <th>Card UID</th>      
                                    <th>NAME</th>                      
                                    <th>DATE</th>
                                   
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Joanne Barker</td>
                                    <td>May 17, 2024</td>
                                 
                                </tr>
                                <tr>
                                    <td>Faculty</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Charles Preston</td>                        
                                    <td>May 17, 2024</td>
                                    
                                </tr>
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Karol Rowland</td>                                  
                                    <td>May 17, 2024</td>
                                   
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Joanne Barker</td>
                                    <td>May 17, 2024</td>
                                   
                                </tr>
                                <tr>
                                    <td>Faculty</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Charles Preston</td>                        
                                    <td>May 17, 2024</td>
                                   
                                </tr>
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Karol Rowland</td>                                  
                                    <td>May 17, 2024</td>
                                   
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Joanne Barker</td>
                                    <td>May 17, 2024</td>
                                    
                                </tr>
                                <tr>
                                    <td>Faculty</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Charles Preston</td>                        
                                    <td>May 17, 2024</td>
                                    
                                </tr>
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Karol Rowland</td>                                  
                                    <td>May 17, 2024</td>
                                    
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Joanne Barker</td>
                                    <td>May 17, 2024</td>
                                   
                                </tr>
                                <tr>
                                    <td>Faculty</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Charles Preston</td>                        
                                    <td>May 17, 2024</td>
                                    
                                </tr>
                                <tr>
                                    <td>Student</td>
                                    <td>C4R03XAM4P1E</td>        
                                    <td>Karol Rowland</td>                                  
                                    <td>May 17, 2024</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






<!-- End of Main Content -->
            
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; SmartLock 2024</div>
                    <div>
                    <a href="aboutus.php">About Us</a>
                        &middot;
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
