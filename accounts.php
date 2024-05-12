<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:loginUser.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banque Kennal Yalla</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>

</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> -->
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="uindex.php">Accueil <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active ">  <a class="nav-link" href="accounts.php">Comptes</a></li>
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Releves Comptes</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Virements</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'sideButton.php'; ?>
   
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Information de Votre Compte
  </div>
  <div class="card-body">
    <table class="table table-striped table-dark w-75 mx-auto">
  <thead>
    <tr>
      <td scope="col">Numero compte.</td>
      <th scope="col"><?php echo $userData['accountNo']; ?></th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="row">Code de la succursale</th>
      <td><?php echo $userData['branchNo']; ?></td>
    </tr>
    <tr>
      <th scope="row">Type de compte</th>
      <td><?php echo $userData['accountType']; ?></td>
    </tr>
    <tr>
      <th scope="row">compte cree</th>
      <td><?php echo $userData['date']; ?></td>
    </tr>
  </tbody>
</table>
      
  </div>
  
</div>

</div>
</body>
</html>