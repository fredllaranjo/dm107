<?php
class UserDao {
    private $db;
    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function userExists($user, $pwd) {
        $userCount = $this->db->user()->where("user = ?", $user)->where("pwd = ?", $pwd)->count("*");

        if ($userCount == 0) {
            return false;
        }

        return true;
    }

     public function getUsers() {
        $users = array();

        foreach ($this->db->user() as $user) {
            $users[$user["user"]] = $user["pwd"];
        }

        return $users;
    }
}
?>