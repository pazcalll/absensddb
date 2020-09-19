<?php
$host	 = "127.0.0.1";
$user	 = "root";
$pass	 = "";
$dabname = "absensddb";

// include '_db.php';
$foldername="absensddb";
$conn = mysqli_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
mysqli_select_db($conn, $dabname) or die('Could not select database.');

$q=mysqli_query($conn, "Select * from data_absen_siswa");
require("../../_db.php");
$smes=$_GET['semester'];
$bulan=$_GET['blnadd'];
$matkul=$_GET['matkul'];
$tipe=$_GET['tipe'];
$tglskrg='2001-01-01';
$tglakhir='2001-01-01';
$result=mysqli_query($conn,"SELECT data_absen_siswa.nis, siswa.nama, Kelas.nama_Kelas, mata_pelajaran.nama_mata_pelajaran,count(data_absen_siswa.nis) as Jumlah_Hadir
FROM (((data_absen_siswa LEFT JOIN jadwal_sekolah ON data_absen_siswa.id_jadwal = jadwal_sekolah.id_jadwal) LEFT JOIN kelas ON jadwal_sekolah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_pelajaran ON jadwal_sekolah.kode_mata_pelajaran = mata_pelajaran.kode_mata_pelajaran) LEFT JOIN siswa ON data_absen_siswa.nis = siswa.nis Where data_absen_siswa.tgl between '".$tglskrg."' and '".$tglakhir."'");
if($tipe=="SISWA")
{
$q=mysqli_query($conn,"Select * from data_absen_siswa where kode_mata_pelajaran='".$matkul."' and semester='".$smes."' order by tgl ASC") or die(mysqli_error($conn));
}elseif($tipe=="GURU")
{
	$q=mysqli_query($conn,"Select * from data_absen_guru where kode_mata_pelajaran='".$matkul."' and semester='".$smes."' order by tgl ASC") or die(mysqli_error($conn));
}
$r=mysqli_fetch_array($q);
$tglskrg=$r['tgl'];
$tglakhir=date("Y-m-d",strtotime($tglskrg.' + '.$bulan.' months'));
if($tipe=="SISWA")
{
$result=mysqli_query($conn,"SELECT data_absen_siswa.nis, siswa.nama, Kelas.nama_Kelas, mata_pelajaran.nama_mata_pelajaran,count(data_absen_siswa.nis) as Jumlah_Hadir
FROM (((data_absen_siswa LEFT JOIN jadwal_sekolah ON data_absen_siswa.id_jadwal = jadwal_sekolah.id_jadwal) LEFT JOIN kelas ON jadwal_sekolah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_pelajaran ON jadwal_sekolah.kode_mata_pelajaran = mata_pelajaran.kode_mata_pelajaran) LEFT JOIN siswa ON data_absen_siswa.nis = siswa.nis Where data_absen_siswa.tgl between '".$tglskrg."' and '".$tglakhir."'");
}elseif($tipe=="Guru")
{
$result=mysqli_query($conn,"SELECT data_absen_guru.nip, guru.nama, kelas.nama_kelas, mata_pelajaran.nama_mata_pelajaran,count(data_absen_guru.nip) as Jumlah_Hadir
FROM (((data_absen_guru LEFT JOIN jadwal_sekolah ON data_absen_guru.id_jadwal = jadwal_sekolah.id_jadwal) LEFT JOIN jurusan ON jadwal_sekolah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_pelajaran ON jadwal_sekolah.kode_mata_pelajaran = mata_pelajaran.kode_mata_pelajaran) LEFT JOIN guru ON data_absen_guru.nip = guru.nip Where data_absen_guru.tgl between '".$tglskrg."' and '".$tglakhir."'");
}

$filename="LapTengahSemester-".$smes."-".$tipe;
$file_ending = "xls";
 
header("Content-Type: application/ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
if($bulan=="3")
{
 print("LAPORAN ABSENSI ".$tipe." TENGAH SEMESTER ".$smes);
}else{
 print("LAPORAN ABSENSI ".$tipe." SEMESTER ".$smes);
}
		print "\n";
$sep = "\t";

 

for ($i = 0; $i < mysqli_num_fields($result); $i++) {
echo mysqli_field_seek($result,$i) . "\t";
}
print("\n");

 

    while($row = mysqli_fetch_array($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
		
        $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
		
        print(trim($schema_insert));
        print "\n";
		
    }
?>