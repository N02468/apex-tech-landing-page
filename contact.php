<?php
// contact.php - Save this as a separate file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'landingpage');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts(name, email, subject, message) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        if ($stmt->execute()) {
            echo "Message Sent Successfully...";
            // Optional: redirect back to form
            // header("Location: index.html?success=1");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>