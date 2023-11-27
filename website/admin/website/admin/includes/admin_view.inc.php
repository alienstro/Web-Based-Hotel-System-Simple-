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
    public function check_add_errors() {
        if (isset($_SESSION['errors_admin_add'])) {
            $admin_errors = $_SESSION['errors_admin_add'];

            foreach ($admin_errors as $admin_error)
            echo "<h5 class='alert alert-success'>" . $admin_error . "</h5>";
        }

        unset($_SESSION['errors_admin_add']);
    }
}
