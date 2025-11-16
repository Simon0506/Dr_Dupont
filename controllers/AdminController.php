<?php

require_once 'models/PostsManager.php';
require_once 'models/DatesManager.php';
require_once 'models/UsersManager.php';
require_once 'models/ServicesManager.php';


class AdminController
{
    public function admin()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        require 'views/admin.php';

    }
    public function appointmentsAdmin()
    {

        require 'views/appointmentsAdmin.php';
    }
    public function servicesAdmin()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }

        $servicesManager = new ServicesManager();
        $services = $servicesManager->getServices();
        require 'views/servicesAdmin.php';
    }
    public function postsAdmin()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }

        $postsManager = new PostsManager();
        $articles = $postsManager->getPosts();
        require 'views/postsAdmin.php';
    }
    public function patientsAdmin()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }

        $usersManager = new UsersManager();
        $patients = $usersManager->getPatients();
        require 'views/patientsAdmin.php';
    }

    public function createPatient()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        require 'views/create-patient.php';
    }

    public function createPatientValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $SSN = $_POST['SSN'];
        $phone = $_POST['phone'];
        $usersManager = new UsersManager();

        if (!$name || !$email || !$dateOfBirth || !$SSN || !$phone)
            header('Location:index.php?page=create-patient&error=fields');
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            header('Location:index.php?page=create-patient&error=email-format');
        else if ($usersManager->emailAlreadyExists($email))
            header('Location:index.php?page=create-patient&error=email-used');
        else {
            $usersManager->addPatient($name, $email, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=patientsAdmin');
        }
    }

    public function updatePatient()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php?page=patientsAdmin&error=nofile");
            exit;
        }
        $usersManager = new UsersManager();
        $patient = $usersManager->getPatient($_GET['id']);
        require 'views/update-patient.php';
    }

    public function updatePatientValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $id = $_GET["id"];
        $name = $_POST['name'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $SSN = $_POST['SSN'];
        $phone = $_POST['phone'];
        $usersManager = new UsersManager();

        if (!$name || !$dateOfBirth || !$SSN || !$phone)
            header('Location:index.php?page=update-patient&id=' . $id . '&error=fields');
        else {
            $usersManager->updatePatient($id, $name, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=patientsAdmin');
        }
    }

    public function deletePatient()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php");
            exit;
        }
        $id = $_GET["id"];
        $usersManager = new UsersManager();
        $usersManager->deletePatient($id);
        header("Location:index.php?page=patientsAdmin");
    }

    public function adminCreatePost()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        require 'views/create-post.php';
    }

    public function adminCreatePostValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $content = trim($_POST['content']);
        $url = trim($_POST['url']);

        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $fileName = 'assets/' . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!getimagesize($_FILES['image']['tmp_name'])) {
                header('Location:index.php?page=create-post&error=true');
            } else if ($_FILES['image']['size'] > 2 * 1024 * 1024)
                header('Location:index.php?page=create-post&error=true');
            else if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif']))
                header('Location:index.php?page=create-post&error=true');
            else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/' . $newFileName);
            }
        }

        if (strlen($title) < 3 || strlen($author) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=create-post&error=true');
        } else {
            $postsManager = new PostsManager();
            $postsManager->createPost($title, $author, $content, $newFileName ?? null, $url ?? null);
            header('Location: index.php?page=postsAdmin');
        }
    }
    public function deletePost()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php");
            exit;
        }
        $id = $_GET["id"];
        $postsManager = new PostsManager();
        $postsManager->deletePost($id);
        header("Location:index.php?page=postsAdmin");
    }

    public function updatePost()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php");
            exit;
        }
        $id = $_GET["id"];
        $postsManager = new PostsManager();
        $article = $postsManager->getPost($id);
        require 'views/update-post.php';
    }

    public function updatePostValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php");
            exit;
        }
        $id = $_GET["id"];
        $postsManager = new PostsManager();
        $article = $postsManager->getPost($id);

        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $content = trim($_POST['content']);
        $url = trim($_POST['url']);

        if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
            $fileName = 'assets/' . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!getimagesize($_FILES['image']['tmp_name'])) {
                header('Location:index.php?page=update-post&error=true');
            } else if ($_FILES['image']['size'] > 2 * 1024 * 1024)
                header('Location:index.php?page=update-post&error=true');
            else if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif']))
                header('Location:index.php?page=update-post&error=true');
            else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/' . $newFileName);
            }
        }

        if (strlen($title) < 3 || strlen($author) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=update-post&error=true');
        } else {
            $postsManager = new PostsManager();
            $postsManager->updatePost($id, $title, $author, $content, $newFileName ?? null, $url ?? null);
            header('Location: index.php?page=postsAdmin');
        }
    }

    public function updateDate()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }

        $datesManager = new DatesManager();
        $days = $datesManager->getDates();
        require 'views/update-date.php';
    }

    public function updateDateValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!$_GET["id"]) {
            header("Location: index.php?page=update-date&error=noId");
        }
        $id = $_GET["id"];
        $start = $_POST["start"];
        $end = $_POST["end"];


        $datesManager = new DatesManager();
        $datesManager->updateDate($id, $start, $end);
        $day = $datesManager->getDate($id);
        $name = $day->getName();
        header('Location: index.php?page=update-date&updated=' . $name);
    }

    public function createService()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        require 'views/create-service.php';
    }

    public function createServiceValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $name = $_POST['name'];
        $description = $_POST['description'];
        $servicesManager = new ServicesManager();

        if (!$name)
            header('Location:index.php?page=create-service&error=fields');
        else {
            $servicesManager->createService($name, $description);
            header('Location:index.php?page=servicesAdmin');
        }
    }

    public function updateService()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php?page=servicesAdmin&error=true");
            exit;
        }
        $servicesManager = new ServicesManager();
        $service = $servicesManager->getService($_GET['id']);
        require 'views/update-service.php';
    }

    public function updateServiceValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $id = $_GET["id"];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $servicesManager = new ServicesManager();

        if (!$name)
            header('Location:index.php?page=update-service&id=' . $id . '&error=fields');
        else {
            $servicesManager->updateService($id, $name, $description);
            header('Location:index.php?page=servicesAdmin');
        }
    }

    public function deleteService()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        if (!isset($_GET["id"])) {
            header("Location:index.php");
            exit;
        }
        $id = $_GET["id"];
        $servicesManager = new ServicesManager();
        $servicesManager->deleteService($id);
        header("Location:index.php?page=servicesAdmin");
    }
}