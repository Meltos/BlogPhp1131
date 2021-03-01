<?php


namespace View;


class UserView extends \Core\CoreView
{
    public function register()
    {
        echo $this->twig->render('/back-end/register.twig');
    }

    public function password()
    {
        echo $this->twig->render('/back-end/password.twig');
    }
}