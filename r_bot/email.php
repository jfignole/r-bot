<?php
include("config.php");
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sqle = "SELECT * FROM users WHERE user_type = 'Employee'";
$stmte = $conn->prepare($sqle);
$stmte->execute();
$rowe = $stmte->fetch(PDO::FETCH_ASSOC);

$sqlh = "SELECT * FROM users WHERE user_type = 'HR'";
$stmth = $conn->prepare($sqlh);
$stmth->execute();
$rowh = $stmth->fetch(PDO::FETCH_ASSOC);

$sqlv = "SELECT * FROM users WHERE user_type = 'Vendor'";
$stmtv = $conn->prepare($sqlv);
$stmtv->execute();
$rowv = $stmtv->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="../styles.css" type="text/css" />
</head>
<h1>CGI</h1>
<h2>R-BOT</h2>
<table>
  <tr>
    <th>EMPLOYEE</th>
    <th>HUMAN RESOURCES</th>
    <th>VENDOR</th>
  </tr>
  <tr>
    <td><?php do {
    echo "".'<h5>'.$rowe['last_name'].', '.$rowe['first_name'].": ";
    echo "<a href='mailto:".$rowe['email']."'>".$rowe['email']."</a></br></h5>";
  }while($rowe = $stmte->fetch(PDO::FETCH_ASSOC));?></td>
  <td><?php do{
  echo "".'<h5>'.$rowh['last_name'].', '.$rowh['first_name'].": ";
  echo "<a href='mailto:".$rowh['email']."'>".$rowh['email']."</a></br></h5>";
}while($rowh = $stmth->fetch(PDO::FETCH_ASSOC));?></td>
<td> <?php do{
echo "".'<h5>'.$rowv['last_name'].', '.$rowv['first_name'].": ";
echo "<a href='mailto:".$rowv['email']."'>".$rowv['email']."</a></br></h5>";
}while($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)); ?> </td>
</tr>
<tr>
  <td colspan='3'><a href='../logout.php'>Logout</a></td>
</tr>
</html>
