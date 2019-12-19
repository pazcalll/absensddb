<div align="left">
<h1>Data Guru</h1>
</div>

<div align="right">
<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=adddosen'">Tambah Data</button>

</div>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Nomor Induk Guru</td>
    <td>Nama Guru</td>  
    <td>Umur</td> 
    <td>Photo</td>      
    <td>&nbsp;</td>
  </tr>
  <?php

$host	 = "127.0.0.1";
$user	 = "root";
$pass	 = "";
$dabname = "absensddb";

$foldername="absensddb";
$conn = mysqli_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
mysqli_select_db($conn, $dabname) or die('Could not select database.');

  $rw=mysqli_query($conn, "Select * from Guru");
  while($s=mysqli_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['nip']; ?></td>
    <td><?php echo $s['nama']; ?></td>
    <td><?php echo $s['umur']; ?></td>
    <td>  
    <?php if($s['photo']!="")
	{
		?>
    <img src="<?php echo $baseurl."uploads/guru/".$s['photo']; ?> " width="50px" height="50px">
    <?php
	}else{
	?>
    <img src="<?php echo $baseurl."uploads/files/no-photo.jpg"; ?>" width="50px" height="50px">
    <?php
	}
	?>
   	
    </td>

    <td><a href="?cat=akademik&page=editguru&id=<?php echo sha1($s['nip']); ?>">Edit</a> - <a href="?cat=akademik&page=dosen&del=1&id=<?php echo sha1($s['nid']); ?>">Hapus</a></td>
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
	$ff=mysqli_query($conn, "Delete from guru Where sha1(nip)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=akademik&page=guru'</script>";
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