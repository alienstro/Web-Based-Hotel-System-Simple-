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
            echo "<td colspan='9'> {$_SESSION['no_data']} </td>";

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
    public function check_add_errors()
    {
        if (isset($_SESSION['errors_admin_add'])) {
            $admin_errors = $_SESSION['errors_admin_add'];

            foreach ($admin_errors as $admin_error)
                echo "<h5 class='alert alert-success'>" . $admin_error . "</h5>";
        }

        unset($_SESSION['errors_admin_add']);
    }

    public function show_room_page()
    {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        $result = $admin_model->get_room_data();
        if ($admin_contr->is_room_data_available($result)) {
            $_SESSION["no_data"] = "No rooms available at the moment";
        }

        if (isset($_SESSION['no_data'])) {
            echo "<h2> {$_SESSION['no_data']} </h2>";

            unset($_SESSION['no_data']);
        } else {
            $admin_model = new admin_model();
            $result = $admin_model->get_room_data();

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
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION['user_id'];
        } else {
            echo "User ID not set in session.";
            die();
        }


        $result = $admin_model->get_user_room_id();
        if ($admin_contr->is_users_room_data_available($result)) {
            $_SESSION["no_booking"] = "You have no bookings";
        }

        if (isset($_SESSION['no_booking'])) {
            echo "<h2> {$_SESSION['no_booking']} </h2>";

            unset($_SESSION['no_booking']);
            die();
        } else {
            $result = $admin_model->get_users_room_data($user_id);

            foreach ($result as $row) {

                echo "

                <form action='./includes/admin_unbooking.inc.php' method='POST'>
                    <div class='room_container'>
                    <input type='hidden' name='user_rooms_id' value='" . $row['id'] . "' />
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
}
