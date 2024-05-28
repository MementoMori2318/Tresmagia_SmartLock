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
    <style>
        .btn-open-popup {
            padding: 12px 24px;
            font-size: 18px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-open-popup:hover {
            background-color: #4caf50;
        }

        .overlay-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup-box {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            width: 320px;
            text-align: center;
            opacity: 0;
            transform: scale(0.8);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #444;
            text-align: left;
        }

        .form-input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-submit,
        .btn-close-popup {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-submit {
            background-color: green;
            color: #fff;
        }

        .btn-close-popup {
            margin-top: 12px;
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-submit:hover,
        .btn-close-popup:hover {
            background-color: #4caf50;
        }

        /* Keyframes for fadeInUp animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation for popup */
        .overlay-container.show {
            display: flex;
            opacity: 1;
        }
    </style>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
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
                    </a></a> <a class="nav-link" href="schedule.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Schedule
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="mt-4">Add Schedule</h1>
                    <button class="btn-open-popup" onclick="togglePopupSubject()"> 
                       Add Subject 
                    </button>   
                    <button class="btn-open-popup" onclick="togglePopupSection()"> 
                       Add Section 
                    </button>   
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Add Schedule
                    </div>
                    <div class="card-body">
                        <form action="action_page.php" method="POST">
                            <div class="form-floating mb-3">
                                <select class="form-select form-control" aria-label="Default select example" id="inputDayOfWeek" name="week">
                                    <option value="student">Monday</option>
                                    <option value="staff">Tuesday</option>
                                    <option value="faculty">Wednesday</option>
                                    <option value="student">Thursday</option>
                                    <option value="staff">Friday</option>
                                    <option value="faculty">Saturday</option>
                                    <option value="faculty">Sunday</option>
                                </select>
                                <label for="inputDayOfWeek">Day of Week</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputStartTime" name="inputStartTime" type="time" placeholder="8:00" value="" />
                                        <label for="inputStartTime">Start Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputEndTime" name="inputEndTime" type="time" placeholder="8:00" value=""/>
                                        <label for="inputEndTime">End Time</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSubject" name="subject" type="text" placeholder="subject" />
                                        <label for="inputSubject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSection" name="section" type="text" placeholder="section" />
                                        <label for="inputSection">Section</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Add Schedule</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

<!-- Popup Overlay -->
<div id="popupSubject" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Add Subject</h2>
        <form class="form-container">
            <label class="form-label" for="subject">Subject Name:</label>
            <input class="form-input" type="text" placeholder="Enter Subject Name" id="subject" name="subject" required>
           
            <button class="btn-submit" type="submit">Submit</button>
        </form>
        <button class="btn-close-popup" onclick="togglePopupSubject()">Close</button>
    </div>
</div>
<div id="popupSection" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Add Section</h2>
        <form class="form-container">
            <label class="form-label" for="sectionName">Section Name:</label>
            <input class="form-input" type="text" placeholder="Enter Subject Name" id="sectionName" name="sectionName" required>

            <label class="form-label" for="course">Course Name:</label>
            <input class="form-input" type="text" placeholder="Enter Course Name" id="course" name="course" required>

            <label class="form-label" for="year">Year:</label>
            <input class="form-input" type="text" placeholder="Enter Year" id="year" name="year" required>

            <label class="form-label" for="section">Section:</label>
            <input class="form-input" type="text" placeholder="Enter Section" id="section" name="section" required>
                                   
            <button class="btn-submit" type="submit">Submit</button>
        </form>
        <button class="btn-close-popup" onclick="togglePopupSection()">Close</button>
    </div>
</div>
<script>
    function togglePopupSubject() {
        const overlay = document.getElementById('popupSubject');
        
        overlay.classList.toggle('show');
    }
    function togglePopupSection() {
        const overlay = document.getElementById('popupSection');
        
        overlay.classList.toggle('show');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
