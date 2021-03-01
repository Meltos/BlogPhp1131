<?php


namespace Model;


class UserModel extends \Core\CoreModel
{
    public function AddNewUser($login, $password, $email)
    {
        $sql = "INSERT INTO ".$this->table." (`login`, `pass`, `email`) VALUES (:login, :pass, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':login'=>$login, ':pass'=>$password, ':email'=>$email]);
    }
}