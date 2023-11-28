<?php

require_once 'dbh.inc.php';

class admin_model extends Dbh
{

    public function set_room($is_Available, $type, $price, $persons, $quantity, $description, $image_name_new)
    {
        $query = "INSERT INTO room (is_Available, type, price, persons, quantity, description, image) VALUES (:is_Available, :type, :price, :persons, :quantity, :description, :image);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":is_Available", $is_Available);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image_name_new);
        $stmt->execute();
    }

    public function edit_room($room_id, $type, $price, $persons, $quantity, $description, $image_name_new)
    {
        $query = "UPDATE room SET type = :type, price = :price, persons = :persons, quantity = :quantity, description = :description, image = :image WHERE room_id = :room_id;";


        $stmt = $this->connect()->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image_name_new);
        $stmt->execute();
    }

    public function decrease_room_quantity($room_id, $quantity)
    {
        $query = "UPDATE room SET quantity = :quantity - 1 WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    public function increase_room_quantity($room_id, $quantity)
    {
        $query = "UPDATE room SET quantity = :quantity + 1 WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    public function insert_room_id($rooms_id, $user_id)
    {
        $query = "INSERT INTO user_rooms (users_id, rooms_id) VALUES (:users_id, :rooms_id);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":rooms_id", $rooms_id);
        $stmt->bindParam(":users_id", $user_id);
        $stmt->execute();
    }

    public function remove_room_id($rooms_id, $user_id)
    {
        $query = "DELETE FROM user_rooms WHERE rooms_id = :rooms_id AND users_id = :users_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":rooms_id", $rooms_id);
        $stmt->bindParam(":users_id", $user_id);
        $stmt->execute();
    }

    public function get_users_room_data()
    {

        // $user_id = $_SESSION['user_id'];

        // $query = "SELECT * FROM user_rooms WHERE users_id = :users_id;";

        // $stmt = $this->connect()->prepare($query);
        // $stmt->bindParam(":users_id", $user_id);
        // $stmt->execute();

        // $user_rooms_id = $stmt->fetch(PDO::FETCH_ASSOC);

        $user_rooms_ids = $this->get_user_room_id();

        foreach ($user_rooms_ids as $user_rooms_id) {
            $rooms_id = $user_rooms_id['rooms_id'];

            $query = "SELECT * FROM room WHERE room_id = :rooms_id";
    
            $stmt = $this->connect()->prepare($query);
            $stmt->bindParam(":rooms_id", $rooms_id);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }

        
    }

    public function get_user_room_id()
    {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM user_rooms WHERE users_id = :users_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":users_id", $user_id);
        $stmt->execute();

        $user_rooms_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user_rooms_id;
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

    public function delete_room($room_id)
    {

        $query = "DELETE FROM room WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }
}
