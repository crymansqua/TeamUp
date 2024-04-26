<?php
session_start(); // Start the session
include('db_connection.php'); // Include the database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $project_id = $_POST["project_id"];
        $selected_users = $_POST["users"];

        // Add selected users to the project
        foreach ($selected_users as $user_id_to_add) {
            $sql_add_member = "INSERT INTO project_members (project_id, user_id) VALUES (?, ?)";
            if ($stmt_add_member = mysqli_prepare($conn, $sql_add_member)) {
                mysqli_stmt_bind_param($stmt_add_member, "ii", $project_id, $user_id_to_add);
                mysqli_stmt_execute($stmt_add_member);
                mysqli_stmt_close($stmt_add_member);
            } else {
                die("Error preparing statement: " . mysqli_error($conn));
            }
        }

        // Redirect back to the project page
        header("location: project.php?project_id=" . $project_id);
        exit;
    } else {
        // If user is not logged in, redirect to login page
        header("location: login.php");
        exit;
    }
}

// Fetch projects from the database
$sql_projects = "SELECT project_id, title FROM projects";
$result_projects = mysqli_query($conn, $sql_projects);

// Fetch users not already in the project
$sql_users = "SELECT user_id, username FROM users WHERE user_id NOT IN (SELECT user_id FROM project_members WHERE project_id = ?)";
if ($stmt_users = mysqli_prepare($conn, $sql_users)) {
    mysqli_stmt_bind_param($stmt_users, "i", $project_id);
    mysqli_stmt_execute($stmt_users);
    $result_users = mysqli_stmt_get_result($stmt_users);
    mysqli_stmt_close($stmt_users);
} else {
    die("Error preparing statement: " . mysqli_error($conn));
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Members to Project Group - Team Up</title>
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
                <!-- Add Members to Project Group Form -->
                <div class="container">
                    <h2>Add Members to Project Group</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="project" class="form-label">Select a Project:</label>
                            <select class="form-select" id="project" name="project_id" required>
                                <option value="">Select a Project</option>
                                <?php
                                // Display projects as options
                                if ($result_projects && mysqli_num_rows($result_projects) > 0) {
                                    while ($row_project = mysqli_fetch_assoc($result_projects)) {
                                        echo "<option value='" . $row_project['project_id'] . "'>" . $row_project['title'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No projects found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="users" class="form-label">Select Users to Add:</label>
                            <select class="form-select" id="users" name="users[]" required multiple>
                                <?php
                                // Display users as options
                                if ($result_users && mysqli_num_rows($result_users) > 0) {
                                    while ($row_user = mysqli_fetch_assoc($result_users)) {
                                        echo "<option value='" . $row_user['user_id'] . "'>" . $row_user['username'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No users found</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Members</button>
                    </form>
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