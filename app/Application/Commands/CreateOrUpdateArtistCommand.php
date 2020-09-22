<?php


namespace App\Application\Commands;


class CreateOrUpdateArtistCommand
{
    private $id;
    private $name;
    private $lastName;
    private $bio;
    private $email;
    private $password;

    public function __construct(array $data)
    {
        $this->id =  $data['id'] ?? null;
        $this->name =  $data['name'];
        $this->lastName =  $data['last_name'];
        $this->bio =  $data['bio'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
