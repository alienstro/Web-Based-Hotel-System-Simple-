<?php 


class admin_contr {
    public function is_room_data_available($result) {
        if(!$result) {
            return true;
        } else {
            return false;
        }
    }
}