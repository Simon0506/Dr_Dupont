<?php

require_once 'models/Service.php';

class ServicesManager
{
    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getServices(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->query("SELECT * FROM services");
        $services = $request->fetchAll();
        $serves = [];
        foreach ($services as $service) {
            $serves[] = new Service($service);
        }
        return $serves;
    }

    public function createService(string $name, string $description)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("INSERT INTO services (name, description) VALUES (?, ?)");
        $request->execute([$name, $description]);
    }

    public function deleteService(int $id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $request->execute([$id]);
    }

    public function getService(int $id): Service|null
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("SELECT * FROM services WHERE id = ?");
        $request->execute([$id]);
        $service = $request->fetch();
        if (!$service) {
            return null;
        }

        return new Service($service);
    }

    public function updateService(int $id, string $name, string $description)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
        $request->execute([$name, $description, $id]);
    }
}