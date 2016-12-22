<?php
include "koneksi.php";

$sql = "insert into data (NPM, NAMA, JENIS_KELAMIN, KELAS)
        values('$_POST[npm]', '$_POST[nama]','$_POST[jk]','$_POST[kelas]')
		";
echo $sql;
mysql_query($sql2);

?>
<!-- script>
 window.location='Index.php';
</script -->