<?php
include('db_connection.php');

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $creator_id = $_SESSION["user_id"]; // Assuming user is logged in and session is set

    // Insert project into the database
    $sql = "INSERT INTO projects (title, description, start_date, end_date, creator_id) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $start_date, $end_date, $creator_id);
        if (mysqli_stmt_execute($stmt)) {
            // Project added successfully
            $project_id = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);

            // Redirect to add_project_skills.php to add project skills
            header("location: dashboard.php");
            exit();
        } else {
            // Error adding project
            echo "Error adding project: " . mysqli_error($conn);
        }
    } else {
        // Error preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
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
    <title>Add Project - Team Up</title>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
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
    <div class="container">
        <h2>Add Project</h2>
        <form method="post" action="add_project.php">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <!-- You can add more fields as needed -->
            <button type="submit" class="btn btn-primary">Add Project</button>
        </form>
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
