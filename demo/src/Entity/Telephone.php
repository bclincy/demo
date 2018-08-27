<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TelephoneRepository")
 */
class Telephone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mobile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Lead", mappedBy="phoneNum", cascade={"persist", "remove"})
     */
    private $lead;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMobile(): ?bool
    {
        return $this->mobile;
    }

    public function setMobile(bool $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getLead(): ?Lead
    {
        return $this->lead;
    }

    public function setLead(Lead $lead): self
    {
        $this->lead = $lead;

        // set the owning side of the relation if necessary
        if ($this !== $lead->getPhone()) {
            $lead->setPhone($this);
        }

        return $this;
    }
}
