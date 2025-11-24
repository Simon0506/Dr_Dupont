<?php

require_once 'models/PostsManager.php';
require_once 'models/DatesManager.php';
require_once 'models/UsersManager.php';
require_once 'models/ServicesManager.php';
require_once 'models/AppointmentsManager.php';


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
        if (isset($_GET["id_user"])) {
            $users = new UsersManager();
            $user = $users->getPatient($_GET["id_user"]);
        }
        $today = new DateTime();
        $day = $_GET["date"] ?? $today->format('Y-m-d');
        $date = date('Y-m-d', strtotime($day));
        $slotsManager = new SlotsManager();
        $slots = $slotsManager->getSlots($date);
        usort($slots, function ($a, $b) {
            return strtotime($a->getHour()) - strtotime($b->getHour());
        });
        $data = [];
        foreach ($slots as $slot) {
            $appointmentsManager = new AppointmentsManager();
            $appointment = $appointmentsManager->getAppointment($slot->getId());
            if ($appointment) {
                $usersManager = new UsersManager();
                $servicesManager = new ServicesManager();

                $patient = $usersManager->getPatient($appointment->getId_user());
                $service = $servicesManager->getService($appointment->getId_service());
            } else {
                $patient = null;
                $service = null;
            }
            $data[] = [
                'id_slot' => $slot->getId(),
                'hour' => $slot->getHour(),
                'patient' => $patient,
                'service' => $service
            ];
        }
        require 'views/admin.php';

    }

    // Gestion des rendez-vous
    public function list()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $date = $_POST["date"];
        header("Location: index.php?page=admin&date=" . $date);
        exit;
    }
    public function appointmentAdmin()
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
        $date = $_GET["date"] ?? null;
        $id = $_GET["id"] ?? null;

        if ($date !== null) {
            $day = new DateTime($date);
            $id_day = (int) $day->format("N");
            if ($id_day <= 5) {
                $slotsManager = new SlotsManager();
                $hoursBooked = $slotsManager->getHours(date('Y-m-d', strtotime($date))) ?? null;
                $bookedHours = array_map(function ($hour) {
                    return $hour->getHour();
                }, $hoursBooked);
                $datesManager = new DatesManager();
                $day = $datesManager->getDate($id_day);
                $servicesManager = new ServicesManager();
                $services = $servicesManager->getServices();
                $interval = new DateInterval('PT30M');
            } else {
                header('Location: index.php?page=appointmentAdmin&error=' . $date);
                exit;
            }
        }

        require 'views/appointmentAdmin.php';
    }

    public function updateAppointment()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $id_slot = (int) $_GET["id_slot"];
        $appointmentsManager = new AppointmentsManager();
        $appointment = $appointmentsManager->getAppointment($id_slot);
        $usersManager = new UsersManager();
        $servicesManager = new ServicesManager();
        $users = $usersManager->getPatients();
        $patient = $usersManager->getPatient($appointment->getId_user());
        $serve = $servicesManager->getService($appointment->getId_service());
        $date = $_GET["date"];
        $day = new DateTime($date);
        $id_day = (int) $day->format("N");
        if ($id_day <= 5) {
            $slotsManager = new SlotsManager();
            $hoursBooked = $slotsManager->getHours(date('Y-m-d', strtotime($date))) ?? null;
            $bookedHours = array_map(function ($hour) {
                return $hour->getHour();
            }, $hoursBooked);
            $datesManager = new DatesManager();
            $day = $datesManager->getDate($id_day);
            $services = $servicesManager->getServices();
            $interval = new DateInterval('PT30M');
        } else {
            header('Location: index.php?page=update-appointment&error=' . $date);
            exit;
        }


        require 'views/update-appointment.php';
    }

    public function updateAppointmentValid()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $id_slot = (int) $_GET["id_slot"];
        $date = $_GET['date'];
        $hour = $_POST['hour'];
        $day = new DateTime($date);
        $id_day = $day->format('N');

        $slotsManager = new SlotsManager();
        $slot = $slotsManager->getSlot($date, $hour) ?? null;
        if ($slot === null) {
            $slotsManager->updateSlot($id_slot, $date, $hour, $id_day);

            $id_user = $_GET['id'];
            $id_service = $_POST['service'];
            $appointmentsManager = new AppointmentsManager();
            $appointmentsManager->updateAppointment($id_user, $id_slot, $id_service);

            header('Location: index.php?page=admin&dateUpdated=' . $date . '&hour=' . $hour . '&id_user=' . $id_user);
            exit;
        } else {
            header('Location: index.php?page=appointmentAdmin&error=slotUsed');
            exit;
        }

    }

    public function deleteAppointment()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        } else if ($_SESSION["user_role"] === "patient") {
            header("Location: index.php?page=home");
            exit;
        }
        $id_slot = (int) $_GET["id"];
        $slotsManager = new SlotsManager();
        $slotsManager->deleteSlot($id_slot);
        header("Location: index.php?page=admin");
        exit;
    }



    // Gestion des patients
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

        if (!$name || !$email || !$dateOfBirth || !$SSN || !$phone) {
            header('Location:index.php?page=create-patient&error=fields');
            exit;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location:index.php?page=create-patient&error=email-format');
            exit;
        } else if ($usersManager->emailAlreadyExists($email)) {
            header('Location:index.php?page=create-patient&error=email-used');
            exit;
        } else {
            $usersManager->addPatient($name, $email, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=patientsAdmin');
            exit;
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

        if (!$name || !$dateOfBirth || !$SSN || !$phone) {
            header('Location:index.php?page=update-patient&id=' . $id . '&error=fields');
            exit;
        } else {
            $usersManager->updatePatient($id, $name, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=patientsAdmin');
            exit;
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
        exit;
    }

    // Gestion des actualités
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
                exit;
            } else if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                header('Location:index.php?page=create-post&error=true');
                exit;
            } else if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                header('Location:index.php?page=create-post&error=true');
                exit;
            } else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/' . $newFileName);
            }
        }

        if (strlen($title) < 3 || strlen($author) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=create-post&error=true');
            exit;
        } else {
            $postsManager = new PostsManager();
            $postsManager->createPost($title, $author, $content, $newFileName ?? null, $url ?? null);
            header('Location: index.php?page=postsAdmin');
            exit;
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
        exit;
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
                exit;
            } else if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                header('Location:index.php?page=update-post&error=true');
                exit;
            } else if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                header('Location:index.php?page=update-post&error=true');
                exit;
            } else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/' . $newFileName);
            }
        }

        if (strlen($title) < 3 || strlen($author) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=update-post&error=true');
            exit;
        } else {
            $postsManager = new PostsManager();
            $postsManager->updatePost($id, $title, $author, $content, $newFileName ?? null, $url ?? null);
            header('Location: index.php?page=postsAdmin');
            exit;
        }
    }

    // Gestion des Horaires
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
            exit;
        }
        $id = $_GET["id"];
        $start = $_POST["start"];
        $end = $_POST["end"];


        $datesManager = new DatesManager();
        $datesManager->updateDate($id, $start, $end);
        $day = $datesManager->getDate($id);
        $name = $day->getName();
        header('Location: index.php?page=update-date&updated=' . $name);
        exit;
    }

    // Gestion des services
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

        if (!$name) {
            header('Location:index.php?page=create-service&error=fields');
            exit;
        } else {
            $servicesManager->createService($name, $description);
            header('Location:index.php?page=servicesAdmin');
            exit;
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

        if (!$name) {
            header('Location:index.php?page=update-service&id=' . $id . '&error=fields');
            exit;
        } else {
            $servicesManager->updateService($id, $name, $description);
            header('Location:index.php?page=servicesAdmin');
            exit;
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
        exit;
    }
}