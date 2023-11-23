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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

    <div class="add_container container my-5">
        <h2>New Room</h2>
        <form action="" method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Type</label> <!-- later on gawin mo tong drop down kasi types lang ilalagay mo -->
                <div class="col-sm-6">
                    <input type="text" name="type" class="form-control" value="">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" name="price"  class="form-control" value="">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">No. Of Persons</label> <!-- Ikaw bahala kung gusto mo palitan to ng type="number" para less errors -->
                <div class="col-sm-6">
                    <input type="text" name="persons" class="form-control" value="">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label> <!-- Ikaw bahala kung gusto mo palitan to ng type="number" para less errors -->
                <div class="col-sm-6">
                    <input type="text" name="quantity" class="form-control" value="">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" name="description" class="form-control" value="">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button class="btn btn-primary">Submit</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a href="admin_adminPanel_page.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>




        </form>
    </div>


</body>

</html>