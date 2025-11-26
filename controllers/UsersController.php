<?php

require_once 'models/UsersManager.php';
require_once 'models/DatesManager.php';
require_once 'models/SlotsManager.php';
require_once 'models/ServicesManager.php';
require_once 'models/AppointmentsManager.php';
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

        if (!$email || !$password) {
            header('Location:index.php?page=login&error=fields');
            exit;
        } else {
            $user = $usersManager->getUser($email);
            if (!$user) {
                header('Location:index.php?page=login&error=credentials');
                exit;
            } else if (!password_verify($password, $user->getPassword())) {
                header('Location:index.php?page=login&error=credentials');
                exit;
            } else {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_email'] = $user->getEmail();
                $_SESSION['user_role'] = $user->getRole();
                if ($_SESSION['user_role'] === 'patient') {
                    header('Location:index.php?page=appointment');
                    exit;
                } else
                    header('Location: index.php?page=admin');
                exit;
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

        if (!$email || !$password) {
            header('Location:index.php?page=first-login&error=fields');
            exit;
        } else {
            $user = $usersManager->getUser($email);
            if (!$user) {
                header('Location:index.php?page=first-login&error=credentials');
                exit;
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $usersManager->addPassword($password, $email);
                header('Location:index.php?page=login');
                exit;
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

        if (!$name || !$email || !$password || !$dateOfBirth || !$SSN || !$phone) {
            header('Location:index.php?page=register&error=fields');
            exit;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location:index.php?page=register&error=email-format');
            exit;
        } else if ($usersManager->emailAlreadyExists($email)) {
            header('Location:index.php?page=register&error=email-used');
            exit;
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $usersManager->register($name, $email, $password, $dateOfBirth, $SSN, $phone);
            header('Location:index.php?page=login');
            exit;
        }
    }
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location:index.php?page=home');
        exit;
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
        $id = $_SESSION['user_id'];

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
            }
        }

        require 'views/appointment.php';
    }

    public function appointmentDateValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_GET['id']) {
            $id = $_GET['id'];
        } else {
            $id = $_POST['name'];
        }
        $date = $_POST['date'] ?? null;
        $day = new DateTime($date);
        $id_day = (int) $day->format("N");
        $slotsManager = new SlotsManager();
        $slots = $slotsManager->getSlots($id_day) ?? null;
        $id_slot = $_GET['id_slot'] ?? null;
        if ($id_day > 5 && $_SESSION['user_role'] === 'patient') {
            header('Location: index.php?page=appointment&error=closed&date=' . $date);
            exit;
        } else if ($id_day > 5 && $_SESSION['user_role'] === 'pro') {
            header('Location: index.php?page=appointmentAdmin&error=closed&date=' . $date . '&id=' . $id);
            exit;
        } else if ($_SESSION['user_role'] === 'patient') {
            header('Location: index.php?page=appointment&id=' . $id . '&date=' . $date);
            exit;
        } else if (isset($_GET['id_slot'])) {
            header('Location: index.php?page=update-appointment&id_slot=' . $id_slot . '&date=' . $date . '&id=' . $id);
            exit;
        } else {
            header('Location: index.php?page=appointmentAdmin&id=' . $id . '&date=' . $date);
            exit;
        }
    }

    public function appointmentValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $date = $_GET['date'];
        $hour = $_POST['hour'];
        $day = new DateTime($date);
        $id_day = $day->format('N');

        $slotsManager = new SlotsManager();
        $slot = $slotsManager->getSlot($date, $hour) ?? null;
        if ($slot === null) {
            $id_slot = $slotsManager->createSlot($date, $hour, $id_day);

            $id_user = $_GET['id'];
            $id_service = $_POST['service'];
            $appointmentsManager = new AppointmentsManager();
            $appointmentsManager->createAppointment($id_user, $id_slot, $id_service);

            if ($_SESSION['user_role'] === 'patient') {
                header('Location: index.php?page=home&dateValidated=' . $date . '&hour=' . $hour);
                exit;
            } else {
                header('Location: index.php?page=admin&dateValidated=' . $date . '&hour=' . $hour . '&id_user=' . $id_user);
                exit;
            }
        } else {
            if ($_SESSION['user_role'] === 'patient') {
                header('Location: index.php?page=appointment&error=slotUsed');
                exit;
            } else {
                header('Location: index.php?page=appointmentAdmin&error=slotUsed');
                exit;
            }
        }
    }
}