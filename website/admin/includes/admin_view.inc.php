<?php

require_once 'config_session.inc.php';
require_once 'admin_model.inc.php';

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
        if (isset($_SESSION['errors'])) {
            echo "<td colspan='8'> {$_SESSION['errors']} </td>";

            unset($_SESSION['errors']);
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
                    <td>" . $row['description'] . "</td>
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
}


