<?php


namespace Model;


class ArticleModel extends \Core\CoreModel
{
    public function getArticleByIdCategory($id)
    {
        $result = array();
        $sql = "SELECT * FROM ". $this->table." WHERE id_category= :id_category";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_category", $id, \PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        if(empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    public function AddArticle($title, $img, $category, $description, $html)
    {
        $sql = "INSERT INTO ".$this->table." (`title`, `id_category`, `description`, `text`, `imgpath`) VALUES (:title, :id_category, :description, :text, :imgpath)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title'=>$title, ':id_category'=>$category, ':description'=>$description, ':text'=>$html, ':imgpath'=>$img]);
    }

    public function ArticleDelete($id)
    {
        $sql = "DELETE FROM ".$this->table." WHERE `id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }

    public function ArticleEdit($id, $title, $img, $category, $description)
    {
        $sql = "UPDATE ".$this->table." SET `title` = :title, `id_category` = :id_category, `description` = :description, `imgpath` = :imgpath WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['title'=> $title, 'id_category'=>$category, 'description'=>$description, 'imgpath'=>$img, 'id'=>$id]);
    }

    public function PageCount()
    {
        $countpage = 0;
        $countarticles = $this->count();
        $countarticles = $countarticles / 10;
        // попытка создать пагинацию

    }
}