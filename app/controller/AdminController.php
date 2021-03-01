<?php


namespace Controller;

use View\AdminView as View;
use Model\ArticleModel as ArticleModel;
use Model\CategoryModel as CategoryModel;
use Model\UserModel as UserModel;
use Core\CoreController;

use Core\ServiceController as Serv;
use Core\AuthClass as Auth;

class AdminController extends \Core\CoreController
{
    public  $Articles;
    public $Categories;
    public $username;

    public function __construct()
    {
        $this->username = Auth::checkAuth();
        $this->View = new View();
        if ($this->username == false)
        {
            //Serv::goUri('/admin/login');
            $this->showLoginForm();
            exit();
        }
        $this->Articles = new ArticleModel('article');
        $this->Categories = new CategoryModel('category');
        $this->Users = new UserModel('user');
    }

    public function index()
    {
        $articles = $this->Articles->getAll();
        $categories = $this->Categories->getAll();
        $users = $this->Users->getAll();
        $atriclecategory = $this->Categories->setAtricleCategory($articles, $categories);
        $this->View->showAdmin($atriclecategory, $categories, $users);
    }

    public function showLoginForm()
    {
        $this->View->login();
    }


    public function register()
    {
        $this->View->register();
    }

    public function articleDel($id)
    {
        $this->Articles->ArticleDelete($id);
        Serv::goUri('/admin');
    }

    public function articleEdit($id)
    {
        $article = $this->Articles->getById($id);
        $categories = $this->Categories->getAll();
        $this->View->showAdminEdit($article, $categories);
    }

    public function addArticle()
    {
        $articles = $this->Articles->getAll();
        $categories = $this->Categories->getAll();
        $atriclecategory = $this->Categories->setAtricleCategory($articles, $categories);
        $this->View->showAdminAdd($atriclecategory, $categories);
    }

    public function articleSave()
    {
        if (isset($_POST['btnEdit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $img = $_POST['img'];
            $category = $_POST['category'];
            $des = $_POST['des'];
            $this->Articles->ArticleEdit($id, $title, $img, $category, $des);
        }
        Serv::goUri('/admin');
    }

    public function articleAdd()
    {
        if (isset($_POST['btnAdd'])) {
            $title = $_POST['title'];
            $img = $_POST['img'];
            $category = $_POST['category'];
            $des = $_POST['des'];
            $html = $_POST['html'];
            $this->Articles->AddArticle($title, $img, $category, $des, $html);
        }
        Serv::goUri('/admin');
    }
}