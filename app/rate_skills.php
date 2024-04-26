<?php
// Start the session
session_start();

// Include the database connection file
include('db_connection.php');

// Initialize an array to store error messages
$errors = array();

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from session
    $user_id = $_SESSION["user_id"];

    // Retrieve skill ID and proficiency level from the form
    $skill_id = $_POST["skill_id"];
    $proficiency_level = $_POST["proficiency_level"];

    // Validate skill ID and proficiency level
    if (empty($skill_id)) {
        $errors['skill_id'] = "Skill ID is required.";
    }

    if (empty($proficiency_level)) {
        $errors['proficiency_level'] = "Proficiency level is required.";
    }

    // If no errors, update the user's skill proficiency level in the database
    if (empty($errors)) {
        $sql = "UPDATE user_skills SET proficiency_level = ? WHERE user_id = ? AND skill_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iii", $proficiency_level, $user_id, $skill_id);
            mysqli_stmt_execute($stmt);

            // Check if any errors occurred during update
            if (mysqli_stmt_error($stmt)) {
                $errors['database'] = "Error updating skill proficiency: " . mysqli_stmt_error($stmt);
            } else {
                // Success message
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Skill Updated Successfully',
                            text: 'The proficiency level for the selected skill has been updated.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'dashboard.php';
                        });
                    </script>";
                exit();
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $errors['database'] = "Error preparing SQL statement: " . mysqli_error($conn);
        }
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
    <title>Rate Skills - Team Up</title>
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
                <!-- Skill Rating Form -->
                <div class="container">
                    <h2>Rate Skills</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="skills" class="form-label">Select a Skill:</label>
                            <select class="form-select" id="skills" name="skill_id" required>
                                <option value="">Select a Skill</option>
                                <!-- Fetch user's skills from the database -->
                                <?php
                                    // Fetch user's skills from the database
                                    $user_id = $_SESSION["user_id"];
                                    $sql = "SELECT user_skills.skill_id, skills.skill_name, user_skills.proficiency_level 
                                            FROM user_skills
                                            INNER JOIN skills ON user_skills.skill_id = skills.skill_id
                                            WHERE user_skills.user_id = $user_id";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['skill_id'] . "'>" . $row['skill_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No skills found</option>";
                                    }

                                    // Close database connection
                                    mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="proficiency_level" class="form-label">Proficiency Level:</label>
                            <input type="range" class="form-range" min="1" max="10" id="proficiency_level" name="proficiency_level" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Skill</button>
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
