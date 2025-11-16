<?php

require_once 'models/UsersManager.php';
require_once 'models/DatesManager.php';
require_once 'models/SlotsManager.php';
require_once 'models/ServicesManager.php';
class UsersController
{
    public function login()
    {
        require 'views/login.php';
    }
    public function loginValid()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usersManager = new UsersManager();

        if (!$email || !$password)
            header('Location:index.php?page=login&error=fields');
        else {
            $user = $usersManager->getUser($email);
            if (!$user)
                header('Location:index.php?page=login&error=credentials');
            else if (!password_verify($password, $user->getPassword()))
                header('Location:index.php?page=login&error=credentials');
            else {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_email'] = $user->getEmail();
                $_SESSION['user_role'] = $user->getRole();
                header('Location:index.php?page=home');
            }
        }
    }

    public function firstLogin()
    {
        require 'views/first-login.php';
    }
    public function firstLoginValid()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usersManager = new UsersManager();

        if (!$email || !$password)
            header('Location:index.php?page=first-login&error=fields');
        else {
            $user = $usersManager->getUser($email);
            if (!$user)
                header('Location:index.php?page=first-login&error=credentials');
            else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $usersManager->addPassword($password, $email);
                header('Location:index.php?page=login');
            }
        }
    }
    public function register()
    {
        require 'views/register.php';
    }
    public function registerValid()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $SSN = $_POST['SSN'];
        $phone = $_POST['phone'];
        $usersManager = new UsersManager();

        if (!$name || !$email || !$password || !$dateOfBirth || !$SSN || !$phone)
            header('Location:index.php?page=register&error=fields');
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            header('Location:index.php?page=register&error=email-format');
        else if ($usersManager->emailAlreadyExists($email))
            header('Location:index.php?page=register&error=email-used');
        else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $usersManager->register($name, $email, $password, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=login');
        }
    }
    public function registerAdmin()
    {
        require 'views/registerAdmin.php';
    }
    public function registerAdminValid()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usersManager = new UsersManager();

        if (!$name || !$email || !$password)
            header('Location:index.php?page=registerAdmin&error=fields');
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            header('Location:index.php?page=registerAdmin&error=email-format');
        else if ($usersManager->emailAlreadyExists($email))
            header('Location:index.php?page=registerAdmin&error=email-used');
        else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $usersManager->registerAdmin($name, $email, $password);
            header('Location:index.php?page=admin');
        }
    }
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location:index.php?page=home');
    }

    public function appointment()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location:index.php?page=login");
            exit;
        }
        $usersManager = new UsersManager();
        $user = $usersManager->getUser($_SESSION["user_email"]);
        $date = $_GET["date"] ?? null;

        if ($date !== null) {
            $time = new DateTime();
            $day = new DateTime($date);
            $id_day = (int) $day->format("N");
            $slotsManager = new SlotsManager();
            $slots = $slotsManager->getSlots($id_day) ?? null;
            $datesManager = new DatesManager();
            $day = $datesManager->getDate($id_day);
            $servicesManager = new ServicesManager();
            $services = $servicesManager->getServices();
        }

        require 'views/appointment.php';
    }

    public function appointmentDateValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $id = $_GET['id'];
        $date = $_POST['date'] ?? null;
        header('Location: index.php?page=appointment&id=' . $id . '&date=' . $date);
    }

    public function appointmentValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $date = $_GET['date'];
        $hour = $_POST['hour'];
        $id_day = $date->format('N');




        $slotsManager = new SlotsManager();
        $slotsManager->createSlot($date, $hour, $id_day);

        $id_user = $_GET['id'];
        $id_service = $_POST['service'];
        $id_slot = $_POST['slot'];
        $appointmentsManager = new AppointmentsManager();
        $appointmentsManager->createAppointment($id_user, $id_slot, $id_service);

        // id_slot à définir et mettre à jour la page de rdv avec les services
    }
}