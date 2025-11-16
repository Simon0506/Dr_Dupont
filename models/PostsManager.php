<?php

require_once 'models/Post.php';

class PostsManager
{
    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getPosts(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->query("SELECT * FROM posts");
        $articles = $request->fetchAll();
        $posts = [];
        foreach ($articles as $article) {
            $posts[] = new Post($article);
        }
        return $posts;
    }

    public function createPost(string $title, string $author, string $content, ?string $image, ?string $url)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("INSERT INTO posts (title, author, content, image, url) VALUES (?, ?, ?, ?, ?)");
        $request->execute([$title, $author, $content, $image, $url]);
    }

    public function deletePost(int $id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        $request->execute([$id]);
    }

    public function getPost(int $id): Post|null
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $request->execute([$id]);
        $article = $request->fetch();
        if (!$article) {
            return null;
        }

        return new Post($article);
    }

    public function updatePost(int $id, string $title, string $author, string $content, ?string $image, ?string $url)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE posts SET title = ?, author = ?, content = ?, image = ?, url = ? WHERE id = ?");
        $request->execute([$title, $author, $content, $image, $url, $id]);
    }

}