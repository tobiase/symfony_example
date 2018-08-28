<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salutation")
     */
    private $salutation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stoff", mappedBy="customer")
     */
    private $stoffs;

    public function __construct()
    {
        $this->stoffs = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSalutation(): ?Salutation
    {
        return $this->salutation;
    }

    public function setSalutation(?Salutation $salutation): self
    {
        $this->salutation = $salutation;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Stoff[]
     */
    public function getStoffs(): Collection
    {
        return $this->stoffs;
    }

    public function addStoff(Stoff $stoff): self
    {
        if (!$this->stoffs->contains($stoff)) {
            $this->stoffs[] = $stoff;
            $stoff->addCustomer($this);
        }

        return $this;
    }

    public function removeStoff(Stoff $stoff): self
    {
        if ($this->stoffs->contains($stoff)) {
            $this->stoffs->removeElement($stoff);
            $stoff->removeCustomer($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}
