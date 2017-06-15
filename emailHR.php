<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');
$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM users WHERE user_type = 'HR'";
$stmt = $con->prepare($sql);
$stmt->execute();
$rowt = $stmt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
$dt = new DateTime();
$dt->getTimestamp();
foreach($rowt as $row){
$name = $row['last_name'] . ", " . $row['first_name'];

  $txt = "<html><head><style>
  body {
    font-family: Arial;
    font-size: 115%;
  }
  table {
      border: 5px solid black;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto;
      margin-top: auto;
      margin-bottom: auto;
  }
  caption{
      border: 5px solid black;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto;
      margin-top: auto;
      margin-bottom: auto;
      font-weight: bold;
      font-size: 100%;
  }
  td {
      border: 3px solid black;
      border-collapse: collapse;
      padding: 1px;
      text-align: left;
  }
  th {
    border: 3px solid black;
    border-collapse: collapse;
    padding: 5px;
    text-align: left;
    background-color: #A5ACB0;
  }</style></head><body><table><caption>Current RM_FORM'S</caption><tr>
    <th>POSITION TITLE</th>
    <th>DATE</th>
    <th># OF RESOURCES NEEDED</th>
    <th># OF APPLICANTS</th>
    <th>CGI ENGAGEMENT MANAGER</th>
    <th>RATE CARD-CATEGORY-LEVEL</th>
    <th>STATUS</th>
  </tr>";
  try{
      $i = 0;
      $to = $row['email'];
      $sql = "SELECT * FROM rmemform WHERE status = 'WAITING FOR SO_NUM'";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $rowi = $stmt->fetchAll(PDO::FETCH_NUM&PDO::FETCH_ASSOC);
      foreach($rowi as $stat)
      {
        if(is_array($stat))
        {
          $date = date("Y-m-d", strtotime($rowi[$i]['date_submitted']));
          $txt .= "<tr>><td>" . $rowi[$i]['position_title'] . "</td><td>"
                  . $date . "</td><td>" . $rowi[$i]['num_resource_need'] .
                  "</td><td>" . $date . $rowi[$i]['v_num'] .
                  "</td><td>" . $rowi[$i]['cgi_engage_manager'] . "</td><td>" . $rowi[$i]['rate_crd_cat_lvl']
                  . "</td><td>" . $rowi[$i]['status'] . "</td></tr>";

        }
        $i = $i + 1;
      }
        $subject = "Status update for " . $name . " on " . date('Y-m-d', $dt->getTimestamp());
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
        $headers .= 'From: r.botcgi@gmail.com' . "\r\n";

    $txt .="</table>
    <a href='http://35.184.145.24/index.php'>Click Here to Login</a></body></html>";
    mail($to, $subject, $txt, $headers);
    $txt = " ";
  }catch(Exception $e){
  echo $e->getMessage();
}
}?>