<?php
// Start session
session_start();

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password using MD5
    $hashed_password = md5($password);

    // Prepare and execute SQL statement
    $sql = "SELECT id, username, password FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if a matching user was found
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        // Set session variables
        $_SESSION['username'] = $db_username;
        $_SESSION['user_id'] = $id;

        // Redirect to the admin page
        header("Location: ./admin/admin.html");
        exit();
    } else {
        echo "Incorrect username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
