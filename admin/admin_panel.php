<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $imagePath = 'img/' . $_FILES['image']['name'];

    // Move uploaded file to the server
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Insert into database
        $sql = "INSERT INTO photos (title, description, image_path, category) VALUES ('$title', '$description', '$imagePath', '$category')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p>Failed to upload image.</p>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload Photo</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <nav class="navbar">
        <!-- Navigation code -->
    </nav>

    <div class="container">
        <h1>Upload New Photo</h1>
        <form action="admin_panel.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="web">Web</option>
                    <option value="logo">Logo</option>
                    <option value="mobile">Mobile</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="button">Submit</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Pixels. All rights reserved.</p>
    </footer>
</body>







<script>
   document.getElementById('logout').addEventListener('click', function(event) {
    event.preventDefault();

    let confirmation = confirm("Do you really want to logout?");

    if (confirmation) {
        window.location.href = 'login.html'; // Redirect to login.html
    }
});
// JavaScript for the file upload input
const fileInput = document.getElementById('fileInput');
const chooseFileButton = document.getElementById('chooseFileButton');

chooseFileButton.addEventListener('click', () => {
  fileInput.click();
});

fileInput.addEventListener('change', () => {
  const fileName = fileInput.files[0].name;
  chooseFileButton.textContent = fileName;
});






</script>
</html>