<?php <t_€ý>hcall v:lua.cmp.utils.feedkeys.call.run(1)
ku
    $con = new mysqli('localhost','root','','mybank');
    define('bankname', 'Banque Kennal Yalla',true);
    $uid = '';
    if(isset($_SESSION['userId']))
    $uid = $_SESSION['userId'];
    if(isset($_SESSION['managerId']))
    $uid = $_SESSION['managerId'];
    $userData = [];
    if(!empty($uid)){
      $ar = $con->query("select * from useraccounts,branch where id = '{$uid}' AND useraccounts.branch = branch.branchId");
      $userData = $ar->fetch_assoc();
    }
?>
<script type="text/javascript">
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
