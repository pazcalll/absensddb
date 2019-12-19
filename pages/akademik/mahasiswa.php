<div align="left">
<h1>Data Siswa</h1>
</div>

<div align="right">
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=addmahasiswa'">Tambah Data</button>

</div>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Nomor Induk siswa</td>
    <td>Nama siswa</td>  
    <td>Umur</td> 
    <td>Kelas</td>
    <td>Photo</td>      
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("SELECT siswa.nis, siswa.nama, siswa.umur, kelas.kode_kelas, siswa.photo
FROM siswa LEFT JOIN kelas ON siswa.kode_kelas = kelas.kode_kelas");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['nis']; ?></td>
    <td><?php echo $s['nama']; ?></td>
    <td><?php echo $s['umur']; ?></td>
    <td><?php echo $s['kode_kelas']; ?></td>
    <td>  
    <?php if($s['photo']!="")
	{
		?>
    <img src="<?php echo $baseurl."uploads/mahasiswa/".$s['photo']; ?> " width="50px" height="50px">
    <?php
	}else{
	?>
    <img src="<?php echo $baseurl."uploads/files/no-photo.jpg"; ?>" width="50px" height="50px">
    <?php
	}
	?>
   	
    </td>

    <td><a href="?cat=akademik&page=editmahasiswa&id=<?php echo sha1($s['nis']); ?>">Edit</a> - <a href="?cat=akademik&page=mahasiswa&del=1&id=<?php echo sha1($s['nim']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from siswa Where sha1(nis)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=mahasiswa'</script>";
	}
}
?>
	<script type="text/javascript">
$(document).ready(function()
{
$("div.lightbox").bind("shown",function()
{
console.log("Shown Event",$(this).attr('id'));
});
});
</script>