<?php 

namespace Repositories;

use PDO;
use PDOException;
use Models\JobType;

class JobTypeRepository extends Repository{
    public function getAll() {
        $sql = "SELECT * FROM jobTypes";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\JobType');
        $jobTypes = $stmt->fetchAll();
        return $jobTypes;
    }
    public function insertJobType($jobType){
        try{
            $sql = "INSERT INTO `jobTypes`(`job_type`) VALUES (:job_type)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':job_type', $jobType->name);
            $stmt->execute();
            return $jobType;
    
        }
        catch(PDOException $e){
            echo $e;
        }
    }

}

?>