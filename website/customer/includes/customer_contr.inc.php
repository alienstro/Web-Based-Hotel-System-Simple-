<?php


class customer_contr
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

    public function check_room_availability($result) {
        if($result <= 0 ) {
            return true;
        } else {
            return false;
        }
    }
}
