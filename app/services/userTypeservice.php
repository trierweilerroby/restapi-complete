<?php 

namespace Services;

use Repositories\UserTypeRepository;


class UserTypeService {
    public function getAll() {
        $repository = new UserTypeRepository();
        return $repository->getAll();
    }
}
?>