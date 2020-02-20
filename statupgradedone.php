<html>
<head>
<LINK REL="StyleSheet" HREF="style/muph.css" TYPE="text/css">
<style type="text/css">
<!--
.Estilo5 {color: #cfb8a2}
.Estilo6 {
	color: #999999;
	font-weight: bold;
}
.Estilo7 {
	color: #cfb8a2;
	font-size: 16px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
-->
</style>
<?php

$name = stripslashes($_POST['name']);
$login = stripslashes($_POST['login']);
$oldpwd = stripslashes($_POST['oldpwd']);
$vitality = stripslashes($_POST['vitality']);
$strength = stripslashes($_POST['strength']);
$energy = stripslashes($_POST['energy']);
$dexterity = stripslashes($_POST['dexterity']);

if ((eregi("[^a-zA-Z0-9_-]", $name)) ||
(eregi("[^a-zA-Z0-9_-]", $login)) ||
(eregi("[^a-zA-Z0-9_-]", $oldpwd)) ||
(eregi("[^0-9]", $vitality)) ||
(eregi("[^0-9]", $strength)) ||
(eregi("[^0-9]", $energy)) ||
(eregi("[^0-9]", $dexterity)))
	{
	echo("<center><font color=red><b>SQL Injection Detectado.</b></font><br>No se llevo a cabo la Reparticion</center>");
        exit();
	}

require_once "sql_inject.php"; 
include_once('sql_check.php');
check_inject();

$bDestroy_session = TRUE; 
$url_redirect = 'index.php'; 
$sqlinject = new sql_inject('./log_file_sql.log',$bDestroy_session,$url_redirect)  ; 

require 'config.htpasswd';
$msconnect=mssql_connect("$dbhost","$dbuser","$dbpasswd");
$msdb=mssql_select_db("MuOnline",$msconnect);

$sql_username_check = mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"); 
$username_check = mssql_num_rows($sql_username_check); 

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb__pwd='$oldpwd' and memb___id='$login'"); 
$pw_check = mssql_num_rows($sql_pw_check); 

$query = "select Vitality,Strength,Energy,Dexterity,LevelUpPoint from Character WHERE Name='$name'";
$result = mssql_query( $query );
$row = mssql_fetch_row($result);

$new_vit = $row[0] + $vitality;
$new_str = $row[1] + $strength;
$new_eng = $row[2] + $energy;
$new_agi = $row[3] + $dexterity;
$row[4] = $row[4] - $vitality - $strength - $energy - $dexterity;

if (empty($login) || empty($oldpwd) || empty($name)) {
    echo "Error: Algunos espacios fueron dejados en blanco. Por favor vuelve atras he intenta de nuevo<br>";
}

elseif ($username_check <= 0){ 
        echo "Error: Tu ID no existe en nuestra base de datos. Por favor vuelve atras he intenta de nuevo.<br>"; }

elseif ($row[4] < 0){ 
        echo "Error: Tu no tienes suficientes puntos para repartir ($row[4])!<br>"; }

elseif ($pw_check <= 0){ 
        echo "Error: Password incorrecto. Por favor vuelve atras he intenta de nuevo.<br>"; }



else {	$msconnect=mssql_connect("$dbhost","$dbuser","$dbpasswd");
$msdb=mssql_select_db("MuOnline",$msconnect);
$msquery = "
UPDATE dbo.Character SET Vitality = '$new_vit'
WHERE Name = '$name'
AND AccountID = '$login'
UPDATE dbo.Character SET Strength = '$new_str'
WHERE Name = '$name'
AND AccountID = '$login'
UPDATE dbo.Character SET Energy = '$new_eng'
WHERE Name = '$name'
AND AccountID = '$login'
UPDATE dbo.Character SET Dexterity = '$new_agi'
WHERE Name = '$name'
AND AccountID = '$login'
UPDATE dbo.Character SET LevelUpPoint = '$row[4]'
WHERE Name = '$name'
AND AccountID = '$login'";
$msresults= mssql_query($msquery);
echo "<center><font size='1' face='verdana'>Ahora el status de $name es el siguiente:<br><br>
<b>Vitalidad</b> = $new_vit<br>
<b>Fuerza</b> = $new_str<br>
<b>Enegia</b> = $new_eng<br>
<b>Agilidad</b> = $new_agi<p>
Te quedan $row[4] puntos para repartir.<br></font>";
}
?>


</body>
</html>
</body>
</html>