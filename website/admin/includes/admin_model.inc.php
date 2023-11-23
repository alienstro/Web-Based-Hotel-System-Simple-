<?php

declare(strict_types=1);

class admin_model extends Dbh {
    private $is_Available;
    private $type;
    private $persons;
    private $quantity;
    private $description;
    private $user_id;

    public function __construct($is_Available, $type, $persons, $quantity, $description, $user_id) {
        $this->is_Available = $is_Available;
        $this->type = $type;
        $this->persons = $persons;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->user_id = $user_id;
    }

    public function get_all(){
        $query = "SELECT * FROM room;";
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(); 

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

