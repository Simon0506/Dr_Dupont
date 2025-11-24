<?php

class Post
{
    private int $id;
    private string $title;
    private string $content;
    private string $author;
    private ?string $url;
    private ?string $image;
    private string $description;
    private function limitWords($text, $limit = 30)
    {
        $word = explode(' ', strip_tags($text));
        if (count($word) > $limit) {
            $word = array_slice($word, 0, $limit);
            $text = implode(' ', $word) . '...';
        }
        return $text;
    }
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->content = $data["content"];
        $this->author = $data["author"];
        $this->url = $data["url"] ?? null;
        $this->image = $data["image"] ?? null;
        $this->description = $this->limitWords($data['content'], 30);
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
    public function getDescription()
    {
        return $this->description;
    }
}