<?php

class Post
{
    private int $id;
    private string $title;
    private string $content;
    private string $author;
    private ?string $url;
    private ?string $image;

    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->content = $data["content"];
        $this->author = $data["author"];
        $this->url = $data["url"] ?? null;
        $this->image = $data["image"] ?? null;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getImage()
    {
        return $this->image;
    }
}