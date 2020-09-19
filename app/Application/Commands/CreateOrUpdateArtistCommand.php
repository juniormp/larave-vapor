<?php


namespace App\Application\Commands;



use Illuminate\Contracts\Validation\Validator;

class CreateOrUpdateArtistCommand
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(array $data)
    {
        $this->id =  $data['id'] ?? null;
        $this->name =  $data['name'];
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
