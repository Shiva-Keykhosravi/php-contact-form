<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    $errors = [];

    if (empty($name)) { $errors[] = "Name is required"; }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Valid email is required"; }
    if (empty($subject)) { $errors[] = "Subject is required"; }
    if (empty($message)) { $errors[] = "Message is required"; }

    if (count($errors) > 0) {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        echo "<p><a href='index.html'>Go Back</a></p>";
        exit;
    }

    // Save message to file
    $file = "messages.txt";
    $data = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message\n-----------------\n";
    file_put_contents($file, $data, FILE_APPEND);

    echo "<p style='color:green;'>Thank you! Your message has been saved.</p>";
    echo "<p><a href='index.html'>Back to form</a></p>";
}
?>
