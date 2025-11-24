<?php

class Appointment
{
    private int $id;
    private int $id_user;
    private int $id_slot;
    private int $id_service;
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->id_user = $data["id_user"];
        $this->id_slot = $data["id_slot"];
        $this->id_service = $data["id_service"];
    }
    public function getId()
    {
        return $this->id;
    }

    public function getId_user()
    {
        return $this->id_user;
    }
    public function getId_slot()
    {
        return $this->id_slot;
    }
    public function getId_service()
    {
        return $this->id_service;
    }
}

