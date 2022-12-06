<?php require_once('Connections/local.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO contacto (Nombre, Email, Pais, `URL web`, Comentario) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Pais'], "text"),
                       GetSQLValueString($_POST['URL_web'], "text"),
                       GetSQLValueString($_POST['Comentario'], "text"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($insertSQL, $local) or die(mysql_error());

  $insertGoTo = "contacto-ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nombre:</td>
      <td><input type="text" name="Nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="Email" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Pais:</td>
      <td><input type="text" name="Pais" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">URL web:</td>
      <td><input type="text" name="URL_web" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>Comentario:</td>
      <td><textarea name="Comentario" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Enviar"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
