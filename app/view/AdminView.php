<?php


namespace View;


class AdminView extends \Core\CoreView
{
    public function showAdmin($articles, $categories, $users)
    {
        echo $this->twig->render('/back-end/admin.twig', ['article_list'=>$articles, 'category_list'=>$categories, 'user_list'=>$users, 'page_title'=>'Главная']);
    }

    public function login()
    {
        echo $this->twig->render('/back-end/login.twig');
    }

    public function register()
    {
        echo $this->twig->render('/back-end/register.twig');
    }

    public function showAdminAdd($articles, $categories)
    {
        echo $this->twig->render('/back-end/addarticle.twig', ['article_list'=>$articles, 'category_list'=>$categories, 'page_title'=>'Создание статьи']);
    }

    public function showAdminEdit($article, $categories)
    {
        echo $this->twig->render('/back-end/editarticle.twig', ['article'=>$article, 'category_list'=>$categories]);
    }
}