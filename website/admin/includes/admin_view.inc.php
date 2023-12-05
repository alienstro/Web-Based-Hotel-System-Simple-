<?php

require_once 'config_session.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

class admin_view
{
    public function check_add_message()
    {
        if (isset($_SESSION['message'])) {
            echo "<h5 class='alert alert-success'> {$_SESSION['message']} </h5>";
        }

        unset($_SESSION['message']);
    }

    public function show_room_data()
    {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        $result = $admin_model->get_room_data();
        if ($admin_contr->is_room_data_available($result)) {
            $_SESSION["no_data"] = "No records found!";
        }

        if (isset($_SESSION['no_data'])) {
            echo "<td colspan='9' class='td_no_data'> {$_SESSION['no_data']} </td>";

            unset($_SESSION['no_data']);
        } else {

            $admin_model = new admin_model();
            $result = $admin_model->get_room_data();

            foreach ($result as $row) {
                echo "
                <tr>
                    <td>" . $row['room_id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['persons'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td class='description_td'>" . $row['description'] . "</td>
                    <td class='img_td'> <img class='img_admin' src='./includes/pictures/" . $row['image'] . "'></td>
                    <td><a href='admin_edit.php?room_id={$row['room_id']}' class='btn btn-primary'>Edit</a></td>
                        <td> 
                            <form action='../admin/includes/admin_delete.inc.php' method='POST'>
                                <input type='hidden' name='room_id' value='" . $row['room_id'] . "'/>
                                <button type='submit' name='delete_room_btn' value='" . $row['room_id'] . "' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
        }
    }

    public function show_booked_room_data()
    {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        $result = $admin_model->get_room_booked_data();

        if ($admin_contr->is_room_data_available($result)) {
            $_SESSION["no_booked_room"] = "No booked rooms currently!";
        }

        if (isset($_SESSION['no_booked_room'])) {
            echo "<td colspan='7' class='td_no_data'> {$_SESSION['no_booked_room']} </td>";

            unset($_SESSION['no_booked_room']);
        } else {
            $result = $admin_model->get_room_booked_data();

            foreach ($result as $row) {
                echo "
                <tr>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['last_name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['persons'] . "</td>
                    <td>" . $row['price'] . "</td>
                        <td> 
                            <form action='../admin/includes/admin_booked_room_delete.inc.php' method='POST'>
                                <input type='hidden' name='quantity' value='" . $row['quantity'] . "'/>
                                <input type='hidden' name='room_id' value='" . $row['room_id'] . "'/>
                                <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'/>
                                <button type='submit' name='delete_room_btn' value='" . $row['booking_id'] . "' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr> 
                ";
            }
        }
    }

    public function check_add_errors()
    {
        if (isset($_SESSION['errors_admin_add'])) {
            $admin_errors = $_SESSION['errors_admin_add'];

            foreach ($admin_errors as $admin_error)
                echo "<h5 class='alert alert-danger'>" . $admin_error . "</h5>";
        }

        unset($_SESSION['errors_admin_add']);
    }

    public function check_room_availability()
    {
        if (isset($_SESSION['no_room_available'])) {
            $room_errors = $_SESSION['no_room_available'];

            foreach ($room_errors as $room_error)
                echo "<h5 class='room_alert alert alert-danger'>" . $room_error . "</h5>";
        }

        unset($_SESSION['no_room_available']);
    }

    public function show_room_page()
    {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        if (isset($_SESSION["user_id"])) {
            $result = $admin_model->get_room_data();
            if ($admin_contr->is_room_data_available($result)) {
                $_SESSION["no_data"] = "No rooms available at the moment";
            }
        } else {
            header("Location: ../login.php");
            die();
        }

        if (isset($_SESSION['no_data'])) {
            echo "<h2> {$_SESSION['no_data']} </h2>";

            unset($_SESSION['no_data']);
        } else {

            // Check if a search word is set
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search_word = $_GET['search'];
                $result = $admin_model->get_room_data_by_search($search_word);
            } else {
                $result = $admin_model->get_room_data();
            }



            foreach ($result as $row) {
                echo "

                <form action='./includes/admin_booking.inc.php' method='POST'>
                    <div class='room_container'>
                    <input type='hidden' name='quantity' value='" . $row['quantity'] . "' />
                    <input type='hidden' name='room_id' value='" . $row['room_id'] . "' />
                        <div class='column_img'>
                            <img class='img_room' src='../admin/includes/pictures/" . $row['image'] . "' alt='singleRoom'>
                        </div>

                        <div class='column_text'>
                            <p class='column_text_p'>" . $row['persons'] . " Persons</p>
                            <h3 class='column_text_type'>" . $row['type'] . "</h3>
                            <p class='column_text_p'>" . $row['description'] . "</p>
                        </div>

                        <div class='column_btn'>
                            <div class='btn_and_txt'>
                            <p class='column_text_p'>PHP " . $row['price'] . " per night</p>
                            <button type='submit' name='book_room_btn' class='book_room_btn' >Book now</button>
                            </div>
                        </div>
                    </div>
                </form>";
            }
        }
    }

    public function show_your_bookings()
    {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION['user_id'];
        } else {
            header("Location: ../login.php");
            die();
        }


        $result = $admin_model->get_user_room_id();
        if ($admin_contr->is_users_room_data_available($result)) {
            $_SESSION["no_booking"] = "You have no bookings";
        }

        if (isset($_SESSION['no_booking'])) {
            echo "<h2> {$_SESSION['no_booking']} </h2>";

            unset($_SESSION['no_booking']);
        } else {
            $results = $admin_model->get_users_room_data($user_id);

            foreach ($results as $row) {
                echo "

                <form action='./includes/admin_unbooking.inc.php' method='POST'>
                    <div class='room_container'>
                    <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "' />
                    <input type='hidden' name='quantity' value='" . $row['quantity'] . "' />
                    <input type='hidden' name='room_id' value='" . $row['room_id'] . "' />
                        <div class='column_img'>
                            <img class='img_room' src='../admin/includes/pictures/" . $row['image'] . "' alt='singleRoom'>
                        </div>

                        <div class='column_text'>
                            <p class='column_text_p'>" . $row['persons'] . " Persons</p>
                            <h3 class='column_text_type'>" . $row['type'] . "</h3>
                            <p class='column_text_p'>" . $row['description'] . "</p>
                        </div>

                        <div class='column_btn'>
                            <div class='btn_and_txt'>
                            <p class='column_text_p'>PHP " . $row['price'] . " per night</p>
                            <button type='submit' name='unbook_room_btn' class='book_room_btn'>Unbook</button>
                            </div>
                        </div>
                    </div>
                </form>";
            }
        }
    }

    public function show_room_card1()
    {
        $admin_model = new admin_model();

        $room_card_id = 1;
        $results = $admin_model->get_room_card_data($room_card_id);


        foreach ($results as $result) {

            echo "
        
            <div class='first_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./admin_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }

    public function show_room_card2()
    {
        $admin_model = new admin_model();

        $room_card_id = 2;
        $results = $admin_model->get_room_card_data($room_card_id);

        foreach ($results as $result) {

            echo "
        
            <div class='second_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./admin_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }


    public function show_room_card3()
    {
        $admin_model = new admin_model();

        $room_card_id = 3;
        $results = $admin_model->get_room_card_data($room_card_id);

        foreach ($results as $result) {

            echo "
        
            <div class='third_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./admin_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }

    public function show_room_card_data()
    {
        $admin_model = new admin_model();
        $result = $admin_model->get_room_card_data_all();

        foreach ($result as $row) {
            echo "
                <tr>
                    <td>" . $row['room_card_id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td class='img_td'> <img class='img_admin' src='./includes/pictures/" . $row['image'] . "'></td>
                    <td><a href='admin_room_card_edit.php?room_card_id={$row['room_card_id']}' class='btn btn-primary'>Edit</a></td> 
                </tr>";
        }
    }

    public function show_user_first_name()
    {
        $user_id = $_SESSION['user_id'];

        $admin_model = new admin_model();
        $result = $admin_model->get_user_first_name($user_id);

        $first_name = $result['first_name'];

        echo "<p class='right_side_nav_p'>Welcome, " . $first_name . "</p>";
    }
}
