<form method="post">
<div class="control-group">
<label class="control-label">Jurusan</label>
<div class="controls">
	<select name="jurusan" id="jurusan">
<?php

$host	 = "127.0.0.1";
$user	 = "root";
$pass	 = "";
$dabname = "absensddb";

$foldername="absensddb";
$conn = mysqli_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
mysqli_select_db($conn, $dabname) or die('Could not select database.');

$q=mysqli_query($conn, "Select * from kelas");
while($r=mysqli_fetch_array($q))
{
?>
<option value="<?php echo $r['kode_kelas']; ?>"><?php echo $r['nama_kelas']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Mata Pelajaran</label>
<div class="controls">
	<select name="matkul" id="matkul">
<?php
$q=mysqli_query($conn, "Select * from mata_pelajaran");
while($r=mysqli_fetch_array($q))
{
?>
<option value="<?php echo $r['kode_mata_pelajaran']; ?>"><?php echo $r['nama_mata_pelajaran']; ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Semester</label>
<div class="controls">
<input type="text" name="semester" id="semester" class="input-small">&nbsp;
</div>
</div>
<div class="control-group">
<div class="controls">
<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Cetak Data" />
</div>
</div>
</form>
<?php
if(isset($_POST['simpan']))
{
	echo "<script>window.location='".$baseurl."pages/web/lapabsen.php?semester=".$_POST['semester']."&blnadd=6&tipe=DOSEN&matkul=".$_POST['matkul']."'</script>";
}
?>