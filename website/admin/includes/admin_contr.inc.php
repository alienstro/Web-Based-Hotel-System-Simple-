<?php


class admin_contr
{
    public function is_room_data_available($result)
    {
        if (!$result) {
            return true;
        } else {
            return false;
        }
    }

    public function is_users_room_data_available($result) 
    {
        if (!$result) {
            return true;
        } else {
            return false;
        }
    }

    public function is_room_card_data_available($room_card_id) 
    {
        if (!$room_card_id) {
            return true;
        } else {
            return false;
        }
    }

    public function is_ext_allow($image_actual_ext, $allowed)
    {
        if (in_array($image_actual_ext, $allowed)) { // If allowed ext
            return true;
        } else {
            return false; // "You cannot upload this image type";
        }
    }

    public function checks_image_error($image_error)
    {
        if ($image_error === 0) { // Checks for errors
            return true;
        } else {
            return false; // "There was an error uploading your image";
        }
    }

    public function check_image_size($image_size)
    {
        if ($image_size < 25000000) { // Checks file size.
            return true;
        } else {
            return false; // "Your image is too big. Only less than 25mb";
        }
    }

    public function check_room_availability($result) {
        if($result <= 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function no_negative_quantity($quantity) {
        if($quantity <= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function no_negative_price($price) {
        if($price <= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function no_negative_persons($persons) {
        if($persons <= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_numeric($price, $persons, $quantity) {
        if(!is_numeric($quantity) || !is_numeric($price) || !is_numeric($persons)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_if_same_quantity($initialQuantitys, $quantitys) {
        if($initialQuantitys != $quantitys) {
            return true;
        } else {
            return false;
        }
    }

    public function check_if_room_is_booked($result) {
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function is_input_empty($type, $price, $persons, $quantity, $description) {
        return empty($type) || empty($price) || empty($persons) || empty($quantity) || empty($description);
    }
}
