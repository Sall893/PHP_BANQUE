<?php

class CompteBancaire {
    private $numeroCompte;
    private $solde;
    private $proprietaire; // Un objet de la classe Client

    public function __construct($numeroCompte, $solde, $proprietaire) {
        $this->numeroCompte = $numeroCompte;
        $this->solde = $solde;
        $this->proprietaire = $proprietaire;
    }

    // Méthode pour effectuer un dépôt sur le compte
    public function effectuerDepot($montant) {
        $this->solde += $montant;
    }

    // Méthode pour effectuer un retrait sur le compte
    public function effectuerRetrait($montant) {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            return true; // Retrait réussi
        } else {
            return false; // Solde insuffisant pour effectuer le retrait
        }
    }

    // Getters pour accéder aux propriétés privées de la classe
    public function getNumeroCompte() {
        return $this->numeroCompte;
    }

    public function getSolde() {
        return $this->solde;
    }

    public function getProprietaire() {
        return $this->proprietaire;
    }
}

?>

