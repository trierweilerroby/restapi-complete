<?php
namespace Controllers;

use Services\JobTypeService;
use Models\JobType;

class JobTypeController extends Controller
{

    private $jobTypeService;

    function __construct()
    {
        $this->jobTypeService = new JobTypeService();
    }

    public function getAll()
    {
        /*$jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } elseif ($jwt->user_type != 1) {
            $this->respondWithError(401, "You are not allowed here, Admin only");
            return;
        }*/

        $jobType = $this->jobTypeService->getAll();
        $this->respond($jobType);
    }
    public function insertJobType(){
        $jobType = $this->createObjectFromPostedJson("Models\JobType");
        $jobType = $this->jobTypeService->insertJobType($jobType);
        $this->respond($jobType);
    }
}

?>