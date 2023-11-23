<?php
require_once 'includes/admin_contr.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
            <a href="./admin_home_page.php">HOME</a>
            <a href="./admin_room_page.php">ROOMS</a>
            <a href="./admin_bookings_page.php">YOUR BOOKINGS</a>
            <a href="./admin_adminPanel_page.php" class="active">ADMIN PANEL</a>
        </div>
    </nav>

    <div class="table_container container my-5">
        <h2>Rooms</h2>
        <a href="./admin_addRoom_page.php" class="new_room_button btn btn-primary" role="button">Add Room</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Price</th>
                    <th>No. of Persons</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>
                <?php
                    $admin_contr = new admin_contr();
                    $admin_contr->print_all();


                ?>
                
            </tbody>
        </table>
    </div>




</body>

</html>