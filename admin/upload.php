<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form_db";  // Correct database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // File upload handling
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if (file_exists("images/")) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO portfolio (title, category, image, description) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $category, $image, $description);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to upload image. Check directory permissions and file path.";
        }
    } else {
        echo "Directory 'images/' does not exist.";
    }
}

// Close connection
$conn->close();
?>
