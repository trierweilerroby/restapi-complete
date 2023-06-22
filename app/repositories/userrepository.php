<?php
namespace Repositories;
use PDO;
use PDOException;
use Models\User;

class UserRepository extends Repository{
    public function getAll() {
        $sql = "SELECT * FROM user";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
        $user = $stmt->fetchAll();
        return $user;
    }
    public function insertUser($user){
        try{
            $sql = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `type_id`, `password`, `certificate`, `job_type`) VALUES (:firstname, :lastname, :email, :type_id, :password, :certificate, :job_type)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':firstname', $user->firstname);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':type_id', $user->type_id);
            $hashedPassword = $this->hashPassword($user->password);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':certificate', $user->certificate);
            $stmt->bindParam(':job_type', $user->job_type);
            $stmt->execute();
            return $user;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }

    public function promoteUser($id){
        try{
            $sql = "UPDATE `user` SET `type_id`= 1 WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $id;
    
        }
        catch(PDOException $e){
            echo $e;

    
        }
        catch(PDOException $e){
            echo $e;
        }
    }

    public function getUserById($id){
        $sql = "SELECT * FROM user WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
        $user = $stmt->fetch();
        return $user;
    }
    public function deleteUser($id){
        try{
            $sql = "DELETE FROM `user` WHERE id = :id;
            DELETE FROM `article` WHERE author = :id;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $id;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function checkLogin($email, $password){
        try{
            $sql = "SELECT * FROM `user` WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();
    
            if($user){
                if($this->verifyPassword($password, $user->password)){
                    return $user;
                }
            }
            $user->password = null;
            return $user;
        }catch(PDOException $e){
            echo $e;
        }
    }

    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }


}


?>