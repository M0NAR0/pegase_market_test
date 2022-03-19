<?php

namespace App\Entity;

use App\Repository\CallSlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CallSlotRepository::class)]
class CallSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'time')]
    private $startTime;

    #[ORM\Column(type: 'time')]
    private $endTime;

    #[ORM\OneToMany(mappedBy: 'callSlot', targetEntity: CallbackRequest::class)]
    private $callbackRequests;

    public function __construct()
    {
        $this->callbackRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return Collection<int, CallbackRequest>
     */
    public function getCallbackRequests(): Collection
    {
        return $this->callbackRequests;
    }

    public function addCallbackRequest(CallbackRequest $callbackRequest): self
    {
        if (!$this->callbackRequests->contains($callbackRequest)) {
            $this->callbackRequests[] = $callbackRequest;
            $callbackRequest->setCallSlot($this);
        }

        return $this;
    }

    public function removeCallbackRequest(CallbackRequest $callbackRequest): self
    {
        if ($this->callbackRequests->removeElement($callbackRequest)) {
            // set the owning side to null (unless already changed)
            if ($callbackRequest->getCallSlot() === $this) {
                $callbackRequest->setCallSlot(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->label . " (" . $this->startTime->format('G') . "h-" . $this->endTime->format('G') . "h)";
    }
}
