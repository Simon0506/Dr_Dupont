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

    public function getSlots(string $date): array
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM slots WHERE date = ?");
        $request->execute([$date]);
        $slots = $request->fetchAll();
        $slotsBooked = [];
        foreach ($slots as $slot) {
            $slotsBooked[] = new Slot($slot);
        }
        return $slotsBooked;
    }
    public function getHours(string $date): array
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT hour FROM slots WHERE date = ?");
        $request->execute([$date]);
        $hours = $request->fetchAll();
        $hoursBooked = [];
        foreach ($hours as $hour) {
            $hoursBooked[] = new Hour($hour);
        }
        return $hoursBooked;
    }

    public function createSlot(string $date, string $hour, int $id_day)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("INSERT INTO slots (date, hour, id_day) VALUES (?, ?, ?)");
        $request->execute([$date, $hour, $id_day]);
        return (int) $pdo->lastInsertId();
    }

    public function deleteSlot(int $id)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("DELETE FROM slots WHERE id = ?");
        $request->execute([$id]);
    }

    public function updateSlot(int $id, string $date, string $hour, int $id_day)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE slots SET date = ?, hour = ?, id_day = ? WHERE id = ?");
        $request->execute([$date, $hour, $id_day, $id]);
    }

    public function getSlot(string $date, string $hour): Slot|null
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("SELECT * FROM slots WHERE date = ? AND hour = ?");
        $request->execute([$date, $hour]);
        $slot = $request->fetch();
        if ($slot) {
            return new Slot($slot);
        } else {
            return null;
        }
    }
}