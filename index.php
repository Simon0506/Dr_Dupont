<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_error", 1);

require_once 'controllers/AdminController.php';
require_once 'controllers/PostsController.php';
require_once 'controllers/UsersController.php';

$postsController = new PostsController();
$adminController = new AdminController();
$usersController = new UsersController();

$page = $_GET["page"] ?? "home";

if ($page === "home")
    $postsController->home();