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
$router->get('/articles/author/(\d+)', 'ArticleController@getAllByAuthor');//get all articles by author
$router->get('/articles/(\d+)', 'ArticleController@getArticleById');//get article by id
$router->post('/articles/insert', 'ArticleController@insertArticle');//insert article
$router->delete('/articles/delete/(\d+)', 'ArticleController@deleteArticle');
$router->put('/articles/update/(\d+)', 'ArticleController@updateArticle');



$router->get('/jobtypes', 'JobTypeController@getAll');//get all jobtypes
$router->post('/jobtypes/insert', 'JobTypeController@insertJobType');//insert jobtype

$router->get('/usertypes', 'UserTypeController@getAll');//get all usertypes

$router->get('/replys/(\d+)', 'ReplyController@getAllPending');//get all replys
$router->post('/replys/insert', 'ReplyController@insertReply');//insert reply
$router->put('/replys/accept/(\d+)', 'ReplyController@acceptReply');//accept reply
$router->delete('/replys/delete/(\d+)', 'ReplyController@deleteReply');//delete reply


// routes for the users endpoint
$router->post('/users/login', 'UserController@checkLogin');//login user
$router->get('/users', 'UserController@getAll');//get all users
$router->post('/users/register', 'UserController@insertUser');//register user
$router->get('/users/CurrentUser/(\d+)', 'UserController@getUserById');//get user by id
$router->delete('/users/delete/(\d+)', 'UserController@deleteUser');
$router->put('/users/promote/(\d+)', 'UserController@promoteUser');

// Run it!
$router->run();