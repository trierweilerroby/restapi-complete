<?php
namespace Services;

use Repositories\ReplyRepository;


class ReplyService {
    public function getAll() {
        $repository = new ReplyRepository();
        return $repository->getAll();
    }
    public function getAllPending($reply_to) {
        $repository = new ReplyRepository();
        return $repository->getAllPending($reply_to);
    }
    public function insertReply($reply) {
        $repository = new ReplyRepository();
        return $repository->insertReply($reply);
    }
    public function acceptReply($reply, $id) {
        $repository = new ReplyRepository();
        return $repository->acceptReply($reply, $id);
    }
    public function deleteReply($id) {
        $repository = new ReplyRepository();
        return $repository->deleteReply($id);
    }
}