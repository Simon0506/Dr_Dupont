<?php

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $dateOfBirth;
    private ?string $phone;
    private ?string $SSN;
    private string $role;
    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->dateOfBirth = $data["dateOfBirth"] ?? null;
        $this->phone = $data["phone"] ?? null;
        $this->SSN = $data["SSN"] ?? null;
        $this->role = $data["role"];
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getSSN()
    {
        return $this->SSN;
    }
    public function getRole()
    {
        return $this->role;
    }
}