<html>
<head>
<LINK REL="StyleSheet" HREF="style/muph.css" TYPE="text/css">
<style type="text/css">
<!--
.Estilo21 {
	color: #cfb8a2;
	font-size: 13px;
	font-weight: bold;
}
.Estilo24 {color: #009966; font-size: 10px; font-weight: bold; }
.Estilo25 {color: #cfb8a2}
.Estilo27 {font-size: 14px}
.Estilo30 {
	color: #cfb8a2;
	font-size: 16px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
-->
</style>
</head>
<body>

<LINK REL='StyleSheet' HREF='style/muph.css' TYPE='text/css'>
		

<tr>
  <td width="416" bordercolor="#211A12"><center>
      <?php
$login = stripslashes($_POST['login']);
$oldpwd = stripslashes($_POST['oldpwd']);
$name = stripslashes($_POST['name']);

if ((eregi("[^a-zA-Z0-9_-]", $login)) || 
(eregi("[^a-zA-Z0-9_-]", $oldpwd)) ||
(eregi("[^a-zA-Z0-9_-]", $name))) 
	{
	echo("SQL Injection Detected");
        exit();
	}

require 'config.htpasswd';
$msconnect=mssql_connect("$dbhost","$dbuser","$dbpasswd");
$msdb=mssql_select_db("MuOnline",$msconnect);

require_once "sql_inject.php"; 
include_once('sql_check.php');
check_inject();

$bDestroy_session = TRUE; 
$url_redirect = 'index.php'; 
$sqlinject = new sql_inject('./log_file_sql.log',$bDestroy_session,$url_redirect)  ; 

$sql_username_check = mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"); 
$username_check = mssql_num_rows($sql_username_check); 

$sql_name_check = mssql_query("SELECT Name FROM Character WHERE Name='$name' and AccountID = '$login'"); 
$name_check = mssql_num_rows($sql_name_check); 

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb__pwd='$oldpwd'"); 
$pw_check = mssql_num_rows($sql_pw_check); 

$sql_points_check = mssql_query("SELECT LevelUpPoint FROM Character WHERE Name='$name'"); 
$points_check = mssql_num_rows($sql_points_check); 
$points_get = mssql_fetch_row( $sql_points_check );

if (empty($login) || empty($oldpwd)) {
echo '<script language="Javascript">alert ("Usted a ingresado login incorrecto intente de nuevo.")</script>';
echo '<script language="Javascript">location.href="';
echo 'userjd.asp';
echo '"</script>';
$error =1; 
}
elseif ($username_check <= 0){
echo '<script language="Javascript">alert ("ID o password incorrecto, verifique.")</script>';
echo '<script language="Javascript">location.href="';
echo 'userjd.asp';
echo '"</script>';
$error =1; 
}

elseif ($name_check <= 0){
echo '<script language="Javascript">alert ("ID o password incorrecto, verifiques.")</script>';
echo '<script language="Javascript">location.href="';
echo 'userjd.asp';
echo '"</script>';
$error =1; 
}

elseif ($pw_check <= 0){ 
echo '<script language="Javascript">alert ("Usted a ingresado login incorrecto intente de nuevo, mayor de 10 ch.")</script>';
echo '<script language="Javascript">location.href="';
echo 'userjd.asp';
echo '"</script>';
$error =1; 
}

else 
	{	
	echo "";
	}


?>
    </center>
     
<FORM method=post name=chgform action=userdj.asp> <input type="hidden" name="action" value="dl">
  
        <tr>
          <tr>
            <td width="404" height="40" align="left"><table align="center" border="1" cellpadding="0" cellspacing="0" width="20" bordercolor="#666666" frame="vsides" rules="none">
              <tbody>
                <tr>
                  <td width="1" height="190" background="img/xu.gif"></td>
                  <td width="244" align="left" valign="middle" bgcolor="#FFFFFF"><table width="164" height="199" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#211A12">
                      <tbody>
                        <tr>
                          <td width="404" height="40" align="left"><table width="196" border="0" cellspacing="0" cellpadding="3">
                            <tbody>
                              <tr>
                                <td align="center"><table width="318" height="1" border="0" cellpadding="0" cellspacing="6" bordercolor="#CFB8A2">
                                  <tbody>
                                    <tr>
                                      <td height="1" width="305"><div class="Estilo21" v:shape="_x0000_s1026">
                                        <div align="center">
                                          <p align="left" class="Estilo27">Repartir Puntos</p>
                                        </div>
                                      </div></td>
                                    </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              </tbody>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="92" align="center" width="404"><table align="left" border="0" cellpadding="5" cellspacing="1" width="241">
                            <tbody>
                              <TR> 
                                <TD align=right class=txt_gray width="89"> <DIV align=left class="Estilo5 Estilo25"><b>
                                  <font size="1" face="Verdana">Nombre del PJ:</font></b></DIV></TD>
                      <TD class=txt_gray width="109"><input name='login' type='text' id='login' maxlength='10'>                        </TR>
                              <TR> 
                                <TD align=right class=txt_gray width="89"> <DIV align=left class="Estilo25"><b>
                                  <font size="1" face="Verdana"><span class="Estilo5">Cuenta</span>:</font></b></DIV></TD>
                      <TD class=txt_gray width="109"><input name='name' type='text' id='name' maxlength='10'>                        </TR>
                              <TR> 
                                <TD align=right class=txt_gray width="89"> <DIV align=left class="Estilo5 Estilo25"><b>
                                  <font size="1" face="Verdana">Password</font></b></DIV></TD>
                      <TD class=txt_gray width="109"><input name='oldpwd' type='password' id='oldpwd' maxlength='10'>                        </TR>
                              <tr>
                                <td width="109"><span class="Estilo24">Strength&nbsp;52 +</span></td>
                                <td width="76"><input name="strength" value="0" size="7" maxlength="7"></td>
                              </tr>
                              <tr>
                                <td width="109"><span class="Estilo24">Agility&nbsp;73 +</span></td>
                                <td width="76"><input name="dexterity" value="0" size="7" maxlength="7"></td>
                              </tr>
                              <tr>
                                <td width="109"><span class="Estilo24">Vitality&nbsp;149 +</span></td>
                                <td width="76"><input name="vitality" value="0" size="7" maxlength="7"></td>
                              </tr>
                              <tr>
                                <td width="109"><span class="Estilo24">Energy&nbsp;30 +</span></td>
                                <td width="76"><input name="energy" value="0" size="7" maxlength="7"></td>
                              </tr>
                              </tbody>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" width="404"><table width="241" border="0" cellspacing="0" cellpadding="3">
                            <tbody>
                              <tr>
                                <td width="235" align="center"><strong><img src="images/botonok.jpg" width="100" height="22" onClick="chgform.submit()"></strong>&#12288;<img src="images/botonX.jpg" width="100" height="22" onClick="chgform.reset()"></td>
                              </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
              </tbody>
              </table>
              <p>&nbsp;</p>
          </form>
		  
<span class="Estilo30">
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
    </span></td>
<tr>
<td width="404" height="40" align="left"><p>&nbsp;</p>
<tr><td width="416"></div>
</td>
</body>



</body>
</html>