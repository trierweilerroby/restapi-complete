<?php

namespace Models;

class Article {

    public int $id;
    public string $title;
    public string $content;
    public int $author;
    public User $author_user;
    public string $posted_at;
	public int $salary; 
}
