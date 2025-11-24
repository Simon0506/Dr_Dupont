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
else if ($page === "register")
    $usersController->register();
else if ($page === "register-valid")
    $usersController->registerValid();
else if ($page === "about")
    $postsController->about();
else if ($page === "login")
    $usersController->login();
else if ($page === "login-valid")
    $usersController->loginValid();
else if ($page === "first-login")
    $usersController->firstLogin();
else if ($page === "first-login-valid")
    $usersController->firstLoginValid();
else if ($page === "logout")
    $usersController->logout();
else if ($page === "appointment")
    $usersController->appointment();
else if ($page === "appointment-date-valid")
    $usersController->appointmentDateValid();
else if ($page === "appointment-valid")
    $usersController->appointmentValid();
else if ($page === "admin")
    $adminController->admin();
else if ($page === "list")
    $adminController->list();
else if ($page === "appointmentAdmin")
    $adminController->appointmentAdmin();
else if ($page === "update-appointment")
    $adminController->updateAppointment();
else if ($page === "update-appointment-valid")
    $adminController->updateAppointmentValid();
else if ($page === "delete-appointment")
    $adminController->deleteAppointment();
else if ($page === "postsAdmin")
    $adminController->postsAdmin();
else if ($page === "services")
    $postsController->services();
else if ($page === "servicesAdmin")
    $adminController->servicesAdmin();
else if ($page === "create-service")
    $adminController->createService();
else if ($page === "create-service-valid")
    $adminController->createServiceValid();
else if ($page === "update-service")
    $adminController->updateService();
else if ($page === "update-service-valid")
    $adminController->updateServiceValid();
else if ($page === "delete-service")
    $adminController->deleteService();
else if ($page === "patientsAdmin")
    $adminController->patientsAdmin();
else if ($page === "create-patient")
    $adminController->createPatient();
else if ($page === "create-patient-valid")
    $adminController->createPatientValid();
else if ($page === "update-patient")
    $adminController->updatePatient();
else if ($page === "update-patient-valid")
    $adminController->updatePatientValid();
else if ($page === "delete-patient")
    $adminController->deletePatient();
else if ($page === "create-post")
    $adminController->adminCreatePost();
else if ($page === "create-post-valid")
    $adminController->adminCreatePostValid();
else if ($page === "news")
    $postsController->news();
else if ($page === "article")
    $postsController->article();
else if ($page === "delete-post")
    $adminController->deletePost();
else if ($page === "update-post")
    $adminController->updatePost();
else if ($page === "update-post-valid")
    $adminController->updatePostValid();
else if ($page === "update-date")
    $adminController->updateDate();
else if ($page === "update-date-valid")
    $adminController->updateDateValid();