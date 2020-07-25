<?php
 global $mysqli;
 $host="localhost";
 $user="root";
 $pass="5piderm4n";
 $database="dbadminlte";
 $mysqli=new mysqli($host,$user,$pass,$database);
 if (mysqli_connect_errno()) {
   trigger_error('Koneksi ke database gagal: '  . mysqli_connect_error(), E_USER_ERROR); 
 }
?>
<style>
    table{
        border-collapse : collapse;
        table-layout:fixed;
        width :483px;

    }
    table td{
        width:15%;
    }
</style>
<html>
<body>
<!-- kop surat -->
<table border="1" cellpading="1">
    <tr>
        <td style="width:40%; align=center;">
            <img src="../../assets/img/AdminLTELogo.png" width = "480" height="100" alt="">
        </td colspan="">
        <td style="width:80%;">
          <h3 style="text-align: center;">
          REPORT DATA USER
        </h3>
        </td>
        <td style="align=center;width:35%;">
            jl. Asia-Afrika, Bandung-jawa barat (indonesia)
        </td>
      </tr>
    </table>
    <br><br>

<!-- isi report -->
<?php
        $no = 0;
        $admin=$mysqli->query("SELECT * FROM tbuser");
        while($m=mysqli_fetch_array($admin)){
        $no++;  
?>
<table  border="1" cellpading="1">
    <tr >
        <td colspan='3' style="width:80%;">KARTU ID KARYAWAN</td>
    </tr>
    <tr>
        <td rowspan='3' style="width:8%; height:8%;"> 
        <?php
            $kode = "pt.adminlte/".$m['iduser']."/".$m['namauser']."";
            require_once('../../assets/qrcode/qrlib.php');
            QRcode::png("$kode","kode".$no.".png","M", 2,2);
        ?>
        <img src="kode<?= $no ?>.png" style = "width:90%; height:90%;" alt="">
        </td>
    </tr>
    <tr>
        <td style="width:20%;">NIK :<?php echo $m['iduser']; ?></td>
    </tr>
    <tr>
            <td>NAMA : <?php echo $m['namauser']; ?></td>
    </tr>
</table>
<br><br>
<?php } ?>
</body>
</html>

<?php
    $html = ob_get_contents();
    ob_end_clean();
    
    require_once('../../assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output('report_user.pdf','D');
?>