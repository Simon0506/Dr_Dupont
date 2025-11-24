<?php

require_once "models/PostsManager.php";
require_once "models/DatesManager.php";
require_once "models/ServicesManager.php";


class PostsController
{
    public function home()
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->getServices();
        $datesManager = new DatesManager();
        $days = $datesManager->getDates();
        require 'views/home.php';
    }


    public function news()
    {
        $postsManager = new PostsManager();
        $articles = $postsManager->getPosts();

        require 'views/news.php';
    }
    public function article()
    {
        $postsManager = new PostsManager();
        $article = $postsManager->getPost($_GET['id']);

        require 'views/article.php';
    }

    public function services()
    {
        $servicesManager = new ServicesManager();
        $services = $servicesManager->getServices();
        require 'views/services.php';
    }

    public function about()
    {
        require 'views/about.php';
    }
}