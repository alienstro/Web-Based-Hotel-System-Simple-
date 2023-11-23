<?php

declare(strict_types=1);

require_once '../includes/dbh.inc.php';
require_once 'admin_model.inc.php';

class admin_contr extends Dbh
{
    private $is_Available;
    private $type;
    private $price;
    private $persons;
    private $quantity;
    private $description;
    private $user_id;

    public function print_all()
    {
        $admin_model = new admin_model($this->is_Available, $this->type, $this->persons, $this->quantity, $this->description, $this->user_id);
        $results = $admin_model->get_all();

        foreach ($results as $row) {
            echo "
            <tr>
                <td>{$row["type"]}</td>
                <td>{$row["price"]}</td>
                <td>{$row["persons"]}</td>
                <td>{$row["quantity"]}</td>
                <td>{$row["description"]}</td>
                <td>
                    <a href='/admin/admin_editRoom.php?type={$row["type"]}' class='edit_button btn btn-primary btn-sm'>Edit</a>
                    <a href='/admin/admin_deleteRoom.php?type={$row["type"]}' class='edit_button btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
        }
        
    }
}
