<?php
session_start();
if (!isset($_SESSION['userId'])) { 
    header('location:loginUser.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Banque Kennal Yalla</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php require 'OperationBancaire.php'; ?>

    <?php
    $error = "";
    if (isset($_POST['userLogin'])) {
        $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];

        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            $_SESSION['user'] = $data;
            header('location:index.php');
        } else {
            $error = "<div class='alert alert-warning text-center rounded-0'>Nom d'utilisateur ou mot de passe incorrect, veuillez réessayer!</div>";
        }
    }

    // Instance de la classe OperationBancaire
    $operationBancaire = new OperationBancaire();
    ?>

</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link " href="uindex.php">Accueil <span class="sr-only"></span></a>
            </li>
            <li class="nav-item ">  <a class="nav-link" href="accounts.php">Comptes</a></li>
            <li class="nav-item ">  <a class="nav-link" href="statements.php">Relevés de Comptes</a></li>
            <li class="nav-item active">  <a class="nav-link" href="transfer.php">Virements</a></li>
            <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->
        </ul>
        <?php include 'sideButton.php'; ?>
    </div>
</nav><br><br><br>
<div class="container">
    <div class="card  w-75 mx-auto">
        <div class="card-header text-center">
            Virements
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="alert alert-success w-50 mx-auto">
                    <h5>Nouveau transfert</h5>
                    <input type="text" name="otherNo" class="form-control " placeholder="Entrer le numero de compte du destinataire " required>
                    <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Obtenir les informations de votre compte</button>
                </div>
            </form>
            <?php if (isset($_POST['get'])) {
                $recipientAccountNo = $_POST['otherNo'];
                // Utilisation de la méthode pour obtenir les informations du destinataire
                $recipientInfo = $operationBancaire->getRecipientInfo($recipientAccountNo);

                if ($recipientInfo) { ?>
                    <div class="alert alert-success w-50 mx-auto">
                        <form method="POST">
                            <input type="text" value="<?php echo $recipientInfo['accountNo']; ?>" name="otherNo" class="form-control " readonly required>
                            <input type="text" class="form-control" value="<?php echo $recipientInfo['holderName']; ?>" readonly required>
                            <input type="text" class="form-control" value="<?php echo $recipientInfo['bankName']; ?>" readonly required>
                            <input type="number" name="amount" class="form-control" min="1" max="<?php echo $userData['balance']; ?>" required>
                            <button type="submit" name="transfer" class="btn btn-primary btn-bloc btn-sm my-1">Transférer</button>
                        </form>
                    </div>
                <?php } else {
                    echo "<div class='alert alert-success w-50 mx-auto'>Le numéro de compte $recipientAccountNo n'existe pas</div>";
                }
            } ?>
            <br>
            <h5>Historique des transferts</h5>
            <div id="list-group rounded-0">
                <?php
                if (isset($_POST['transfer'])) {
                    $amount = $_POST['amount'];
                    $recipientAccountNo = $_POST['otherNo'];
                    // Utilisation de la méthode pour effectuer le transfert
                    $transferResult = $operationBancaire->effectuerVirement($amount, $userData['accountNo'], $recipientAccountNo);
                    echo "<script>alert('$transferResult');window.location.href='transfer.php'</script>";
                }

                // Récupération de l'historique des transferts
                $transferHistory = $operationBancaire->getTransferHistory($userData['id']);

                if ($transferHistory) {
                    foreach ($transferHistory as $transfer) {
                        echo "<div class='list-group-item list-group-item-action bg-gradient-info'>Un transfert de $transfer[debit] FCFA depuis votre compte a été effectué le $transfer[date] sur le numéro de compte : $transfer[other]</div>";
                    }
                } else {
                    echo "<div class='list-group-item list-group-item-action text-muted'>Aucun transfert n'a encore été effectué.</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

