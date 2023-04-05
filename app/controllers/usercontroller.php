<?php

namespace Controllers;

use Services\UserService;
use Models\User;

class UserController extends Controller
{
    
        private $userService;
    
        function __construct()
        {
            $this->userService = new UserService();
        }
    
        public function getAll()
        {
           /* $jwt = $this->checkForJwt();
            if ($jwt == null) {
                return;
            } elseif ($jwt->user_type != 1) {
                $this->respondWithError(401, "You are not allowed here, Admin only");
                return;
            }*/
            $user = $this->userService->getAll();
            $this->respond($user);
        }
        public function insertUser(){
            $posteduser = $this->createObjectFromPostedJson("Models\\User");
            $user = $this->userService->insertUser($posteduser);
            $this->respond($user);
        }
        public function updateUser($id){
            /*$jwt = $this->checkForJwt();
            if (!$jwt) {
                return;
            }*/
            try{
                $user = $this->userService->getUserById($id);
                if(!$user){
                    $this->respondWithError(404, "User not found");
                    return;
                }
                $posteduser = $this->createObjectFromPostedJson("Models\\User");
                $user = $this->userService->updateUser($posteduser, $id);
            }catch(Exception $e){
                $this->respondWithError(500, "Something went wrong");
            }
            $this->respond($user);    
        }
        public function getUserById($id){
            $user = $this->userService->getUserById($id);
            $this->respond($user);
        }
        public function deleteUser($id){
            $jwt = $this->checkForJwt();
            if (!$jwt) {
                return;
            }
            $user = $this->userService->getUserById($id);
            if(!$user){
                $this->respondWithError(404, "User not found");
                return;
            }
            $user = $this->userService->deleteUser($id);
            $this->respond($user);
        }
        public function checkLogin($email, $password){
            $postedUser = $this->createObjectFromPostedJson("Models\\User");
            $user = $this->userService->checkLogin($postedUser->email, $postedUser->password);
            if(!$user){
                $this->respondWithError(404, "SORRY, There is no User with this email and password");
                return;
            }

            $tokenResponse = $this->generateJwt($user);
            $this->respond($tokenResponse);
        }
        public function generateJwt($user){
            $secret_key = "webdev2-roby";

            $issuer = "Jobster";
            $issuedAt = time();
            $notBefore = $issuedAt;
            $expire = $notBefore + 1500;

            $payload = array(
                "iss" => $issuer,
                "iat" => $issuedAt,
                "nbf" => $notBefore,
                "exp" => $expire,
                "data" => array(
                    "id" => $user->id,
                    "email" => $user->email,
                    "user_type" => $user->user_type
                )
            );

            $jwt = JWT::encode($payload, $secret_key, 'HS256');

            return array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "firstname" => $user->firstname,
                "lastname" => $user->lastname,
                "user_id" => $user->id,
                "user_type" => $user->user_type,
                "expireAt" => $expire
            );
        }

}

?>