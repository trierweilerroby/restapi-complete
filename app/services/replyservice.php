<?php
namespace Services;

use Repositories\ReplyRepository;


class ReplyService {
    public function getAll() {
        $repository = new ReplyRepository();
        return $repository->getAll();
    }
    public function insertReply($reply) {
        $repository = new ReplyRepository();
        return $repository->insertReply($reply);
    }
    public function acceptReply($reply, $id) {
        $repository = new ReplyRepository();
        return $repository->acceptReply($reply, $id);
    }
    public function deleteReply($reply,$id) {
        $repository = new ReplyRepository();
        return $repository->deleteReply($reply, $id);
    }
}