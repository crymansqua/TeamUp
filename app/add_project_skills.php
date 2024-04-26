<?php
// Include the database connection file
include('db_connection.php');

// Initialize an array to store error messages
$errors = array();

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve project details from the form
    $project_id = $_POST["project_id"];
    $skills = $_POST["skills"]; // Array of skill IDs
    $proficiency_levels = $_POST["proficiency_levels"]; // Array of proficiency levels

    // Validate project ID
    if (empty($project_id)) {
        $errors['project_id'] = "Project ID is required.";
    }

    // Validate skills and proficiency levels
    if (empty($skills) || empty($proficiency_levels)) {
        $errors['skills'] = "At least one skill must be selected.";
    } elseif (count($skills) !== count($proficiency_levels)) {
        $errors['skills'] = "Number of skills and proficiency levels should match.";
    } else {
        // Insert project skills into the database
        $query = "INSERT INTO project_skills (project_id, skill_id, proficiency_level_required) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters and execute the statement for each skill
            for ($i = 0; $i < count($skills); $i++) {
                mysqli_stmt_bind_param($stmt, "iii", $project_id, $skills[$i], $proficiency_levels[$i]);
                mysqli_stmt_execute($stmt);
            }

            // Check if any errors occurred during insertion
            if (mysqli_stmt_error($stmt)) {
                $errors['database'] = "Error inserting project skills: " . mysqli_stmt_error($stmt);
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
    <title>Add Project Skills - Team Up</title>
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
                <!-- Project Skills Addition Form -->
                <div class="container">
                    <h2>Add Project Skills</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <div class="mb-3">
    <label for="project" class="form-label">Project:</label>
    <select class="form-select" id="project" name="project_id" required>
        <option value="">Select a Project</option>
        <!-- Fetch project ID and name from the database -->
        <?php
            // Include the database connection file
            include('db_connection.php');

            // Fetch projects from the database
            $sql = "SELECT project_id, title FROM projects";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['project_id'] . "'>" . $row['title'] . "</option>";
                }
            } else {
                echo "<option value=''>No projects found</option>";
            }

            // Close database connection
            mysqli_close($conn);
        ?>
    </select>
</div>


                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills:</label>
                            <select multiple class="form-select" id="skills" name="skills[]" required>
                                <!-- Populate skills from database -->
                                <?php
                                    // Include the database connection file
                                    include('db_connection.php');

                                    // Fetch skills from the database
                                    $sql = "SELECT skill_id, skill_name FROM skills";
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
                            <label for="proficiency_levels" class="form-label">Proficiency Levels:</label>
                            <input type="number" class="form-control" id="proficiency_levels" name="proficiency_levels[]" placeholder="Enter proficiency level for each skill" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Project Skills</button>
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
