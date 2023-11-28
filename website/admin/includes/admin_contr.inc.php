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
}
