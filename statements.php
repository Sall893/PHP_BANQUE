
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
  <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

   ?>
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
        <a class="nav-link " href="uindex.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">Comptes</a></li>
      <li class="nav-item active">  <a class="nav-link" href="statements.php">Releves Comptes</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Virements</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav><br><br><br>
<div class="container">
  <div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Transcaction effectue sur votre compte
  </div>
  <div class="card-body">
    <div id="list-group rounded-0">
    <?php 
      $array = $con->query("select * from transaction where userId = '$userData[id]' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'withdraw') 
            {
              echo "<div class='list-group-item alert alert-secondary'>vos retraits FCFA.$row[debit] de votre compte a $row[date]</div>";
            }
            if ($row['action'] == 'deposit') 
            {
              echo "<div class='list-group-item alert alert-success'>Vos depots FCFA.$row[credit] dans votre compte a $row[date]</div>";
            }
            if ($row['action'] == 'deduction') 
            {
              echo "<div class='list-group-item alert alert-danger'>Deduction  FCFA.$row[debit] de votre compte a $row[date] en de cas de $row[other]</div>";
            }
            if ($row['action'] == 'transfer') 
            {
              echo "<div class='list-group-item alert alert-warning'>un transfert a ete effectuee pour FCFA.$row[debit] depuis votre compte a $row[date] dans numero de compte.$row[other]</div>";
            }

         }
      } else{
        echo "<div class='text-center'><small class='text-muted'><i>Aucune transaction n'a encore ete effectuee .</i></small></div>";
      }
    ?>  
  </div>
  </div>
  
</div>

</div>
</body>
</html>