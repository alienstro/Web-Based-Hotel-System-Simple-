<?php

require_once 'dbh.inc.php';

class admin_model extends Dbh
{

    public function set_room($is_Available, $type, $price, $persons, $quantity, $description)
    {
        $query = "INSERT INTO room (is_Available, type, price, persons, quantity, description) VALUES (:is_Available, :type, :price, :persons, :quantity, :description);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":is_Available", $is_Available);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }

    public function edit_room($room_id, $type, $price, $persons, $quantity, $description)
    {
        $query = "UPDATE room SET type = :type, price = :price, persons = :persons, quantity = :quantity, description = :description WHERE room_id = :room_id;";
      

        $stmt = $this->connect()->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }

    public function get_room_data()
    {
        $query = "SELECT * FROM room;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function get_room_id($room_id)
    {
        $query = "SELECT * FROM room WHERE room_id = :room_id LIMIT 1;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_id", $room_id);

        // $data = [
        //     ':room_id' => $room_id
        // ];

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function delete_room($room_id) {

        $query = "DELETE FROM room WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();

    }


}
