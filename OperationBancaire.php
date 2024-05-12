<?php

class OperationBancaire {
    // Méthode pour effectuer un dépôt
    public function effectuerDepot($montant, $compte) {
        // Logique pour effectuer le dépôt
        $nouveauSolde = $compte->getSolde() + $montant;
        $compte->setSolde($nouveauSolde);
        // Enregistrement de l'opération dans l'historique du compte
        $compte->ajouterOperation("Dépôt", $montant);
        return "Dépôt de $montant FCFA effectué avec succès. Nouveau solde : $nouveauSolde FCFA";
    }

    // Méthode pour effectuer un retrait
    public function effectuerRetrait($montant, $compte) {
        // Vérifier si le solde est suffisant
        if ($compte->getSolde() < $montant) {
            return "Solde insuffisant";
        }
        // Logique pour effectuer le retrait
        $nouveauSolde = $compte->getSolde() - $montant;
        $compte->setSolde($nouveauSolde);
        // Enregistrement de l'opération dans l'historique du compte
        $compte->ajouterOperation("Retrait", $montant);
        return "Retrait de $montant FCFA effectué avec succès. Nouveau solde : $nouveauSolde FCFA";
    }

    // Méthode pour effectuer un virement entre comptes
    public function effectuerVirement($montant, $compteSource, $compteDest) {
        // Vérifier si le solde du compte source est suffisant
        if ($compteSource->getSolde() < $montant) {
            return "Solde insuffisant";
        }
        // Logique pour effectuer le virement
        $nouveauSoldeSource = $compteSource->getSolde() - $montant;
        $nouveauSoldeDest = $compteDest->getSolde() + $montant;
        $compteSource->setSolde($nouveauSoldeSource);
        $compteDest->setSolde($nouveauSoldeDest);
        // Enregistrement de l'opération dans l'historique des deux comptes
        $compteSource->ajouterOperation("Virement sortant", $montant);
        $compteDest->ajouterOperation("Virement entrant", $montant);
        return "Virement de $montant FCFA effectué avec succès de " . $compteSource->getNumeroCompte() . " vers " . $compteDest->getNumeroCompte();
    }
}

?>

