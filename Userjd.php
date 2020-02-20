<html>
<head>
<LINK REL="StyleSheet" HREF="style/.css" TYPE="text/css">
<style type="text/css">
<!--
.Estilo5 {
	color: #cfb8a2;
	font-weight: bold;
}
.Estilo6 {
	color: #cfb8a2;
	font-weight: bold;
}
.Estilo7 {color: #cfb8a2}
.Estilo9 {color: #CCCCCC}
-->
</style>
</head>
<body leftmargin="0" topmargin="0">
<p>
  <?PHP include("config.htpasswd"); ?>
  
  
</p>
<FORM method=post name=chgform action=userdj.asp> <input type="hidden" name="action" value="dl">
  <tr>
    <td width="404" height="40" align="left"><table align="center" border="1" cellpadding="0" cellspacing="0" width="1" bordercolor="#666666" frame="vsides" rules="none">
      <tbody>
        <tr>
          <td width="1" height="190"></td>
          <td width="244" align="left" valign="middle" bgcolor="#FFFFFF"><table width="1" height="199" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#211A12">
              <tbody>
                <tr>
                  <td width="241" height="40" align="left"><table width="239" border="0" cellspacing="0" cellpadding="3">
                      <tbody>
                        <tr>
                          <td align="center" width="233"><table height="1" cellspacing="6" cellpadding="0" width="227" border="0">
                              <tbody>
                                <tr>
                                  <td height="1" width="214"><div class="Estilo6" v:shape="_x0000_s1026">Repartir Puntos</div></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td height="92" align="center" width="241"><table align="left" border="0" cellpadding="5" cellspacing="1" width="241">
                      <tbody>
                        <tr>
                          <td align="right" colspan="2" width="229"><div align="left" class="Estilo6">Se quitaran<span class="Estilo9"> 1000000</span>&nbsp;Zen para Repartir los puntos</div></td>
                        </tr>
                        <tr>
                          <td align="right" width="60"><div align="left" class="Estilo6">Nombre del pj:</div></td>
                          <td width="158"><input name="name" type="text" size="17" maxlength="16"></td>
                        </tr>
                        <tr>
                          <td align="right" width="60"><div align="left" class="Estilo6"><strong>Nombre de la Cuenta:</strong></div></td>
                          <td width="158"><input name="login" type="text" size="17" maxlength="16"></td>
                        </tr>
                        <tr>
                          <td width="60"><span class="Estilo6"><strong>Password:</strong></span></td>
                          <td width="158"><input name="oldpwd" type="password" size="17" maxlength="16"></td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td height="25" align="left" width="241"><table width="238" border="0" cellspacing="0" cellpadding="3">
                      <tbody>
                        <tr>
                          <td width="232" align="center"><img src="images/botonok.jpg" width="100" height="22" onClick="chgform.submit()">&nbsp;<img src="images/botonX.jpg" width="100" height="22" onClick="chgform.reset()"></td>
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
<p>&nbsp;</p>
    </body>
</html>
</body>
</html>