<?php

require_once 'models/User.php';
class UsersManager
{
    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    public function emailAlreadyExists(string $email): bool
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $request->execute([$email]);
        $user = $request->fetch();
        if (!$user)
            return false;
        else
            return true;
    }

    public function register(string $name, string $email, ?string $password, string $dateOfBirth, string $SSN, string $phone)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("INSERT INTO users (name, email, password, dateOfBirth, SSN, phone, role) VALUES (?, ?, ?, ?, ?, ?, 'patient')");
        $request->execute([$name, $email, $password ?? null, $dateOfBirth, $SSN, $phone]);
    }
    public function addPatient(string $name, string $email, string $dateOfBirth, string $SSN, string $phone)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("INSERT INTO users (name, email, dateOfBirth, SSN, phone, role) VALUES (?, ?, ?, ?, ?, 'patient')");
        $request->execute([$name, $email, $dateOfBirth, $SSN, $phone]);
    }
    public function addPassword(string $password, string $email)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $request->execute([$password, $email]);
    }
    public function registerAdmin(string $name, string $email, string $password)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'pro')");
        $request->execute([$name, $email, $password]);
    }

    public function getUser(string $email)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $request->execute([$email]);
        $user = $request->fetch();
        if ($user)
            return new User($user);
        else
            return null;
    }

    public function getPatients(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("SELECT * FROM users WHERE role = ?");
        $request->execute(['patient']);
        $patients = $request->fetchAll();
        $sick = [];
        foreach ($patients as $patient) {
            $sick[] = new User($patient);
        }
        return $sick;
    }

    public function getPatient(int $id): User|null
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $request->execute([$id]);
        $patient = $request->fetch();
        if (!$patient) {
            return null;
        }

        return new User($patient);
    }

    public function updatePatient(int $id, string $name, string $dateOfBirth, string $SSN, string $phone)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE users SET name = ?, dateOfBirth = ?, SSN = ?, phone = ? WHERE id = ?");
        $request->execute([$name, $dateOfBirth, $SSN, $phone, $id]);
    }

    public function deletePatient(int $id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $request->execute([$id]);
    }
}