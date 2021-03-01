<?php


namespace Controller;

use Core\ServiceController as Serv;
use View\UserView as View;
use Model\UserModel as UserModel;
use Core\CoreController;

class UserController extends \Core\CoreController
{
    public $Users;
    public $Auth;

    public function __construct()
    {
        $this->View = new View();
        $this->Users = new UserModel('user');
    }

    public function register()
    {
        $this->View->register();
    }

    public function password()
    {
        $this->View->password();
    }

    public function pass()
    {
        {
            if (isset($_POST['btnPass'])) {
                $users = $this->Users->getAll();
                $email = $_POST['emailPass'];
                $emailP = false;
                foreach ($users as $user)
                {
                    if ($user['email'] == $email)
                    {
                        $emailP = true;
                        Serv::showAlert('Ваш пароль - '.$user['pass']);
                        Serv::goUri('/admin');
                    }
                }
                if ($emailP == false)
                {
                    Serv::showAlert('Такого email не существует!');
                    Serv::goUri('/admin/password');
                }
            }
        }
    }

    public function reg()
    {
        if (isset($_POST['btnReg'])) {
            $users = $this->Users->getAll();
            $login = $_POST['loginReg'];
            $password = $_POST['passwordReg'];
            $cPassword = $_POST['cPassword'];
            $email = $_POST['emailReg'];
            $loginP = true;
            $passwordP = true;
            $emailP = true;
            if ($password != $cPassword) {
                $passwordP = false;
                Serv::showAlert('Пароли не совпадают!');
                Serv::goUri('/admin/register');
            }
            foreach ($users as $user)
            {
                if ($user['email'] == $email)
                {
                    $emailP = false;
                    Serv::showAlert('Введённая почта уже занята!');
                    Serv::goUri('/admin/register');
                }
                elseif ($user['login'] == $login)
                {
                    $loginP = false;
                    Serv::showAlert('Введённый логин уже занят!');
                    Serv::goUri('/admin/register');
                }
            }
            if ($loginP == true && $emailP == true && $passwordP == true)
            {
                $this->Users->AddNewUser($login, $password, $email);
                $_SESSION['userName'] = $login;
                Serv::showAlert('Добро пожаловать - ' . $login);
                Serv::goUri('/admin');
            }
        }
    }
}