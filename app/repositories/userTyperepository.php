<?php 

namespace Repositories;

use PDO;
use PDOException;
use Models\UserType;

class UserTypeRepository extends Repository{
    public function getAll() {
        $sql = "SELECT * FROM usertype";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserType');
        $userTypes = $stmt->fetchAll();
        return $userTypes;
    }

}

?>