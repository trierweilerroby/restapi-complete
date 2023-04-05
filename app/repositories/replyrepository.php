<?php 

namespace Repositories;

use PDO;
use PDOException;
use Models\Reply;

class ReplyRepository extends Repository{
    public function getAll() {
        $sql = "SELECT * FROM reply";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Reply');
        $replys = $stmt->fetchAll();
        return $replys;
    }
    public function insertReply($reply){
        try{
            $sql = "INSERT INTO `reply`(`content`, `reply_from`, `reply_to`, `posted_at`, `article_id`, `accept`) VALUES (:content, :reply_from, :reply_to, now(), :article_id, :accept)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':content', $reply->content);
            $stmt->bindParam(':reply_from', $reply->reply_from);
            $stmt->bindParam(':reply_to', $reply->reply_to);
            $stmt->bindParam(':article_id', $reply->article_id);
            $stmt->bindParam(':accept', $reply->accept);
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
    public function deleteReply($reply,$id){
        try{
            $sql = "DELETE FROM `reply` WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $reply;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }


}

?>