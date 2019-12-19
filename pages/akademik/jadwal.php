<div align="left">
<h1>Mata Pelajaran</h1>
</div>

<input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah">    
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
<!-- <div align="right">
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=addjadwal'">Tambah Data</button> -->

</div>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Kode Mata Pelajaran</td>
    <td>Nama Mata Pelajaran</td>  
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("SELECT * FROM mata_pelajaran");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['kode_mata_pelajaran']; ?></td>
    <td><?php echo $s['nama_mata_pelajaran']; ?></td>
    <!-- <td><?php echo $s['jam_mulai']; ?></td>   
    <td><?php echo $s['nama_jurusan']; ?></td>
    <td><?php echo $s['nama_kelas']; ?></td>
    <td><?php echo $s['nama']; ?></td>
    <td><?php echo $s['nama_mata_kuliah']; ?></td>
    <td><?php echo $s['semester']; ?></td>
    <td>      -->
   	
    </td>

    <td><a href="?cat=akademik&page=editjadwal&id=<?php echo sha1($s['id_jadwal']); ?>">Edit</a> - <a href="?cat=akademik&page=jadwal&del=1&id=<?php echo sha1($s['id_jadwal']); ?>">Hapus</a></td>
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
	$ff=mysql_query("Delete from mata_pelajaran Where sha1(kode_mata_pelajaran)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=jadwal'</script>";
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

<!-- SELECT jadwal_kuliah.id_jadwal, jadwal_kuliah.tanggal, jadwal_kuliah.jam_mulai,  jurusan.nama_jurusan, kelas.nama_kelas, dosen.nama, jadwal_kuliah.semester, mata_kuliah.nama_mata_kuliah
FROM (((jadwal_kuliah LEFT JOIN dosen ON jadwal_kuliah.nid = dosen.nid) LEFT JOIN jurusan ON jadwal_kuliah.kode_jurusan = jurusan.kode_jurusan) LEFT JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah -->