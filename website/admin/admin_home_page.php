<?php

require_once '../admin/includes/dbh.inc.php';
require_once '../admin/includes/admin_model.inc.php';
require_once '../admin/includes/admin_view.inc.php';
require_once '../admin/includes/config_session.inc.php';



?>


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
            <div class="right_side_nav">

            <?php 
            
            $admin_view = new admin_view();
            $admin_view->show_user_first_name();
            
            ?>


            </div>

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
            <a href="./admin_bookedrooms_page.php">BOOKED ROOMS</a>
        </div>
    </nav>

    <img src="../picture/home_page_picture.jpg" alt="home_page_picture" class="home_page_picture">

    <p class="quote_home_page">Discover serenity<br>at Mount Hua Hotel</p>

    <h2>Our Rooms</h2>

    <div class="Threebox_container">


        <?php

        $admin_view = new admin_view();

        $admin_view->show_room_card1();
        $admin_view->show_room_card2();
        $admin_view->show_room_card3();

        ?>
    </div>";


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