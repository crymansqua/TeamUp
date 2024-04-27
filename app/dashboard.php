<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Team Up</title>

    <meta name="description" content="" />
    <meta name="theme-color" content="#000000"/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
    
    
<style>
        
/* Unique CSS for styling the page */

/* Adjusting card layout */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

/* Styling card titles */
.card-title {
    color: #333;
    font-size: 1.2rem;
    font-weight: bold;
}

/* Styling card bodies */
.card-body {
    padding: 20px;
    flex-grow: 1;
}

/* Adding background and padding to the container */
.container-xxl {
    background-color: #f9f9f9;
    padding: 20px;
}

/* Styling the row */
.row {
    margin: 0 -15px;
    display: flex;
    flex-wrap: wrap;
}

/* Styling individual columns */
.col-md-12,
.col-lg-6 {
    padding: 0 15px;
    flex: 1 1 50%;
}

/* Styling user info cards */
.user-info-card {
    margin-bottom: 20px;
}

/* Styling the refresh button */
.btn-primary {
    background-color: #804be1;
    border-color: #804be1;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: #fff;
}

/* Styling the triangle images */
.card img {
    position: absolute;
    bottom: -10px;
    right: -10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}


    </style>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php
        session_start();
        include 'db_connection.php'; // Include your database connection file

        if (!isset($_SESSION['email'])) {
            header("Location: index.php");
            exit();
        }

        // Fetch user details from the database
        $email = $_SESSION['email'];
        $user_query = "SELECT * FROM users WHERE email='$email'";
        $user_result = mysqli_query($conn, $user_query);
        $user_data = mysqli_fetch_assoc($user_result);
        ?>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo me-1">
                <span style="color: var(--bs-primary)">
                  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="white"
                      fill-opacity="0.15" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="white"
                      fill-opacity="0.3" />
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-semibold ms-2">Team Up</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Dashboard</div>
              </a>
            </li>

            <!-- Pages -->
            <li class="menu-item">
    <a href="add_skill.php" class="menu-link">
        <i class="menu-icon tf-icons mdi "></i>
        <div data-i18n="Account Settings">Add Skills</div>
    </a>
</li>


            </li>
            <li class="menu-item">
              <a href="rate_skills.php" class="menu-link">
                <i class="menu-icon tf-icons mdi "></i>
                <div data-i18n="Authentications">Rate skills</div>
              </a>
            </li>

            </li>
            <li class="menu-item">
              <a href="add_project.php" class="menu-link">
                <i class="menu-icon tf-icons mdi "></i>
                <div data-i18n="Authentications">Create Project</div>
              </a>
            </li>

            <!-- Billing -->
            <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Account Settings</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="reset_password.html" class="menu-link">
                <i class="menu-icon tf-icons mdi "></i>
                <div data-i18n="Basic">Reset Password</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="delete_account.php" class="menu-link" >
                <i class="menu-icon tf-icons "></i>
                <div data-i18n="Basic">Delete Account</div>
              </a>
            </li>
            

            <!-- Misc -->
            <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Groups</span></li>
            <li class="menu-item">
              <a
                href="view_groups.php"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons mdi"></i>
                <div data-i18n="Support">View Groups</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="invite_users.php"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons mdi"></i>
                <div data-i18n="Support">Join Groups</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="mdi mdi-magnify mdi-24px lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none bg-body"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                      <a class="dropdown-item pb-2 mb-1" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2 pe-1">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0"><?php echo isset($user_data['username']) ? $user_data['username'] : 'Not provided'; ?></h6>
                            <small class="text-muted">user</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 mdi mdi-credit-card-outline me-1 mdi-20px"></i>
                          <span class="flex-grow-1 align-middle ms-1">Billing</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout.php">
                        <i class="mdi mdi-power me-1 mdi-20px"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
<!-- Include database connection file -->
<?php include('db_connection.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
        <div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-1"><?php echo isset($user_data['username']) ? $user_data['username'] : 'Name Not Provided'; ?>!</h4>
            <p class="pb-0" id="greeting"></p>
            <form action="upload_resume.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" name="resume" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Upload Resume</button>
            </form>
        </div>
        <img src="assets/img/icons/misc/triangle-light.png" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background" data-app-light-img="icons/misc/triangle-light.png" data-app-dark-img="icons/misc/triangle-dark.png" />
    </div>
</div>





            <div class="col-md-12 col-lg-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Projects Tailored for You</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch projects that require skills the user possesses
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT p.title, p.description, p.start_date, p.end_date FROM projects p 
                                INNER JOIN project_skills ps ON p.project_id = ps.project_id
                                INNER JOIN user_skills us ON ps.skill_id = us.skill_id
                                WHERE us.user_id = ? AND us.proficiency_level >= ps.proficiency_level_required";
                        
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // Check if there are any projects
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each project
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['start_date'] . "</td>";
                                echo "<td>" . $row['end_date'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No projects found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Projects</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch projects from the database
                                    $sql = "SELECT * FROM projects";
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are any projects
                                    if (mysqli_num_rows($result) > 0) {
                                        // Output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['title'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['start_date'] . "</td>";
                                            echo "<td>" . $row['end_date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No projects found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Skills Display Container -->
        <div class="row gy-4">
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Skills</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch user's skills from the database
                        $sql = "SELECT skill_name FROM user_skills INNER JOIN skills ON user_skills.skill_id = skills.skill_id WHERE user_id = ? LIMIT 4";
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            $user_id = $user_data['user_id'];
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($result) > 0) {
                                echo "<ul>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<li>" . $row['skill_name'] . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "No skills found.";
                            }
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Resume Display Container -->
        <div class="row gy-4">
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Resume</h4>
                    </div>
                    <div class="card-body">
                    <?php
                $stmt = $conn->prepare("SELECT resume_path FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($resume_location);
                $stmt->fetch();
                $stmt->close();
if($resume_location != NULL){
  echo "<tr><td colspan='4'><a href='$resume_location'>Click to View RESUME</a></td></tr>";
}else{
                // Output a link to the resume file
                echo "<tr><td colspan='4'><span  style='color: red;'>NO RESUME UPLOADED!</span></td></tr>";
}

                ?>

                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>






            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                  <div class="text-body mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>.
                    All rights reserved. <span class="text-danger"><i class=""></i></span>
                    <a href="https://codewithkim.com" target="_blank" class="footer-link fw-medium"
                      >Team Up</a
                    >
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="" class="footer-link me-3" target="_blank">docs</a>
                    <a href="https://twitter.com/codewithkim" target="_blank" class="footer-link me-3">X</a>

                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->
<!--Greet user -->

<script>
    var today = new Date();
    var hour = today.getHours();

    var greeting;

    if (hour < 12) {
        greeting = "Good morning!";
    } else if (hour < 18) {
        greeting = "Good afternoon!";
    } else {
        greeting = "Good evening!";
    }

    document.getElementById("greeting").innerText = greeting;
</script>

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
