<?php
namespace Services;

use Repositories\ArticleRepository;


class ArticleService {
    public function getAll($offset = NULL, $limit = NULL) {
        $repository = new ArticleRepository();
        return $repository->getAll();
    }
    public function insertArticle($article) {
        $repository = new ArticleRepository();
        return $repository->insertArticle($article);
    }
    public function deleteArticle($id) {
        $repository = new ArticleRepository();
        return $repository->deleteArticle($id);
    }
    public function getArticleById($id) {
        $repository = new ArticleRepository();
        return $repository->getById($id);
    }
}