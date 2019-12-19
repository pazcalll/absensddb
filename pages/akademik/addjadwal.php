<script src="js/jquery-ui.js"></script>
<script>
// $(function() {
// $("#datepicker3").datepicker({        
// 		 dateFormat: "yy-mm-dd",
//     });
// });
</script>
<?php
ob_start();
?>
<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
<div class="control-group">
<label class="control-label">ID Jadwal</label>
<div class="controls">
<input type="text" name="id_jadwal" id="datepicker3" class="input-small">
</div>
</div>
<div class="control-group">
<label class="control-label">Hari</label>
<div class="controls">
<input type="text" name="tgl" id="datepicker3" class="input-small">
</div>
</div>
<div class="control-group">
<label class="control-label">Jam Mulai</label>
<div class="controls">
<input type="text" name="jam" id="jam" class="input-small">Ex. 15:45
</div>
</div>
<div class="control-group">
<label class="control-label">Jam Selesai</label>
<div class="controls">
<input type="text" name="jam_selesai" id="jam" class="input-small">Ex. 15:45
</div>
</div>
<div class="control-group">
<label class="control-label">NIP</label>
<div class="controls">
<input type="text" name="nip" id="jam" class="input-small">
</div>
</div>
<!-- <div class="control-group">
<label class="control-label">Jurusan</label>
<div class="controls">
<?php
$q=mysql_query("Select * from jurusan");
while($r=mysql_fetch_array($q))
{
?>
<select name="jurusan" id="jurusan">
<option value="<?php echo $r['kode_jurusan']; ?>"><?php echo $r['nama_jurusan']; ?></option>
</select>
<?php
}
?>
</div>
</div> -->
<div class="control-group">
<label class="control-label">Kode Kelas</label>
<div class="controls">
<select name="kelas" id="kelas">
<?php
$q=mysql_query("Select * from kelas");
while($r=mysql_fetch_array($q))
{
?>
<option value="<?php echo $r['kode_kelas']; ?>"><?php echo $r['kode_kelas']; ?></option>

<?php
}
?>
</select>
</div>
</div>

<!-- <div class="control-group">
<label class="control-label">Dosen</label>
<div class="controls">
<?php
$q=mysql_query("Select * from dosen");
while($r=mysql_fetch_array($q))
{
?>
<select name="dosen" id="dosen">
<option value="<?php echo $r['nid']; ?>"><?php echo $r['nama']; ?></option>
</select>
<?php
}
?>
</div>
</div> -->
<div class="control-group">
<label class="control-label">Kode Mata Pelajaran</label>
<div class="controls">
<select name="matkul" id="matkul">
<?php
$q=mysql_query("Select * from mata_pelajaran");
while($r=mysql_fetch_array($q))
{
?>

<option value="<?php echo $r['kode_mata_pelajaran']; ?>"><?php echo $r['kode_mata_pelajaran']; ?></option>
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
<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Simpan Data" />
</div>
</div>
<?php
if(isset($_POST['simpan']))
{
	$q=mysql_query("Select count(id_jadwal) as rw from jadwal_sekolah where hari='".$_POST['tgl']."' and jam_mulai='".$_POST['jam']."' and jam_selesai='".$_POST['jam_selesai']."' and nip='".$_POST['nip']."' and semester ='".$_POST['semester']."' and kode_mata_pelajaran='".$_POST['matkul']."'");
	$r=mysql_fetch_array($q);
	$jml=$r['rw'];
	if($jml=="1")
	{
		echo "Jadwal ini sudah ada";
	}else{
		$q1=mysql_query("Insert into jadwal_sekolah (`id_jadwal` ,`hari`,`jam_mulai`, `jam_selesai`,`kode_kelas`,`nip`,`semester`,`kode_mata_pelajaran`) values 
		('".$_POST['id_jadwal']."','".$_POST['tgl']."' ,'".$_POST['jam']."' ,'".$_POST['jam_selesai']."','".$_POST['kelas']."','".$_POST['nip']."',
		'".$_POST['semester']."','".$_POST['matkul']."')");
		if($q1)
		{
			echo "<script>alert('Berhasil ditambahkan')</script>";
		}
	}
	
}
?>
<?php
ob_end_flush();
?>