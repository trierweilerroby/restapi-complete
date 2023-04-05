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
        /*$jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } elseif ($jwt->user_type != 1) {
            $this->respondWithError(401, "You are not allowed here, Admin only");
            return;
        }*/
        $article = $this->articleService->getAll();
        $this->respond($article);
    }
    public function insertArticle(){
       /* $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } elseif ($jwt->user_type != 2) {
            $this->respondWithError(401, "You are not allowed here, Entrepreneur only");
            return;
        }*/
        $article = $this->createObjectFromPostedJson("Models\Article");
        $article = $this->articleService->insertArticle($article);
        $this->respond($article);
    }
    public function deleteArticle($id){
        $jwt = $this->checkForJwt();
        if ($jwt == null) {
            return;
        } elseif ($jwt->user_type != 2) {
            $this->respondWithError(401, "You are not allowed here, Entrepreneur only");
            return;
        }
        $article = $this->articleService->deleteArticle($id);
        $this->respond($article);
    }

}