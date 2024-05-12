<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banque</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>
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
        <a class="nav-link active" href="mindex.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Comptes</a></li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Ajouter un nouveau compte</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Retour</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php 
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    Profil de compte pour <?php echo $row['name'];echo "<kbd>#";echo $row['accountNo'];echo "</kbd>"; ?>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Nom</td>
          <th><?php echo $row['name'] ?></th>
          <td>Numero de compte</td>
          <th><?php echo $row['accountNo'] ?></th>
        </tr><tr>
          <td>Nom de la filiale</td>
          <th><?php echo $row['branchName'] ?></th>
          <td>Code Brach</td>
          <th><?php echo $row['branchNo'] ?></th>
        </tr><tr>
          <td>Solde actuel</td>
          <th><?php echo $row['balance'] ?></th>
          <td>Type de compte</td>
          <th><?php echo $row['accountType'] ?></th>
        </tr><tr>
          <td>Cnic</td>
          <th><?php echo $row['cnic'] ?></th>
          <td>Ville</td>
          <th><?php echo $row['city'] ?></th>
        </tr><tr>
          <td>Numero de contact</td>
          <th><?php echo $row['number'] ?></th>
          <td>Addresse</td>
          <th><?php echo $row['address'] ?></th>
        </tr>
      </tbody>
    </table>
  </div>
 
</div>

</body>
</html>