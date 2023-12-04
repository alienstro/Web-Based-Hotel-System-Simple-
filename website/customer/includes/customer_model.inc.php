<?php

require_once 'dbh.inc.php';

class customer_model extends Dbh
{
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

    public function get_room_card_data($room_card_id)
    {
        $query = "SELECT * FROM room_card WHERE room_card_id =:room_card_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":room_card_id", $room_card_id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function get_user_first_name($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $result = $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
