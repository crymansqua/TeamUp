<?php
session_start(); // Start the session
include('db_connection.php'); // Include the database connection file

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit;
}

// Fetch all projects and their members from the database
$sql_projects_members = "SELECT p.project_id, p.title AS project_title, u.username AS member_username, pm.user_id AS member_id 
                         FROM projects p 
                         LEFT JOIN project_members pm ON p.project_id = pm.project_id 
                         LEFT JOIN users u ON pm.user_id = u.user_id";
$result_projects_members = mysqli_query($conn, $sql_projects_members);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>All Projects and Members - Team Up</title>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
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
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!-- Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <script src="assets/js/config.js"></script>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <!-- Content -->
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- All Projects and Members Table -->
                <div class="container">
                    <h2>All Projects and Members</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Project ID</th>
                                    <th>Project Title</th>
                                    <th>Member Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result_projects_members && mysqli_num_rows($result_projects_members) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_projects_members)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['project_id'] . "</td>";
                                        echo "<td>" . $row['project_title'] . "</td>";
                                        echo "<td>" . $row['member_username'] . "</td>";
                                        
                                        // Check if the user is a member
                                        $is_member = ($_SESSION["user_id"] == $row['member_id']);
                                        
                                        // Display appropriate action button
                                        echo "<td>";
                                        if ($is_member) {
                                            echo "<button class='btn btn-danger'>Exit</button>";
                                        } else {
                                            echo "<button class='btn btn-success'>Join</button>";
                                        }
                                        echo "</td>";
                                        
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No projects or members found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>
</html>
