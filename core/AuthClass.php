<?php


namespace Core;

use Model\UserModel as UserModel;
use Core\ServiceController as Serv;
use Core\CoreController;

class AuthClass extends CoreController
{
    public $Users;
    public function __construct()
    {
        $this->Users = new UserModel('user');
    }

    public function logIn(){
        if (isset($_POST['btnLogin'])){
            $login=$_POST['login'];
            $password=$_POST['password'];
            $users = $this->Users->getAll();
            foreach ($users as $user)
            {
                if ($login==$user['login'] && $password==$user['pass']){
                    $_SESSION['userName']=$login;
                    Serv::showAlert('Добро пожаловать - '.$login);
                    Serv::goUri('/admin');
                }
            }
            Serv::showAlert( 'Логин или пароль не верны!!!');
            Serv::goUri('/admin');
        }
    }
    public static function logOut()
    {
        unset($_SESSION['userName']);
        Serv::goUri('/admin');

    }
    public static function checkAuth(){
        if (isset($_SESSION['userName'])&& !empty( $_SESSION['userName'])){
            return $_SESSION['userName'];
        }else{
            return false;
        }
    }

}