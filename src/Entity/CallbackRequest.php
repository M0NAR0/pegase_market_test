<?php

namespace App\Entity;

use App\Repository\CallbackRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CallbackRequestRepository::class)]
class CallbackRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    #[ORM\ManyToOne(targetEntity: CallSlot::class, inversedBy: 'callbackRequests')]
    private $callSlot;

    #[ORM\Column(type: 'date')]
    private $callbackDate;

    #[ORM\Column(type: 'text', nullable: true)]
    private $message;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCallSlot(): ?CallSlot
    {
        return $this->callSlot;
    }

    public function setCallSlot(?CallSlot $callSlot): self
    {
        $this->callSlot = $callSlot;

        return $this;
    }

    public function getCallbackDate(): ?\DateTimeInterface
    {
        return $this->callbackDate;
    }

    public function setCallbackDate(\DateTimeInterface $callbackDate): self
    {
        $this->callbackDate = $callbackDate;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
