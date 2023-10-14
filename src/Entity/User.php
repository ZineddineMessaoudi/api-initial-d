<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank(message="Pseudo is required")
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your pseudo must be at least {{ limit }} characters long",
     *      maxMessage = "Your pseudo cannot be longer than {{ limit }} characters"     
     *  )
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z]).+$/",
     *     message="Your pseudo have to contain at least one uppercase, one lowercase"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="Your pseudo must be a string"
     * )
     */
    private $pseudonyme;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Password is required")
     * @Assert\Length(
     *      min = 8,
     *      max = 50,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/",
     *     message="Your password have to contain at least one uppercase, one lowercase, one number and one special character"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="Your password must be a string"
     * )
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudonyme(): ?string
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme(string $pseudonyme): self
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
