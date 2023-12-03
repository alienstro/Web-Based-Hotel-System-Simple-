<?php

require_once 'config_session.inc.php';
require_once 'customer_model.inc.php';
require_once 'customer_contr.inc.php';

class customer_view
{
    public function check_add_errors()
    {
        if (isset($_SESSION['errors_customer_add'])) {
            $customer_errors = $_SESSION['errors_customer_add'];

            foreach ($customer_errors as $customer_error)
                echo "<h5 class='alert alert-danger'>" . $customer_error . "</h5>";
        }

        unset($_SESSION['errors_customer_add']);
    }

    public function check_room_availability() {
        if (isset($_SESSION['no_room_available'])) {
            $room_errors = $_SESSION['no_room_available'];

            foreach ($room_errors as $room_error)
                echo "<h5 class='room_alert alert alert-danger'>" . $room_error . "</h5>";
        } 

        unset($_SESSION['no_room_available']);
    }

    public function show_room_page()
    {
        $customer_model = new customer_model();
        $customer_contr = new customer_contr();

        $result = $customer_model->get_room_data();
        if ($customer_contr->is_room_data_available($result)) {
            $_SESSION["no_data"] = "No rooms available at the moment";
        }

        if (isset($_SESSION['no_data'])) {
            echo "<h2> {$_SESSION['no_data']} </h2>";

            unset($_SESSION['no_data']);
        } else {
            $customer_model = new customer_model();
            $result = $customer_model->get_room_data();

            foreach ($result as $row) {
                echo "

                <form action='./includes/customer_booking.inc.php' method='POST'>
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
                            <button type='submit' name='book_room_btn' class='book_room_btn'>Book now</button>
                            </div>
                        </div>
                    </div>
                </form>";
            }
        }
    }

    public function show_your_bookings()
    {
        $customer_model = new customer_model();
        $customer_contr = new customer_contr();

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION['user_id'];
        } else {
            echo "User ID not set in session.";
            die();
        }


        $result = $customer_model->get_user_room_id();
        if ($customer_contr->is_users_room_data_available($result)) {
            $_SESSION["no_booking"] = "You have no bookings";
        }

        if (isset($_SESSION['no_booking'])) {
            echo "<h2> {$_SESSION['no_booking']} </h2>";

            unset($_SESSION['no_booking']);
    
        } else {
            $results = $customer_model->get_users_room_data($user_id);

            foreach ($results as $row) {
                echo "

                <form action='./includes/customer_unbooking.inc.php' method='POST'>
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
        $customer_model = new customer_model();

        $room_card_id = 1;
        $results = $customer_model->get_room_card_data($room_card_id);


        foreach ($results as $result) {

            echo "
        
            <div class='first_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./customer_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }

    public function show_room_card2()
    {
        $customer_model = new customer_model();

        $room_card_id = 2;
        $results = $customer_model->get_room_card_data($room_card_id);

        foreach ($results as $result) {

            echo "
        
            <div class='second_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./customer_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }


    public function show_room_card3()
    {
        $customer_model = new customer_model();

        $room_card_id = 3;
        $results = $customer_model->get_room_card_data($room_card_id);

        foreach ($results as $result) {

            echo "
        
            <div class='third_column'>
                <img src='../admin/includes/pictures/" . $result['image'] . "' alt='' class='rooms_pictures_home'>
                <p class='room_card_type'> " . $result['type'] . "</p>
                <p class='room_card_price'>PHP " . $result['price'] . "</p>
                <p class='room_card_description'>" . $result['description'] . "</p>
                <a href='./customer_room_page.php'><button class='room_card_button'>DISCOVER MORE</button></a>
            </div>";
        }
    }

}
