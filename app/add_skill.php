<?php
session_start(); // Start the session

include('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $skills = array();
        $proficiency_levels = array();
        $errors = array();

        // Check if skill fields are set and not empty
        for ($i = 1; $i <= 4; $i++) {
            $skill_field_name = "skill" . $i;
            $proficiency_field_name = "proficiency" . $i;

            if (isset($_POST[$skill_field_name]) && !empty(trim($_POST[$skill_field_name]))) {
                // Sanitize input
                $skills[] = trim($_POST[$skill_field_name]);
                // Validate proficiency level and set to default if not provided
                $proficiency_level = isset($_POST[$proficiency_field_name]) ? intval($_POST[$proficiency_field_name]) : 1;
                // Ensure proficiency level is within the range 1-10
                $proficiency_levels[] = max(1, min(10, $proficiency_level));
            }
        }

        // Check if any skills were provided
        if (empty($skills)) {
            $errors['skills'] = "Please provide at least one skill.";
        } else {
            // Insert each skill into the database and associate with the user
            foreach ($skills as $index => $skill_name) {
                // Insert the skill into the database
                $sql = "INSERT INTO skills (skill_name) VALUES (?)";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $skill_name);
                    if (mysqli_stmt_execute($stmt)) {
                        // Get the ID of the last inserted record
                        $last_inserted_skill_id = mysqli_insert_id($conn);

                        // Associate the skill with the user with proficiency level
                        $sql = "INSERT INTO user_skills (user_id, skill_id, proficiency_level) VALUES (?, ?, ?)";
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            mysqli_stmt_bind_param($stmt, "iii", $user_id, $last_inserted_skill_id, $proficiency_levels[$index]);
                            if (!mysqli_stmt_execute($stmt)) {
                                $errors['database'] = "Error associating skill with user.";
                            }
                        } else {
                            $errors['database'] = "Error preparing statement.";
                        }
                    } else {
                        $errors['database'] = "Error adding skill.";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $errors['database'] = "Error preparing statement.";
                }
            }
        }

        // Close connection
        mysqli_close($conn);

        // Redirect back to dashboard if no errors
        if (empty($errors)) {
            header("location: dashboard.php");
            exit;
        }
    } else {
        // If user_id is not set in the session, redirect to login page
        header("location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Skills - Team Up</title>
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
                <!-- Skill Addition Form Container -->
                <div class="row gy-4">
                    <div class="col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Skills</h4>
                            </div>
                            <div class="card-body">
                                <!-- Display errors, if any -->
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?php echo $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Skill Addition Form -->
                                <form method="post" action="add_skill.php">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                        <div class="mb-3">
                                            <label for="skill<?php echo $i; ?>" class="form-label">Skill <?php echo $i; ?>:</label>
                                            <input type="text" class="form-control" id="skill<?php echo $i; ?>" name="skill<?php echo $i; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="proficiency<?php echo $i; ?>" class="form-label">Proficiency Level (1-10) for Skill <?php echo $i; ?>:</label>
                                            <input type="number" class="form-control" id="proficiency<?php echo $i; ?>" name="proficiency<?php echo $i; ?>" min="1" max="10" value="1">
                                        </div>
                                    <?php endfor; ?>
                                    <button type="submit" class="btn btn-primary">Add Skills</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
