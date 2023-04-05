<?php
namespace Controllers;

use Services\UserTypeService;
use Models\UserType;

class userTypeController extends Controller
{

    private $userTypeService;

    function __construct()
    {
        $this->userTypeService = new UserTypeService();
    }

    public function getAll()
    {
        $userType = $this->userTypeService->getAll();
        $this->respond($userType);
    }
}

?>