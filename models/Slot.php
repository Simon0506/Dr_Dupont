<?php

class Slot
{
    private int $id;
    private string $date;
    private string $hour;
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->date = $data["date"];
        $this->hour = $data["hour"];
    }
    public function getId()
    {
        return $this->id;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getHour()
    {
        return $this->hour;
    }
}