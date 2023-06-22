<?php
namespace Controllers;

use Services\ArticleService;
use Models\Article;

class ArticleController extends Controller
{
    private $articleService;

    function __construct()
    {
        $this->articleService = new ArticleService();
    }

    public function getAll()
    {
        $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } 
        $article = $this->articleService->getAll();
        $this->respond($article);
    }
    public function getAllByAuthor($author){
        $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } 
        $article = $this->articleService->getAllByAuthor($author);
        $this->respond($article);
    }
    public function insertArticle(){
        $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        }
        $article = $this->createObjectFromPostedJson("Models\Article");
        $article = $this->articleService->insertArticle($article);
        $this->respond($article);
    }
    public function updateArticle($id){
        $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        }
        $article = $this->articleService->getArticleById($id);
        if(!$article){
            $this->respondWithError(404, "Article not found");
            return;
        }
        $postedarticle = $this->createObjectFromPostedJson("Models\\Article");
        $article = $this->articleService->updateArticle($postedarticle, $id);
        $this->respond($article);
    }
    public function deleteArticle($id){
       $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        }
        $article = $this->articleService->getArticleById($id);
        $this->articleService->deleteArticle($id);
        $this->respond($article);
    }
    public function getArticleById($id){
        $article = $this->articleService->getArticleById($id);
        $this->respond($article);
    }

}