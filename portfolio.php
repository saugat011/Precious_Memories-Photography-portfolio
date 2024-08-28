<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM portfolio";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixels Photography - Portfolio</title>
  <style>
    *{
    margin: 0;
    padding: 0;
    /* overflow-x: hidden; */
}
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}
/* Navbar styling */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background-color: #333;
}

.logo {
    color: #fff;
    font-size: 24px;
    font-weight: bold;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links li a {
    color: #fff;
    text-decoration: none;
    padding: 8px 15px;
    transition: background-color 0.3s;
}

.nav-links li a:hover {
    background-color: #555;
    border-radius: 5px;
}

/* Hamburger menu styling */
.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.hamburger .bar {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 4px 0;
    transition: all 0.3s;
}

/* Responsive styling */
@media (max-width: 768px) {
    .nav-links {
        position: absolute;
        right: 0;
        top: 60px;
        background-color: #333;
        width: 100%;
        height: calc(100vh - 60px);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    .nav-links.active {
        transform: translateX(0%);
    }

    .hamburger {
        display: flex;
    }

    .hamburger.active .bar:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.active .bar:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active .bar:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }
}

/* Main content styling */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

p {
    line-height: 1.5;
    margin-bottom: 20px;
}

/* Portfolio section styling */
.portfolio-section {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 40px;
}

.portfolio-item {
    width: 300px;
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.portfolio-item img {
    width: 100%;
    height: auto;
}

.portfolio-item .caption {
    padding: 10px;
}

.portfolio-item .caption h3 {
    margin-top: 0;
    margin-bottom: 5px;
}

.portfolio-item .caption p {
    margin-bottom: 0;
}

/* Portfolio navigation styling */
.portfolio-nav {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.portfolio-nav button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 0 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.portfolio-nav button:hover {
    background-color: #3e8e41;
}

/* Filterable gallery styling */
.box {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    flex-wrap: wrap;
}

.store-item {
    width: 300px;
    padding: 1rem;
}

.store-item img {
    width: 100%;
    display: block;
    box-shadow: 7px 7px 20px rgba(0, 0, 0, 0.2);
}

/* Media query for gallery items */
@media (max-width: 768px) {
    .store-item {
        width: 100%;
        margin: 10px 0;
    }
}
/* Container styling */
.container {
width: 100%;
margin: 0 auto;
text-align: center;
padding: 20px;
background-color: #f4f4f4;
border-radius: 10px;
}

/* Menu buttons */
.menu {
display: inline-block;
margin: 10px 0;
}

.menu .btn {
text-decoration: none;
color: #fff;
background-color: #007bff;
padding: 10px 20px;
border-radius: 5px;
margin: 0 10px;
font-size: 16px;
font-weight: bold;
transition: background-color 0.3s, transform 0.3s;
display: inline-block;
cursor: pointer;
}

/* Hover effect */
.menu .btn:hover {
background-color: #0056b3;
transform: scale(1.05);
}

/* Active state */
.menu .btn:active {
background-color: #003f7f;
transform: scale(0.95);
}

/* Active button style */
.menu .btn.active {
background-color: #28a745;
}

/* Responsive design */
@media (max-width: 600px) {
.menu .btn {
display: block;
width: 100%;
margin: 10px 0;
}

}
#store-items {
display: flex;
flex-wrap: wrap;
gap: 20px;
justify-content: space-around;
}

.store-item {
flex: 1 1 calc(33% - 40px); /* Adjust the percentage as needed for the number of items per row */
box-sizing: border-box;
}

.card {
border: 1px solid #ddd;
border-radius: 8px;
overflow: hidden;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease;
}

.card:hover {
transform: scale(1.05);
}

.card-img {
width: 100%;
height: auto;
display: block;
}

.card-content {
padding: 15px;
}

.card-title {
font-size: 18px;
margin: 0 0 10px;
}

.card-description {
font-size: 14px;
color: #666;
margin: 0;
}

footer {
background-color: #333;
color: #fff;
text-align: center;
padding: 20px 10px;
font-size: 14px;
position: relative;
bottom: -155px;
width: 100%;
}

footer p {
margin: 0;
}


  </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Precious Memories Photography</div>
        <ul class="nav-links">
            <li><a href="./index.html">Home</a></li>
            <li><a href="./about.html">About</a></li>
            <li><a href="./resume.html">Resume</a></li>
            <li><a href="./services.html">Services</a></li>
            <li><a href="./portfolio.php">Portfolio</a></li>
            <li><a href="./contact.html">Contact Us</a></li>
            <li><a href="./login.html">Admin Page</a></li>
        </ul>
        <div class="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>

    <!-- Portfolio Introduction -->
    <div class="container">
        <h1>PORTFOLIO</h1>
        <p>Explore a carefully curated selection of our most captivating work. From the romance of weddings to the tranquility of nature, each photograph reflects our dedication to capturing life's most beautiful moments. Let our lens transform fleeting instants into lasting memories.</p>
    </div>

    <!-- Portfolio Filtering Menu -->
    <div class="container">
        <div class="menu">
            <a href="#" class="btn" data-filter="all">All</a>
            <a href="#" class="btn" data-filter="logo">Convocation</a>
            <a href="#" class="btn" data-filter="web">Wedding</a>
            <a href="#" class="btn" data-filter="mobile">Nature</a>
        </div>
        <div class="box" id="store-items">
            <div class="store-item web">
                <div class="card">
                    <img src="img/download13.jpg" class="card-img" alt="Wedding Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 1</h3>
                        <p class="card-description">A beautiful wedding photo capturing the special moments.</p>
                    </div>
                </div>
            </div>
            <div class="store-item web">
                <div class="card">
                    <img src="img/download14.jpg" class="card-img" alt="Wedding Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 2</h3>
                        <p class="card-description">Another stunning wedding photo with elegant details.</p>
                    </div>
                </div>
            </div>
            <div class="store-item web">
                <div class="card">
                    <img src="img/download 15.webp" class="card-img" alt="Wedding Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 3</h3>
                        <p class="card-description">A cherished memory from a wedding event.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/download12.jpeg" class="card-img" alt="Convocation Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 1</h3>
                        <p class="card-description">A memorable moment from the convocation ceremony.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/download20.jpg" class="card-img" alt="Convocation Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 2</h3>
                        <p class="card-description">Celebrating achievements at the convocation.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/convocation1.jpg" class="card-img" alt="Convocation Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 3</h3>
                        <p class="card-description">A highlight from the convocation ceremony.</p>
                    </div>
                </div>
            </div>
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/download16.jpeg" class="card-img" alt="Nature Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 1</h3>
                        <p class="card-description">A serene nature photo showcasing natural beauty.</p>
                    </div>
                </div>
            </div>
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/download17.jpg" class="card-img" alt="Nature Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 2</h3>
                        <p class="card-description">Another breathtaking image of nature.</p>
                    </div>
                </div>
            </div>
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/nature3.jpg" class="card-img" alt="Nature Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 3</h3>
                        <p class="card-description">A captivating nature scene captured in this image.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Items -->
        <div class="box" id="store-items">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="store-item <?php echo htmlspecialchars($row['category']); ?>">
                <div class="card">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="card-content">
                        <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Precious Memories Photography.com. All rights reserved.</p>
    </footer>

    <!-- JavaScript for Interactive Navbar and Portfolio Filter -->
    <script>
     (function(){
    const buttons = document.querySelectorAll('.btn');
    const storeImages = document.querySelectorAll('.store-item');

    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = e.target.dataset.filter;

            storeImages.forEach((item) => {
                if (filter === 'all') {
                    item.style.display = 'block';
                } else {
                    if (item.classList.contains(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });
})();



    </script>
</body>
</html>

<?php
$conn->close();
?>
