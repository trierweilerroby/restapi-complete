<?php
namespace Controllers;

use Services\ReplyService;
use Models\Reply;

class ReplyController extends Controller
{

    private $ReplyService;

    function __construct()
    {
        $this->ReplyService = new ReplyService();
    }

    public function getAll()
    {
        $reply = $this->ReplyService->getAll();
        $this->respond($reply);
    }
    public function insertReply(){
        $reply = $this->createObjectFromPostedJson("Models\Reply");
        $reply = $this->ReplyService->insertReply($reply);
        $this->respond($reply);
    }
    public function acceptReply($id){
        $reply = $this->createObjectFromPostedJson("Models\Reply");
        $reply = $this->ReplyService->acceptReply($reply, $id);
        $this->respond($reply);
    }
    public function deleteReply($id){
        $reply = $this->createObjectFromPostedJson("Models\Reply");
        $reply = $this->ReplyService->deleteReply($reply, $id);
        $this->respond($reply);
    }
}

?>