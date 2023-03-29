<?php
// User Class

namespace App;
class User
{
    protected string $userId;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected int $role;
    protected string $salutation;
    protected string $profilePhoto;

    public function __construct(
        int $userId, 
        string $firstName,
        string $lastName,
        string $email,
        int $role,
        string $salutation = "",
        string $profilePhoto = "photo.jpg"
    )
    {
        $this->userId = $userId;
        $this->salutation = $salutation;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->profilePhoto = $profilePhoto;
    }

    /**
     * Get User Id
     */
    public function getuserId(): string
    {
        return $this->userId;
    }

    /**
     * Get Full Name
     */
    public function getFullName(): string
    {
        if ($this->role == Role::$STUDENT) {
            return ucwords(
                $this->firstName ." ". $this->lastName
            );
        }
        return ucwords(
            $this->salutation ." ". $this->firstName ." ". $this->lastName
        );
    }

    /**
     * Get Email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get Profile Photo
     */
    public function getProfilePhoto(): string
    {
        return $this->profilePhoto;
    }

    /**
     * Get Role
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Save function
     */
    public function save(): bool
    {
        // Remove all illegal characters from email
        $email = filter_var($this->getEmail(), FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            echo "\r\nFailed saving with invalid Email: $email";
            return false;
        }

        // Validate photo
        $photoExtension = pathinfo($this->getProfilePhoto(), PATHINFO_EXTENSION);
        if ($photoExtension != "jpg") {
            echo (
                "\r\nFailed saving with invalid Photo: 
                $this->getProfilePhoto()"
            );
            return false;
        }

        echo "\r\nUser saved successfully.";
        return true;
    }
}

?>