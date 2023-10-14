<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Firstname is required")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your firstname must be at least {{ limit }} characters long",
     *      maxMessage = "Your firstname cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="Your firstname must be a string"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Lastname is required")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your lastname must be at least {{ limit }} characters long",
     *      maxMessage = "Your lastname cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="Your lastname must be a string"
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank(message="Age is required")
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     *      minMessage = "Your age must be at least {{ limit }} years",
     *      maxMessage = "Your age cannot be longer than {{ limit }} years"
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="Your age must be an integer"
     * )
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, inversedBy="characters")
     * @ORM\JoinTable(name="character_job")
     * @Assert\NotBlank(message="Job is required")
     */
    private $job;

    /**
     * @ORM\ManyToMany(targetEntity=Car::class, inversedBy="characters")
     */
    private $car;

    public function __construct()
    {
        $this->job = new ArrayCollection();
        $this->car = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJob(): Collection
    {
        return $this->job;
    }

    public function addJob(Job $job): self
    {
        if (!$this->job->contains($job)) {
            $this->job[] = $job;
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        $this->job->removeElement($job);

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(Car $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        $this->car->removeElement($car);

        return $this;
    }
}
