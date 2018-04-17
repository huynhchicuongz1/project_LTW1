<?php
/**
 * 
*/
class User extends Db
{
    public function updatePassword($user_name, $user_pass) {
        $query = parent::$connection->prepare('UPDATE users SET user_pass=? WHERE user_name=?');
        $query->bind_param('ss', $user_name, $user_pass);
        return $query->execute();
    }



}