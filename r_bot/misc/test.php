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

echo "<h3><u>Email:</u></h3>";
echo "<hr />";
echo "<header><h3>Classification: ".$rowe['user_type']."</h3><br>";
do {
echo "".'Name:'.$rowe['last_name'].', '.$rowe['first_name']."";
echo "<a href='mailto:".$rowe['email']."'>".$rowe['email']."</a></br>";
}while($rowe = $stmte->fetch(PDO::FETCH_ASSOC));

echo "<hr />";
echo "<header><h3>Classification: ".$rowh['user_type']."</h3><br>";
do{
echo "".'Name:'.$rowh['last_name'].', '.$rowh['first_name']."";
echo "<a href='mailto:".$rowh['email']."'>".$rowh['email']."</a></br>";
}while($rowh = $stmth->fetch(PDO::FETCH_ASSOC));

echo "<hr />";
echo "<header><h3>Classification: ".$rowv['user_type']."</h3><br>";
do{
echo "".'Name:'.$rowv['last_name'].', '.$rowv['first_name']."";
echo "<a href='mailto:".$rowv['email']."'>".$rowv['email']."</a></br>";
}while($rowv = $stmtv->fetch(PDO::FETCH_ASSOC));
?>
