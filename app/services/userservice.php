<?php
namespace Services;

use Repositories\UserRepository;


class UserService {
    public function getAll() {
        $repository = new UserRepository();
        return $repository->getAll();
    }
    public function insertUser($user) {
        $repository = new UserRepository();
        return $repository->insertUser($user);
    }
    public function updateUser($user, $id) {
        $repository = new UserRepository();
        return $repository->updateUser($user ,$id);
    }
    public function getUserById($id) {
        $repository = new UserRepository();
        return $repository->getUserById($id);
    }
    public function deleteUser($id) {
        $repository = new UserRepository();
        return $repository->deleteUser($id);
    }
    public function checkLogin($username, $password) {
        $repository = new UserRepository();
        return $repository->checkLogin($username, $password);
    }
}