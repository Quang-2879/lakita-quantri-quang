<?php

class Generate {

    function generateRandomString($length = 10, $uppercase = false) {
        if ($uppercase = true)
            $characters = '0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
        else
            $characters = '0123456789abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } return $randomString;
    }
    
    function generateRandomStringCombo($length = 11, $uppercase = false) {
        if ($uppercase = true)
            $characters = '0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
        else
            $characters = '0123456789abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } return $randomString;
    }

}
