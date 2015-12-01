<?
session_start();
if($_SESSION["strUserID"] == "")
{
header("location:http://112.121.150.67/thaivaccine/mainmenu.php");
exit();
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>jQuery Mobile Web App</title>
<link href="jquery-mobile/jquery.mobile.theme-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body>
 
<?
$objConnect = mysql_connect("112.121.150.67","hdc","hdc") or die(mysql_error());

$objDB = mysql_select_db("db_ivaccine");
mysql_query("SET NAMES utf8", $objConnect);

$strSQL = " SELECT
a.*, b.*, c.*
FROM admin_hospital a INNER JOIN (hospital b,temperature_hospital c)
ON (b.hospital_id=a.hospital_id AND c.hospital_id=b.hospital_id)
WHERE c.temph_date IN
(SELECT MAX( temph_date )FROM temperature_hospital
WHERE adminh_id = '".$_SESSION["strUserID"]."' )" ;
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>

<div data-role="page" data-theme="b" id="pageMadminh">
	<div data-role="header" data-theme="b">
    <a href="http://112.121.150.67/thaivaccine/logout.php" data-icon="home" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="2" >ชื่อผู้ใช้ : <? echo $objResult["adminh_name"];?></font></h1>
	</div>
    
    

<div data-role="content">	
		<div style="padding-left:10px;padding-right:10px">
 
<div align="right">
      <img src="pic/datastud.png" width="250" height="80"> 			</div>
 
 
	<div data-role="fieldcontain">
		<label for="name">หน่วยงาน :</label>
			<? echo $objResult["hospital_name"];?>
	</div>
    <div align="center">
	<div data-role="fieldcontain">
		<label for="name">อุณหภูมิตู้เก็บวัคซีนปัจจุบัน :</label>
			
	</div>
    
    <div data-role="fieldcontain">
			<font size="10"><? echo $objResult["temph_temp"];?></font><font size="5">C</font>
	</div>
   </div>
       
				

</body>
</html>