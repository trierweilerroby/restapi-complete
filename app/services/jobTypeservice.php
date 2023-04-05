<?php 

namespace Services;

use Repositories\JobTypeRepository;


class JobTypeService {
    public function getAll() {
        $repository = new JobTypeRepository();
        return $repository->getAll();
    }
    public function insertJobType($jobType) {
        $repository = new JobTypeRepository();
        return $repository->insertJobType($jobType);
    }
}
?>