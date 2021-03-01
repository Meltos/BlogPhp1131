<?php


namespace Controller;

use View\BlogView as View;
use Model\ArticleModel as ArticleModel;
use Model\CategoryModel as CategoryModel;
use Core\CoreController;

class BlogController extends \Core\CoreController
{
    public  $Articles;
    public $Categories;
    public function __construct()
    {
        $this->View = new View();
        $this->Articles = new ArticleModel('article');
        $this->Categories = new CategoryModel('category');
    }

    public function index()
    {
        $articles = $this->Articles->getAll();
        $categories = $this->Categories->getAll();
        $atriclecategory = $this->Categories->setAtricleCategory($articles, $categories);
        $countpages = $this->Articles->count();
        $this->View->showAllArticle($atriclecategory, $categories);
    }

    public function view($id)
    {
        $article = $this->Articles->getById($id);
        $categories = $this->Categories->getAll();
        $this->View->showArticle($article,$categories);
    }

    public function cat($id_category)
    {
        $articles = $this->Articles->getArticleByIdCategory($id_category);
        $categories = $this->Categories->getAll();
        $selected_category = $this->Categories->getById($id_category);
        $this->View->showAllArticleByCategory($articles,$categories, $selected_category);
    }
}