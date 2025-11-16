<?php

require_once 'models/Appointment.php';

class AppointmentsManager
{
    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function createAppointment(int $id_user, int $id_slot, int $id_service)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("INSERT INTO appointments (id_user, id_slot, id_service) VALUES (?, ?, ?)");
        $request->execute([$id_user, $id_slot, $id_service]);
    }
}