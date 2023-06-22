<?php
namespace Repositories;

use Models\Article;
use PDO;
use PDOException;
use Repositories\Repository;

class ArticleRepository extends Repository {

    public function rowArticle($row) {
        $article = new Article();
        $article->id = $row['id'];
        $article->title = $row['title'];
        $article->content = $row['content'];
        $article->author = $row['author'];
        $article->posted_at = $row['posted_at'];
        $article->salary = $row['salary'];
    
        
        $userRep = new UserRepository();
        $user = $userRep->getUserById($row['author']);
        $article->author_user = $user;

        return $article;
    }

    function getAll() {
        try {
            $sql = "SELECT a.*, u.firstname as author_firstname, u.lastname as author_lastname FROM article as a join user as u on a.author = u.id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $articles = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $articles[] = $this->rowArticle($row);
            }

            return $articles;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getAllByAuthor($author) {
        try {
            $sql = "SELECT a.*, u.firstname as author_firstname, u.lastname as author_lastname FROM article as a join user as u on a.author = u.id WHERE author = :author";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':author', $author);
            $stmt->execute();
            $articles = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $articles[] = $this->rowArticle($row);
            }

            return $articles;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM `article` WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $article = $this->rowArticle($row);
            return $article;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertArticle($article) {
        try {
            $sql = "INSERT INTO `article`(`title`, `content`, `author`, `posted_at`, `salary`) VALUES (:title, :content, :author, now(), :salary)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':title', $article->title);
            $stmt->bindParam(':content', $article->content);
            $stmt->bindParam(':author', $article->author);
            $stmt->bindParam(':salary', $article->salary);
            $stmt->execute();
            return $article;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateArticle($article, $id){
        try {
            $sql = "UPDATE `article` SET `title`=:title,`content`=:content,`author`=:author,`posted_at`=now(),`salary`=:salary WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':title', $article->title);
            $stmt->bindParam(':content', $article->content);
            $stmt->bindParam(':author', $article->author);
            $stmt->bindParam(':salary', $article->salary);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $article;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function deleteArticle($id) {
        try {
            $sql = "DELETE FROM `article` WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

}   