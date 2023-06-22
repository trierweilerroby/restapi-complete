<?php

namespace Models;
class Reply {
    public int $id;
    public string $content;
    public string $reply_from;
    public User $reply_from_user;
    public string $reply_to;
    public User $reply_to_user;
	public string $posted_at;
    public int $article_id; 
    public Article $article;
	public int $accept;

}

?>