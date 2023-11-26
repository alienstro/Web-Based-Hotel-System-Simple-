<?php

// require_once 'includes/admin_model.inc.php';

// $admin_model = new admin_model();
// $result = $admin_model->get_room_id($room_id);

require_once '../admin/includes/dbh.inc.php';
require_once '../admin/includes/admin_model.inc.php';

if(isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $admin_model = new admin_model();
    $result = $admin_model->get_room_id($room_id);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

                <div class="card">
                    <div class="card-header">
                        <h3>Edit Room
                            <a href="../admin/admin_adminPanel_page.php" class="btn btn-danger float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="../admin/includes/admin_edit.inc.php" method="POST">

                            <input type="hidden" name="room_id" value="<?= $result['room_id']; ?>"/>
                            <div class="mb-3">
                                <label>Type</label>
                                <input type="text" name="type" value="<?= $result['type']; ?> "class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Price</label>
                                <input type="text" name="price" value="<?= $result['price']; ?> "class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Persons</label>
                                <input type="text" name="persons" value="<?= $result['persons']; ?> "class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Quantity</label>
                                <input type="text" name="quantity" value="<?= $result['quantity']; ?> "class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <input type="text" name="description" value="<?= $result['description']; ?> "class="form-control" />
                            </div>
                            <button type="submit" name="update_room_btn" class="btn btn-primary">Update Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>