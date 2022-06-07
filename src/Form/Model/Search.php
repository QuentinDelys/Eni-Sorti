<?php

namespace App\Form\Model;

use App\Entity\Campus;

use Doctrine\ORM\Mapping as ORM;

class Search {

    #[ORM\ManyToOne(targetEntity: Campus::class, inversedBy: 'sorties')]
    #[ORM\JoinColumn(nullable: false)]
    private $campus;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'datetime')]
    private $dateHeureDebut;

    #[ORM\Column(type: 'datetime')]
    private $dateHeureFin;

    #[ORM\Column(type: 'boolean')]
    private $sortiesOrga;

    #[ORM\Column(type: 'boolean')]
    private $sortiesInscris;

    #[ORM\Column(type: 'boolean')]
    private $sortiesPasInscris;

    #[ORM\Column(type: 'boolean')]
    private $sortiesPassees;

    /**
     * @return Campus
     */
    public function getCampus(){
        return $this->campus;
    }

    /**
     * @param Campus $campus
     * @return Search
     */
    public function setCampus($campus): Search
    {
        $this->campus = $campus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Search
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateHeureDebut()
    {
        return $this->dateHeureDebut;
    }

    /**
     * @param mixed $dateHeureDebut
     * @return Search
     */
    public function setDateHeureDebut($dateHeureDebut)
    {
        $this->dateHeureDebut = $dateHeureDebut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateHeureFin()
    {
        return $this->dateHeureFin;
    }

    /**
     * @param mixed $dateHeureFin
     * @return Search
     */
    public function setDateHeureFin($dateHeureFin)
    {
        $this->dateHeureFin = $dateHeureFin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSortiesOrga(): ?bool
    {
        return $this->sortiesOrga;
    }

    /**
     * @param bool $sortiesOrga
     * @return Search
     */
    public function setSortiesOrga(?bool $sortiesOrga): Search
    {
        $this->sortiesOrga = $sortiesOrga;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSortiesInscris(): ?bool
    {
        return $this->sortiesInscris;
    }

    /**
     * @param bool $sortiesInscris
     * @return Search
     */
    public function setSortiesInscris(?bool $sortiesInscris): Search
    {
        $this->sortiesInscris = $sortiesInscris;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSortiesPasInscris(): ?bool
    {
        return $this->sortiesPasInscris;
    }

    /**
     * @param bool $sortiesPasInscris
     * @return Search
     */
    public function setSortiesPasInscris(?bool $sortiesPasInscris): Search
    {
        $this->sortiesPasInscris = $sortiesPasInscris;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSortiesPassees(): ?bool
    {
        return $this->sortiesPassees;
    }

    /**
     * @param bool $sortiesPassees
     * @return Search
     */
    public function setSortiesPassees(?bool $sortiesPassees): Search
    {
        $this->sortiesPassees = $sortiesPassees;
        return $this;
    }



}