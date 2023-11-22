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
            <a href="./admin_home_page.php">HOME</a>
            <a href="./admin_room_page.php">ROOMS</a>
            <a href="./admin_bookings_page.php">YOUR BOOKINGS</a>
            <a href="./admin_adminPanel_page.php" class="active">ADMIN PANEL</a>
        </div>
    </nav>

    <div class="table_container my-5">
        <h2>Room Card</h2>
        <a href="/admin/admin_addRoom_page.php" class="new_room_button" role="button">Add Room</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>No. of Persons</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php
            
            
            
            ?>
            <tbody>
                <td>Single Room</td>
                <td>PHP1500</td>
                <td>2</td>
                <td>10</td>
                <td>A perfect blend of tranquility and modern convenience.</td>
                <td>
                    <a href="/admin/admin_editRoom.php" class="edit_button">Edit</a>
                    <a href="/admin/admin_deleteRoom.php" class="edit_button">Delete</a>
                </td>
            </tbody>
        </table>
    </div>




</body>

</html>