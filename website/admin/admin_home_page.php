<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../homePage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="parent_nav_top">
            <div class="side_nav"></div>

            <div class="logo">
                <h1 class="mount">MOUNT </h1>
                <img src="../picture/mounthua.webp" alt="Mount Hua Logo" class="mount_hua_logo">
                <h1 class="hua_hotel"> HUA HOTEL</h1>
            </div>

            <div class="side_nav">
                <form action="../includes/logout.inc.php" method="post">
                    <button class="logout">LOGOUT</button>
                </form>
            </div>
        </div>
        <div class="top_nav">
            <a href="./admin_home_page.php" class="active">HOME</a>
            <a href="./admin_room_page.php">ROOMS</a>
            <a href="./admin_bookings_page.php">YOUR BOOKINGS</a>
            <a href="./admin_adminPanel_page.php">ADMIN PANEL</a>
        </div>
    </nav>

    <img src="../picture/home_page_picture.jpg" alt="home_page_picture" class="home_page_picture">

    <p class="quote_home_page">Discover serenity<br>at Mount Hua Hotel</p>

    <h2>Our Rooms</h2>

    <div class="Threebox_container">

        <div class="first_column">
            <img src="../picture/singleRoom.avif" alt="" class="rooms_pictures_home">
            <p>hatdog</p>
        </div>

        <div class="second_column">
            <img src="../picture/twinRoom.avif" alt="" class="rooms_pictures_home">
            <p>hat</p>
        </div>

        <div class="third_column">
            <img src="../picture/deluxeRoom.jpg" alt="" class="rooms_pictures_home">
            <p>ma</p>
        </div>
    </div>

    

    <footer>
        <div class="footer_left">
            <h1 class="mount">MOUNT </h1>
            <img src="../picture/mounthua.webp" alt="Mount Hua Logo" class="mount_hua_logo">
            <h1 class="hua_hotel"> HUA HOTEL</h1>
        </div>

        <div class="footer_bottom">
            <p>&copy; 2023. All Rights Reserved.</p>
        </div>
    </footer>


</body>

</html>