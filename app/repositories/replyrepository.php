<?php 

namespace Repositories;

use PDO;
use PDOException;
use Models\Reply;

class ReplyRepository extends Repository{

    public function row($row)
    {
        $reply = new Reply();
        $reply->id = $row['id'];
        $reply->content = $row['content'];
        $reply->reply_from = $row['reply_from'];
        $reply->reply_to = $row['reply_to'];
        $reply->posted_at = $row['posted_at'];
        $reply->article_id = $row['article_id'];
        $reply->accept = $row['accept'];

        $userRep = new UserRepository();
        $reply->reply_from_user = $userRep->getUserById($reply->reply_from);
        $reply->reply_to_user = $userRep->getUserById($reply->reply_to);

        $articleRep = new ArticleRepository();
        $reply->article = $articleRep->getById($reply->article_id);
        return $reply;
    }
    public function getAll() {
        $sql = "SELECT * FROM reply";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $replys = array();
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $replys[] = $this->row($row);
        }
        return $replys;
    }
    public function getAllPending($reply_to){
        $sql = "SELECT * FROM reply WHERE accept = 0 AND reply_to = :reply_to";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':reply_to', $reply_to);
        $stmt->execute();
        $replys = array();
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $replys[] = $this->row($row);
        }
        return $replys;
    }

    
    public function insertReply($reply){
        try{
            $sql = "INSERT INTO `reply`(`content`, `reply_from`, `reply_to`, `posted_at`, `article_id`, `accept`) VALUES (:content, :reply_from, :reply_to, now(), :article_id, 0)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':content', $reply->content);
            $stmt->bindParam(':reply_from', $reply->reply_from);
            $stmt->bindParam(':reply_to', $reply->reply_to);
            $stmt->bindParam(':article_id', $reply->article_id);
            $stmt->execute();
            return $reply;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function acceptReply($reply, $id){
        try{
            $sql = "UPDATE `reply` SET `accept`= 1 WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $reply;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function deleteReply($id){
        try{
            $sql = "DELETE FROM `reply` WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }


}

?>