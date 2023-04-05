<?php

namespace Models;
class Reply {
    public int $id;
    public string $title;
    public string $content;
    public string $reply_from;
    public string $reply_to;
	public string $posted_at;
    public int $article_id; 
	public int $accept;

}

?>