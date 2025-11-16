<?php

require_once 'models/Date.php';

class DatesManager
{

    private function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=dupont;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getDates(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->query("SELECT * FROM days");
        $days = $request->fetchAll();
        $schedule = [];
        foreach ($days as $day) {
            $schedule[] = new Day($day);
        }
        return $schedule;
    }

    public function getDate(int $id): Day|null
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare("SELECT * FROM days WHERE id = ?");
        $request->execute([$id]);
        $day = $request->fetch();
        if (!$day) {
            return null;
        }

        return new Day($day);
    }

    public function updateDate(int $id, string $start, string $end)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare("UPDATE days SET start = ?, end = ? WHERE id = ?");
        $request->execute([$start, $end, $id]);
    }
}