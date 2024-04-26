##Introduction

The "Team Up" project is a collaborative platform designed to facilitate team formation and collaboration in cybersecurity projects. It provides a centralized space for individuals and organizations to connect, collaborate, and form project teams. The platform aims to enhance collaboration and project outcomes by offering a user-friendly interface and robust skill-matching algorithms tailored to the cybersecurity domain.

##Database Structure:

The database schema consists of the following tables
 projects: Stores information about projects, including title, description, start date, end date, creator ID, and creation timestamp.
 project_members: Maps project IDs to user IDs, indicating which users are members of each project.
 project_skills: Links projects to specific skills required for each project, including the proficiency level required for each skill.
 skills: Contains a list of skills along with their IDs and names.
 users: Stores user information, including user ID, username, email, password, and creation timestamp.
 user_skills: Associates users with their skills and proficiency levels.

##Setting Up XAMPP and phpMyAdmin for the "Team Up" Project Step 1: Installing XAMPP
1. DownloadXAMPP:GototheApacheFriendswebsiteanddownloadtheXAMPP installer suitable for your operating system (Windows, macOS, or Linux).
2. Installation:Runthedownloadedinstallerandfollowtheon-screeninstructions. Choose the components you want to install, including Apache, MySQL, PHP, and phpMyAdmin.
3. Configuration:Duringinstallation,youmayneedtoconfigureportsforApache and MySQL to avoid conflicts with other applications. By default, Apache uses port 80, and MySQL uses port 3306.
4. StartServices:Onceinstalled,starttheApacheandMySQLservicesfromthe XAMPP control panel. Ensure that both services are running.

 Step 2: Setting Up the Database for "Team Up"
1. AccessingphpMyAdmin
● Open your web browser and navigate to http://localhost/phpmyadmin.
● Log in using the default username root and leave the password field
empty.
2. CreatingtheDatabase
● Click on the "Databases" tab in phpMyAdmin.
● Enter a name for your database, such as teamup, and click "Create". 3. ImportingDatabaseSchema
● If you have a database schema file (SQL file), click on the "Import" tab.
● Choose your SQL file containing the schema for the projects,
project_members, project_skills, skills, users, and user_skills
tables.
● Click "Go" to import the schema into your teamup database.
Configuring the Project
1. DatabaseConnection
● Open the db_connection.php file in your project's directory.
● Update the database connection details ($servername, $username,$password, $database) to match your XAMPP MySQL settings.

## Database Connection
The database connection file (db_connection.php) establishes a connection to the MySQL database using the provided credentials. If the connection fails, an error message is displayed.
## User Interface
The user interface of the "Team Up" platform provides intuitive navigation for users to perform various tasks:
● Dashboard: Users can view and manage their projects, invitations, and profile settings from the dashboard.
● Project Creation: Users can create new projects by providing a title, description, start date, and end date.
● Skill Matching: When creating a project, users can specify the required skills and proficiency levels.
● User Profile: Users can create and update their profiles, including their skills and proficiency levels.
Step 4: Testing the Project
1. AccessingtheApplication:
● Open your web browser and navigate to http://localhost/teamup or the
appropriate URL where your project is located.
● Ensure that the application loads without errors.
2. FunctionalityTesting
● Test various functionalities of the "Team Up" platform, such as creating
projects, adding members, and matching skills.
● Verify that data is being stored and retrieved correctly from the MySQL
database.

 We are using PHP mailer composer to send confirmation mail on
registration. Before running the website you must set your credentials
here:
