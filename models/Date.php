<?php


class Day
{
    private int $id;
    private string $name;
    private string $start;
    private string $end;
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->start = $data["start"];
        $this->end = $data["end"];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getStart()
    {
        return $this->start;
    }
    public function getEnd()
    {
        return $this->end;
    }
}