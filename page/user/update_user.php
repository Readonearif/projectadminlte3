<?php
     $nid = $_POST['iduser'];
     $nama = $_POST['nama'];
     $stat = $_POST['status'];
     $pswd = $_POST['pswd'];
    
     $mysqli->query("UPDATE tbuser SET namauser = '$nama',
                                        setatus = '$stat',
                                        pasword = '$pswd'
                                        WHERE iduser = '$nid'");
                                        
     echo "<script>alert('Data berhasil dirubah')</script>";
     echo "<script type='text/javascript'> document.location = 'index.php?page=data_user'; </script>"; 
?>