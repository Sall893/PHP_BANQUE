<?php

class Client {
    
    private $nom;
    private $cnic;
    private $numeroCompte;
    private $typeCompte;
    private $ville;
    private $adresse;
    private $email;
    private $motDePasse;
    private $depot;
    private $sourceRevenu;
    private $numeroContact;

    
    public function __construct($nom, $cnic, $numeroCompte, $typeCompte, $ville, $adresse, $email, $motDePasse, $depot, $sourceRevenu, $numeroContact) {
        $this->nom = $nom;
        $this->cnic = $cnic;
        $this->numeroCompte = $numeroCompte;
        $this->typeCompte = $typeCompte;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->depot = $depot;
        $this->sourceRevenu = $sourceRevenu;
        $this->numeroContact = $numeroContact;
    }

    
    public function getNom() {
        return $this->nom;
    }

    public function getCNIC() {
        return $this->cnic;
    }

    public function getNumeroCompte() {
        return $this->numeroCompte;
    }

    public function getTypeCompte() {
        return $this->typeCompte;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getDepot() {
        return $this->depot;
    }

    public function getSourceRevenu() {
        return $this->sourceRevenu;
    }

    public function getNumeroContact() {
        return $this->numeroContact;
    }
}




?>

