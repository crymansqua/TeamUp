<?php
// Include the database connection file
include('db_connection.php');

// Initialize an array to store error messages
$errors = array();

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate login credentials
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare a select statement to fetch user data based on email
    $sql = "SELECT user_id, email, password FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);

            // Check if email exists, if yes then verify password
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $user_id, $email, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    // Verify password
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["email"] = $email;

                        // Redirect user to welcome page
                        header("location: dashboard.php");
                    } else {
                        // Password is not valid, set error message
                        $errors['password'] = "The password you entered is incorrect.";
                    }
                }
            } else {
                // Email doesn't exist, set error message
                $errors['email'] = "No account found with that email.";
            }
        } else {
            // Error executing the statement, set error message
            $errors['database'] = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login - Team Up</title>
    <meta name="description" content="" />
    <meta name="theme-color" content="#000000"/>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <!-- Content -->
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login form -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <span style="color: #9055fd">
                                    <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Your logo SVG content -->
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">Team Up Login</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-2">
                        <h4 class="mb-2">Welcome to Team up! 👋</h4>
                        <p class="mb-4">Please sign-in to pay</p>
                        <form id="formAuthentication" class="mb-3" action="" method="post">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email" autocomplete="off" autofocus required/>
                                <label for="email">Email or Username</label>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="off"  required/>
                                        <label for="password">Password</label>
                                    </div>
                                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                <a href="forgot-password.html" class="float-end mb-1">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="register.php">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- / Login form -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery and other necessary scripts -->
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    </script>
</body>
</html>
