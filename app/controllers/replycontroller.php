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
    public function getAllPending($reply_to)
    {
        $reply = $this->ReplyService->getAllPending($reply_to);
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
        $reply = $this->ReplyService->deleteReply($id);
        $this->respond($reply);
    }
}

?>