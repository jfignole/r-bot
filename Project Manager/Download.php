<?php /**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @author Tyler Patrick Steve <tyler.p.steve@cgi.com>
* @copyright  2017 CGI Group Inc.
*/

# Begin browser session
session_start();
if(!isset($_SESSION['emp'])){#If session is not set, user isn't logged in.
                             #Redirect to Login Page
      header("Location:../logout.php");
      exit();
   }
include("../config.php");
?>
<!-- Begin HTML -->
<!DOCTYPE html>
  <html>
    <header>
    <center><img src="/images/banner_main.png" alt="Banner">
      <center>
  </header>
  <head>
    <link rel='stylesheet' href='../styles.css' type='text/css'>
    <div class="container">
      <a href="home.php">Home</a>
      <a href="downloadFormList.php">Form List</a>
      <a href="../logout.php">Logout</a>
    </div>
    <title>
      Download Options
    </title>
  </head>
  <body class="emp">
    <br/>
<?php
require_once '../vendor/phpoffice/phpword/bootstrap.php';
//include_once '../Composer/phpoffice/phpword/samples/Sample_Header.php';

$id = $_GET['id'];#Gets id from previous page and queries the database to get
                   #information to fill in this particular RM_FORM
$conn=new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD); #DB Connection
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);#Sets PDO error types
$sql = "SELECT * FROM rmemform WHERE RM_ID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();#Builds and runs query
$rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);#Fetches query into array with column
                                          #names instead of indexes
// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

/* Note: any element you append to a document must reside inside of a Section. */
$fName = $rowt[0]['so_number'] . ": " . $rowt[0]['position_title'];
//echo $fName;
// Adding an empty Section to the document...
$section = $phpWord->addSection();
$header = array('size' => 16, 'bold' => true, 'color'=> 'red');
$section->addText('CGI', $header);
$tStyle = array('exactHeight'=> true, 'borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
$tHstyle = array('exactHeight'=> true,'borderBottomSize' => 18, 'borderBottomColor' => '000000', 'bgColor' => 'A5ACB0');
$tcstyle = array('exactHeight'=> true,'valign' => 'center');
$thfont = array('bold' => true);
$cellRowContinue = array('exactHeight'=> true,'gridSpan' => 3);
$cellRowContinueBack = array('exactHeight'=> true,'gridSpan' => 3, 'bgColor' => 'A5ACB0');
$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
$rowH = array('exactHeight' => true);
$tName = 'RM_FORM';
$phpWord->addTableStyle($tName, $tStyle, $tHstyle);
$table = $section->addTable($tName);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $cellRowContinueBack)->addText('ID NUMBER', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $cellRowContinue)->addText($id);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $cellRowContinueBack)->addText('SO NUMBER', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $cellRowContinue)->addText($rowt[0]['so_number']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('POSITION TITLE', $thfont);
  $table->addCell(8000, $tHstyle)->addText('SEAT LOCATION', $thfont);
  $table->addCell(8000, $tHstyle)->addText('DATE SUBMITTED TO CGI', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['position_title']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['seat_location']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['cgi_submit_dt']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('# OF RESOURCES NEEDED', $thfont);
  $table->addCell(8000, $tHstyle)->addText('PROJECT START DATE', $thfont);
  $table->addCell(8000, $tHstyle)->addText('FIXED PRICE OR TM', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['num_resource_need']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['proj_start_dt']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['tmfp']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('TYPE', $thfont);
  $table->addCell(8000, $tHstyle)->addText('ESTIMATED RESOURCE START DATE', $thfont);
  $table->addCell(8000, $tHstyle)->addText('ESTIMATED END DATE', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['job_type']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['est_resource_start_dt']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['est_resource_end_dt']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('RECOMMENDED HIRING', $thfont);
  $table->addCell(8000, $tHstyle)->addText('PROJECT/CLIENT', $thfont);
  $table->addCell(8000, $tHstyle)->addText('CONFIDENCE (0-100%)', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['recommended_hiring']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['proj_client']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['confidence']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('HIRING MANAGER (PNC ONLY)', $thfont);
  $table->addCell(8000, $tHstyle)->addText('CIO/SENIOR MANAGER (PNC ONLY)', $thfont);
  $table->addCell(8000, $tHstyle)->addText('CGI ENGAGEMENT MANAGER', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['hiring_manager']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['senior_manager']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['cgi_engage_manager']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $tHstyle)->addText('PROJECT CODE #', $thfont);
  $table->addCell(8000, $tHstyle)->addText('TARGET SALARY', $thfont);
  $table->addCell(8000, $tHstyle)->addText('RATE CARD-CATEGORY-LEVEL', $thfont);
$table->addRow(300, $rowH);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['proj_code']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['target_salary']);
  $table->addCell(8000, $tcstyle)->addText($rowt[0]['rate_crd_cat_lvl']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $cellRowContinueBack)->addText('POSITION DESCRIPTION', $thfont);
$table->addRow(3750, array('exactHeight'=>true));
  $table->addCell(8000, $cellRowContinue)->addText(htmlspecialchars($rowt[0]['position_desc']));
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $cellRowContinueBack)->addText('COMMENTS', $thfont);
$table->addRow(300, array('exactHeight'=>true));
  $table->addCell(8000, $cellRowContinue)->addText($rowt[0]['comments']);
$table->addRow(300, $tHstyle);
  $table->addCell(8000, $cellRowContinueBack)->addText('NOTES (Internal Only)', $thfont);
$table->addRow(300, array('exactHeight'=>true));
  $table->addCell(8000, $cellRowContinue)->addText($rowt[0]['notes']);
  // Saving the document as OOXML file...
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
  $objWriter->save($fName.".docx");
  //header('Content-Disposition: attachment;filename="RM_FORM.docx"');
  //header("Content-Type: text/plain");
  echo '<a href="/Project Manager/'. $fName . '.docx" target="_blank">'. $fName .'.docx</a></br>';
  // Saving the document as ODF file...
  /* 
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
  $objWriter->save($fName.".odt");
  echo '<a href="/Project Manager/'. $fName . '.odt" target="_blank">'. $fName . ".odt</a><br/>";
  echo "<i>Chose this for LibreOffice or any open source text processor</i><br/><br/>";

  // Saving the document as HTML file...
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
  $objWriter->save($fName.".html");
  echo '<a href="/Project Manager/'. $fName . '.html" target="_blank">'. $fName . ".html</a><br/>";
  echo "<i>Chose this for a basic HTML output</i><br/><br/>";

  /* echo write($phpWord, basename(__FILE__, '.php'), $writers);
  if (!CLI) {
      include_once '../Composer/phpoffice/phpword/samples/Sample_Footer.php';
  } */
?>
</table>
  </body>
</html>