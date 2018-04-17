<?php 

/**
* 
*/
class HandleUser extends Db
{
	
	public function getAllUsers()
	{
		$users = $this->getLines('SELECT * FROM users');
		return $users;
	}
        
    public function addUser($user_name, $user_pass, $user_full)
    {
        $query = parent::$connection->prepare('INSERT INTO users(user_name, user_pass, user_fullname) VALUE (?, ?, ?)');
        $query->bind_param('sss', $user_name, $user_pass, $user_full);
        return $query->execute();
    }
    public function login($username, $password) {
		$user = $this->getLines("SELECT * FROM users WHERE user_name = '$username' AND user_pass = '$password'");
		return $user;

	}
	/*public function login($username, $password, $users) {
		foreach ($users as $value) {
			if ($username == $value['user_name'] && $password == $value['user_pass']) {
				return true;
			}
		}
		return false;
	}*/

	/*public function getUserById($user_id) {
        $user = $this->getUsers("SELECT * FROM products WHERE product_id = $user_id");
        return $user;
    }*/
}