<?php
// Database configuration
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "contact_form_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT * FROM useradd";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixels Photography Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="./admin.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="./view.php"><i class="fas fa-users"></i> Users View</a></li>
                <li><a href="./add.html"><i class="fas fa-user-plus"></i> Users Add</a></li>
                <li><a href="./message.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="#" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>PRECIOUS MEMORIES PHOTOGRAPHY</h1>
            <h2>Users Details</h2>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['mobile'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>
                                    <a href='edit.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </table>

            <div class="copyright">
                &copy; Pixels Photography
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();

        let confirmation = confirm("Do you really want to logout?");

        if (confirmation) {
            window.location.href = './login.html'; // Redirect to login.html
        }
    });
</script>
</html>

<?php
$conn->close();
?>
