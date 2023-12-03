<?php

require_once 'dbh.inc.php';

class admin_model extends Dbh
{

    // Inserting room and its attributes to db
    public function set_room($is_Available, $type, $price, $persons, $quantity, $description, $image_name_new)
    {
        $query = "INSERT INTO room (is_Available, type, price, persons, initialQuantity, quantity, description, image) VALUES (:is_Available, :type, :price, :persons, :initialQuantity, :quantity, :description, :image);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":is_Available", $is_Available);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":initialQuantity", $quantity);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image_name_new);
        $stmt->execute();
    }

    // Editing room and its attributes to db
    public function edit_room($room_id, $type, $price, $persons, $quantity, $description, $image_name_new)
    {
        $query = "UPDATE room SET type = :type, price = :price, persons = :persons, initialQuantity = :initialQuantity, quantity = :quantity, description = :description, image = :image WHERE room_id = :room_id;";


        $stmt = $this->connect()->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":persons", $persons);
        $stmt->bindParam(":initialQuantity", $quantity);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image_name_new);
        $stmt->execute();
    }

    // Decreasing room quantity when user booked
    public function decrease_room_quantity($room_id, $quantity)
    {
        $query = "UPDATE room SET quantity = :quantity - 1 WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    // Increasing room quantity when user unbooked
    public function increase_room_quantity($room_id, $quantity)
    {
        $query = "UPDATE room SET quantity = :quantity + 1 WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    public function reset_room_quantity($initialQuantitys, $room_id) {
        $query = "UPDATE room SET quantity = :quantity WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":quantity", $initialQuantitys);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    // Inserting the room_id and user_id to "users_room" for booking duplicates
    public function insert_room_id($rooms_id, $user_id)
    {
        $query = "INSERT INTO user_rooms (users_id, rooms_id) VALUES (:users_id, :rooms_id);";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":rooms_id", $rooms_id);
        $stmt->bindParam(":users_id", $user_id);
        $stmt->execute();
    }

    // Removing the booking with the use of removing the booking_id
    public function remove_booking($booking_id)
    {
        $query = "DELETE FROM user_rooms WHERE booking_id = :booking_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
    }

    // Getting the user's booked room data 
    public function get_users_room_data()
    {
        $user_rooms_id_arrays = $this->get_user_room_id();
        $results = []; 

        foreach ($user_rooms_id_arrays as $user_rooms_id_array) {
            $rooms_id = $user_rooms_id_array['rooms_id'];
            $booking_id = $user_rooms_id_array['booking_id'];

            // :booking_id as booking_id = adding a new column to the result $results set
            $query = "SELECT *, :booking_id as booking_id FROM room WHERE room_id = :rooms_id";

            $stmt = $this->connect()->prepare($query);
            $stmt->bindParam(":rooms_id", $rooms_id);
            $stmt->bindParam(":booking_id", $booking_id);
            $stmt->execute();

            // Merge results together
            $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
        }

        return $results; // Return the complete array after the loop
    }


    // Getting the rooms_id and booking_id from user_rooms table
    public function get_user_room_id()
    {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT rooms_id, booking_id FROM user_rooms WHERE users_id = :users_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":users_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_data_roomIDs_from_userRooms($room_id) {
        $query = "SELECT * FROM user_rooms WHERE rooms_id = :rooms_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":rooms_id", $room_id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function get_uniqid_from_usersroom()
    {
    }

    // Getting room data from room table
    public function get_room_data()
    {
        $query = "SELECT * FROM room;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Getting room_id from room table
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

    public function get_room_card_id($room_card_id)
    {
        $query = "SELECT * FROM room_card WHERE room_card_id = :room_card_id LIMIT 1;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_card_id", $room_card_id);

        // $data = [
        //     ':room_id' => $room_id
        // ];

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Deleting room from admin panel
    public function delete_room($room_id)
    {

        $query = "DELETE FROM room WHERE room_id = :room_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }

    public function get_room_card_data($room_card_id) {
        $query = "SELECT * FROM room_card WHERE room_card_id =:room_card_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_card_id", $room_card_id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function get_room_card_data_all() {
        $query = "SELECT * FROM room_card;";

        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function edit_room_card($room_card_id, $type, $price, $description, $image_name_new)
    {
        $query = "UPDATE room_card SET type = :type, price = :price, description = :description, image = :image WHERE room_card_id = :room_card_id;";

        $stmt = $this->connect()->prepare($query);

        $stmt->bindParam(":room_card_id", $room_card_id);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image_name_new);
        $stmt->execute();
    }

    public function remove_all_book($room_id) {
        $query = "DELETE FROM user_rooms WHERE rooms_id =:room_id";
        
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();
    }
}
