<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>List View</title>
<?php include 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<div data-role="page" data-theme="a">
<div data-role="header">
<a href="Index.php" data-icon="back" data-role="button" data-inline="true" data-transition="flip">Kembali</a>
<h1 align="center">Menggunakan Form Input</h1>
</div>
<div data-role="content"> 
<ul data-role="listview" data-inset="true">
   <li data-role="fieldcontain">
          <center><label for="name"><h1>List Mahasiswa</h1></label></center>
   </li>
  <form>
<table data-role="table" data-mode="columntoggle" class="ui-responsive" id="myTable" border="1">
  <thead>
    <tr>
      <th>NPM</th>
      <th data-priority="1">NAMA</th>
      <th data-priority="2">JENIS KELAMIN</th>
      <th data-priority="3">KELAS</th>
    </tr>
  </thead>
  <tbody>
<?php include 'koneksi.php';
 $hasil_db = mysql_query("SELECT * FROM data ");

 while ($data = mysql_fetch_array($hasil_db)){

  echo "<tr>
      <td>$data[NPM]</td>
      <td>$data[NAMA]</td>
      <td>$data[JENIS_KELAMIN]</td>
      <td>$data[KELAS]</td>"
   ?>
   <td><a href ="edit_mhs.php?id=<?php echo $data['No'];?>">Edit</a> || <a href ="delete_mhs.php?id=<?php echo $data['No'];?>">Hapus</a></td>
   <?php
   echo"
    </tr>";
} ?>
  </tbody>
</table>
    </form>
  </ul>
 </div>
<div data-role="footer" data-position="fixed">
<h2>@Agan Islah</h2>
</div>
</div>
</body>
</html>