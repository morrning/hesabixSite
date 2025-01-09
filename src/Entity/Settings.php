<?php

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $des = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $siteKeywords = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bscscanAPI = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bscPriv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bscPub = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zarinpalChain = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDes(): ?string
    {
        return $this->des;
    }

    public function setDes(?string $des): static
    {
        $this->des = $des;

        return $this;
    }

    public function getSiteKeywords(): ?string
    {
        return $this->siteKeywords;
    }

    public function setSiteKeywords(?string $siteKeywords): static
    {
        $this->siteKeywords = $siteKeywords;

        return $this;
    }

    public function getBscscanAPI(): ?string
    {
        return $this->bscscanAPI;
    }

    public function setBscscanAPI(?string $bscscanAPI): static
    {
        $this->bscscanAPI = $bscscanAPI;

        return $this;
    }

    public function getBscPriv(): ?string
    {
        return $this->bscPriv;
    }

    public function setBscPriv(?string $bscPriv): static
    {
        $this->bscPriv = $bscPriv;

        return $this;
    }

    public function getBscPub(): ?string
    {
        return $this->bscPub;
    }

    public function setBscPub(?string $bscPub): static
    {
        $this->bscPub = $bscPub;

        return $this;
    }

    public function getZarinpalChain(): ?string
    {
        return $this->zarinpalChain;
    }

    public function setZarinpalChain(?string $zarinpalChain): static
    {
        $this->zarinpalChain = $zarinpalChain;

        return $this;
    }
}
