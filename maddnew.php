<?php
include 'Client.php'; 

if (isset($_POST['saveAccount'])) {
    $client = new Client(
        $_POST['name'],
        $_POST['cnic'],
        time(), 
        $_POST['accountType'],
        $_POST['city'],
        $_POST['address'],
        $_POST['email'],
        $_POST['password'],
        $_POST['balance'],
        $_POST['source'],
        $_POST['number'],
        $_POST['branch']
    );

    
    if (!$con->query("insert into useraccounts (name,cnic,accountNo,accountType,city,address,email,password,balance,source,number,branch) values ('$client->getNom()','$client->getCNIC()','$client->getNumeroCompte()','$client->getTypeCompte()','$client->getVille()','$client->getAdresse()','$client->getEmail()','$client->getMotDePasse()','$client->getDepot()','$client->getSourceRevenu()','$client->getNumeroContact()','$client->getBranch()')")) {
        echo "<div class='alert alert-success'>Failed. Error is:".$con->error."</div>";
    } else {
        echo "<div class='alert alert-info text-center'>Account added Successfully</div>";
    }
}

if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
}
?>

<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            New Account Forum
        </div>
        <div class="card-body bg-dark text-white">
            <table class="table">
                <tbody>
                    <tr>
                        <form method="POST">
                            <th>Nom</th>
                            <td><input type="text" name="name" class="form-control input-sm" required></td>
                            <th>CNIC</th>
                            <td><input type="number" name="cnic" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Numero de compte</th>
                        <td><input type="text" name="accountNo" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
                        <th>Type de compte</th>
                        <td>
                            <select class="form-control input-sm" name="accountType" required>
                                <option value="saving" selected>Sauvegarder</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Ville</th>
                        <td><input type="text" name="city" class="form-control input-sm" required></td>
                        <th>Addresse</th>
                        <td><input type="text" name="address" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="email" name="email" class="form-control input-sm" required></td>
                        <th>Mot de passe</th>
                        <td><input type="password" name="password" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Dépôt</th>
                        <td><input type="number" name="balance" min="500" class="form-control input-sm" required></td>
                        <th>Source de revenu</th>
                        <td><input type="text" name="source" class="form-control input-sm" required></td>
                    </tr>
                    <tr>
                        <th>Numero de contact</th>
                        <td><input type="number" name="number" class="form-control input-sm" required></td>
                        <th>Bifurquer</th>
                        <td>
                            <select name="branch" required class="form-control input-sm">
                                <option selected value="">Veuillez selectionner..</option>
                                <?php
                                    $arr = $con->query("select * from branch");
                                    if ($arr->num_rows > 0) {
                                        while ($row = $arr->fetch_assoc()) {
                                            echo "<option value='$row[branchId]'>$row[branchName]</option>";
                                        }
                                    } else {
                                        echo "<option value='1'>Main Branch</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Enregistrer le compte</button>
                            <button type="Reset" class="btn btn-secondary btn-sm">Reinitialiser</button></form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

