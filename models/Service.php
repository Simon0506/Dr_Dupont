<?php

class Service
{
    private int $id;
    private string $name;
    private string $description;
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->description = $data["description"];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
}