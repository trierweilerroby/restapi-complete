<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// Define routes

$router->get('/articles', 'ArticleController@getAll');//get all articles
$router->post('/articles/insert', 'ArticleController@insertArticle');//insert article
$router->delete('/articles/delete/(\d+)', 'ArticleController@deleteArticle');


$router->get('/jobtypes', 'JobTypeController@getAll');//get all jobtypes
$router->post('/jobtypes/insert', 'JobTypeController@insertJobType');//insert jobtype

$router->get('/usertypes', 'UserTypeController@getAll');//get all usertypes

$router->get('/replys', 'ReplyController@getAll');//get all replys
$router->post('/replys/insert', 'ReplyController@insertReply');//insert reply
$router->put('/replys/accept/(\d+)', 'ReplyController@acceptReply');//accept reply
$router->delete('/replys/delete/(\d+)', 'ReplyController@deleteReply');


// routes for the users endpoint
$router->get('/users/login', 'UserController@login');
$router->get('/users', 'UserController@getAll');//get all users
$router->post('/users/register', 'UserController@insertUser');//register user
$router->put('/users/update/(\d+)', 'UserController@updateUser');//update user
$router->get('/users/CurrentUser/(\d+)', 'UserController@getUserById');//get user by id
$router->delete('/users/delete/(\d+)', 'UserController@deleteUser');

// Run it!
$router->run();