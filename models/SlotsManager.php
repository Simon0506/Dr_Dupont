<?php

require_once 'models/Slot.php';

class SlotsManager
{
    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getSlots(int $id_day): array
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT hour FROM slots WHERE id_day = ?");
        $request->execute([$id_day]);
        $slots = $request->fetchAll();
        $slotsBooked = [];
        foreach ($slots as $slot) {
            $slotsBooked[] = new DateTime($slot);
        }
        return $slotsBooked;

    }

    public function createSlot(string $date, string $hour, int $id_day)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("INSERT INTO slots (date, hour, id_day) VALUES (?, ?, ?)");
        $request->execute([$date, $hour, $id_day]);
    }
}