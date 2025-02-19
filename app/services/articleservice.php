<?php
namespace Services;

use Repositories\ArticleRepository;


class ArticleService {
    public function getAll($offset = NULL, $limit = NULL) {
        $repository = new ArticleRepository();
        return $repository->getAll();
    }
    public function getAllByAuthor($author) {
        $repository = new ArticleRepository();
        return $repository->getAllByAuthor($author);
    }
    public function insertArticle($article) {
        $repository = new ArticleRepository();
        return $repository->insertArticle($article);
    }
    public function updateArticle($article, $id) {
        $repository = new ArticleRepository();
        return $repository->updateArticle($article ,$id);
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