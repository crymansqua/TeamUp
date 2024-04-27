<?php
session_start(); // Start the session
require 'vendor/autoload.php'; // Include the Composer autoloader

include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded without errors
    if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
        // Allowed file types
        $allowed_types = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/png', 'image/jpeg');

        // Get file type
        $file_type = $_FILES["resume"]["type"];

        // Check if the file type is allowed
        if (in_array($file_type, $allowed_types)) {
            // File destination directory
            $upload_dir = "uploads/";

            // Generate a unique filename
            $file_name = uniqid() . "_" . $_FILES["resume"]["name"];

            // File path
            $file_path = $upload_dir . $file_name;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $file_path)) {
                $email = $_SESSION['email'];
                $stmt = $conn->prepare("UPDATE users SET resume_path = ? WHERE email = ?");
                $stmt->bind_param("ss", $file_path,$email);
                $stmt->execute();
                $stmt->close();    
                // Extract text from the uploaded file
                $resumeText = extractTextFromResume($file_path);

                if ($resumeText !== false) {
                    $skills = extractSkills($resumeText);

                    if ($skills !== false) {
                        // Store the extracted skills in the database
                        storeSkillsInDatabase($skills);

                        // Redirect to dashboard or another page
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        // Error occurred during skills extraction
                        $error_message = "Error extracting skills from the resume!";
                    }
                } else {
                    // Error occurred during text extraction
                    $error_message = "Error extracting text from the uploaded file!";
                }
            } else {
                $error_message = "Error uploading file!";
            }
        } else {
            $error_message = "Only PDF, DOCX, PNG, and JPG files are allowed!";
        }
    } else {
        $error_message = "No file uploaded or an error occurred!";
    }
}

// If there's any error, display it
if (isset($error_message)) {
    echo $error_message;
}

// Function to extract text from resume file
function extractTextFromResume($file_path) {
    $parser = new Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($file_path);
    return $pdf->getText();
}

// Function to extract skills from resume text
function extractSkills($resumeText) {
    // Define the pattern to search for skills
    $pattern = '/\b(?:Programming|Web design|Data analysis)\b/i';

    // Perform a regular expression match
    if (preg_match_all($pattern, $resumeText, $matches)) {
        // Extracted skills found
        return $matches[0];
    } else {
        // No skills found
        return false;
    }
}

// Function to store skills in the database
function storeSkillsInDatabase($skills) {
    global $conn; // Access the database connection variable defined in db_connection.php

    // Loop through skills and insert into database
    foreach ($skills as $skill) {
        // Check if the skill already exists in the database
        $sql = "SELECT * FROM skills WHERE skill_name = '$skill'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            // Insert the skill into the database if it doesn't exist
            $sql = "INSERT INTO skills (skill_name) VALUES ('$skill')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error inserting skill: " . $conn->error;
            }
        }
    }
}
?>
