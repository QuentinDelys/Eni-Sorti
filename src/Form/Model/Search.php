<?php

namespace App\Form\Model;

class Search {

public $campus;
public $nom;
public $dateHeureDebut;
public $dateHeureFin;
public $sortiesOrga;
public $sortiesInscris;
public $sortiesPasInscris;
public $sortiesPassees;

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     * @return Search
     */
    public function setCampus($campus)
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
     * @return mixed
     */
    public function getSortiesOrga()
    {
        return $this->sortiesOrga;
    }

    /**
     * @param mixed $sortiesOrga
     * @return Search
     */
    public function setSortiesOrga($sortiesOrga)
    {
        $this->sortiesOrga = $sortiesOrga;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortiesInscris()
    {
        return $this->sortiesInscris;
    }

    /**
     * @param mixed $sortiesInscris
     * @return Search
     */
    public function setSortiesInscris($sortiesInscris)
    {
        $this->sortiesInscris = $sortiesInscris;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortiesPasInscris()
    {
        return $this->sortiesPasInscris;
    }

    /**
     * @param mixed $sortiesPasInscris
     * @return Search
     */
    public function setSortiesPasInscris($sortiesPasInscris)
    {
        $this->sortiesPasInscris = $sortiesPasInscris;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortiesPassees()
    {
        return $this->sortiesPassees;
    }

    /**
     * @param mixed $sortiesPassees
     * @return Search
     */
    public function setSortiesPassees($sortiesPassees)
    {
        $this->sortiesPassees = $sortiesPassees;
        return $this;
    }

}