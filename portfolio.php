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
    <title>Precious Memories Photography - Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #333;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo {
            color:#e91e63;
            font-size: 24px;
            font-weight: bold;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .nav-links li a {
            color: #f5f5f5;
            text-decoration: none;
            padding: 8px 15px;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav-links li a:hover {
            background-color: #e91e63;
            color: #fff;
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
            background-color: #f5f5f5;
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
            color: #e91e63;
            font-size: 2.5rem;
        }
        p {
            line-height: 1.5;
            margin-bottom: 20px;
            font-size: 1.2rem;
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
            border: 1px solid #444;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .portfolio-item:hover {
            transform: scale(1.05);
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
            color: #e91e63;
        }
        .portfolio-item .caption p {
            margin-bottom: 0;
            color: #bbb;
        }
        /* Portfolio filtering menu styling */
        .menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .menu .btn {
            text-decoration: none;
            color: #fff;
            background-color: #e91e63;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }
        .menu .btn:hover {
            background-color: #c2185b;
            transform: scale(1.05);
        }
        .menu .btn.active {
            background-color: #28a745;
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
            border: 1px solid #444;
            border-radius: 10px;
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
            color: #e91e63;
        }
        .card-description {
            font-size: 14px;
            color: #bbb;
            margin: 0;
        }
        footer {
            background-color: #333;
            color: #f5f5f5;
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
        <div class="logo">PRECIOUS MEMORIES</div>
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
                    <img src="img/wedding2.jpg" class="card-img" alt="Wedding Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 1</h3>
                        <p class="card-description">A beautiful wedding photo capturing the special moments.</p>
                    </div>
                </div>
            </div>
            <div class="store-item web">
                <div class="card">
                    <img src="img/wedding3.jpg" class="card-img" alt="Wedding Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 2</h3>
                        <p class="card-description">Another stunning wedding photo with elegant details.</p>
                    </div>
                </div>
            </div>
            <div class="store-item web">
                <div class="card">
                    <img src="img/wedding1.webp" class="card-img" alt="Wedding Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Wedding Image 3</h3>
                        <p class="card-description">A cherished memory from a wedding event.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/convocation1 copy.jpg" class="card-img" alt="Convocation Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 1</h3>
                        <p class="card-description">A memorable moment from the convocation ceremony.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/convocation2.jpg" class="card-img" alt="Convocation Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 2</h3>
                        <p class="card-description">Celebrating achievements at the convocation.</p>
                    </div>
                </div>
            </div>
            <div class="store-item logo">
                <div class="card">
                    <img src="img/convocation3.jpg" class="card-img" alt="Convocation Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Convocation Image 3</h3>
                        <p class="card-description">A highlight from the convocation ceremony.</p>
                    </div>
                </div>
            </div>
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/nature1.jpg" class="card-img" alt="Nature Image 1">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 1</h3>
                        <p class="card-description">A serene nature photo showcasing natural beauty.</p>
                    </div>
                </div>
            </div>
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/nature2.jpg" class="card-img" alt="Nature Image 2">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 2</h3>
                        <p class="card-description">Another breathtaking image of nature.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="store-item mobile">
                <div class="card">
                    <img src="img/nature3.jpeg" class="card-img" alt="Nature Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Nature Image 3</h3>
                        <p class="card-description">A captivating nature scene captured in this image.</p>
                    </div>
                </div>
            </div> -->
            <div class="store-item mobile">
                <div class="card">
                    <img src="img/nepalesewedding.jpg" class="card-img" alt="Nature Image 3">
                    <div class="card-content">
                        <h3 class="card-title">Nepalese Wedding</h3>
                        <p class="card-description">Nepali bride wedding dresses/ Nepali wedding dress ideas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box" id="store-items">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="store-item <?php echo !empty($row['category']) ? strtolower($row['category']) : 'no-category'; ?> portfolio-item">
            <div class="card">
                <?php if (!empty($row['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="card-img">
                <?php else: ?>
                    <img src="default-image.jpg" alt="Default Image" class="card-img"> <!-- Fallback image -->
                <?php endif; ?>
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
        <p>&copy; 2024 Precious Memories Photography. All rights reserved.</p>
    </footer>

    <script>
        // Toggle the navbar links on hamburger menu click
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Portfolio filtering
        const filterButtons = document.querySelectorAll('.menu .btn');
        const storeItems = document.querySelectorAll('.store-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const filter = button.getAttribute('data-filter');

                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                storeItems.forEach(item => {
                    if (filter === 'all' || item.classList.contains(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
