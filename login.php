<?php
// session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     require_once 'db.php'; // Include the database connection file

//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Prepare and execute SQL statement
//     $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
//     $stmt->bindParam(':email', $email);
//     $stmt->execute();

//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user) {
//         if (password_verify($password, $user['password'])) {
//             $_SESSION['loggedin'] = true;
//             $_SESSION['username'] = $user['username'];
//             header('Location: studentList.php');
//             exit;
//         } else {
//             $login_error = true;
//         }
//     } else {
//         $login_error = true;
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            
                            <div class="card-header">
                                <h1 class="text-center fw-bold my-4">SmartLock</h1>
                                <h5 class="text-center  my-2">Login</h5></div>
                            <div class="card-body">
                                <!-- <form method="post" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> -->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com"  />
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password"  />
                                        <label for="inputPassword">Password</label>
                                    </div>
                                     <!-- if(isset($login_error) && $login_error === true):  -->
                                        <!-- <div class="alert alert-danger" role="alert">Invalid email or password.</div> -->
                                    <?php //endif; ?>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button id="loginButton" href="studentList.php" type="submit" class="btn btn-primary">Login</button>
                                        
                                    </div>
                                <!-- </form> -->
                            </div>
                            <!-- <div class="card-footer text-center py-3">
                                <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
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
</body>
</html>
<script>
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = 'studentList.php';
    });
</script>