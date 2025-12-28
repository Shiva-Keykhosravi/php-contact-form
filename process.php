<?php


// ============================================
// PHP Contact Form Project
// Author: Shiva Keykhosravi
// Description: Handles form submission, server-side validation, 
// and saves messages to a text file on the server.
// This file is part of the learning project for PHP basics.
// ============================================


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Initialize errors array
    $errors = [];
    
    // Validate form fields
    if (empty($name)) { $errors[] = "Name is required"; }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Valid email is required"; }
    if (empty($subject)) { $errors[] = "Subject is required"; }
    if (empty($message)) { $errors[] = "Message is required"; }
    
    // If there are errors, display them
    if (count($errors) > 0) {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        echo "<p><a href='index.html'>Go Back</a></p>";
        exit;
    }

    // Save the message to messages.txt
    $file = "messages.txt";
    $data = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message\n-----------------\n";
    file_put_contents($file, $data, FILE_APPEND);
    
    // Display success message
    echo "<p style='color:green;'>Thank you! Your message has been saved.</p>";
    echo "<p><a href='index.html'>Back to form</a></p>";
}
?>
