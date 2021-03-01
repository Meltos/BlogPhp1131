<?php


namespace View;


class BlogView extends \Core\CoreView
{
    public function showAllArticle($articles, $categories)
    {
        echo $this->twig->render('/front-end/main.twig', ['article_list'=>$articles, 'category_list'=>$categories, 'page_title'=>'Главная']);
    }

    public function showArticle($article, $categories)
    {
        echo $this->twig->render('/front-end/blog.twig', ['article'=>$article, 'category_list'=>$categories]);
    }

    public function showAllArticleByCategory($articles, $categories, $selected_category)
    {
        echo $this->twig->render('/front-end/category.twig', ['article_list'=>$articles, 'category_list'=>$categories, 'selected_category' => $selected_category]);
    }
}