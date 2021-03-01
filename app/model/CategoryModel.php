<?php


namespace Model;


class CategoryModel extends \Core\CoreModel
{
    public function setAtricleCategory($articles, $categories)
    {
        $articlecategories = array();
        foreach ($articles as $article)
        {
            foreach ($categories as $category)
            {

                if ($article['id_category'] == $category['id'])
                {
                    $article['category'] = $category;
                    $articlecategories[] = $article;
                    break;
                }
            }
        }
        return $articlecategories;
    }
}