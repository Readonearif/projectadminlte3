<?php
$id = $_POST['iduser'];
$name = $_POST['nama'];
$stat = $_POST['status'];
$pswd = $_POST['pswd'];

$mysqli->query("INSERT INTO tbuser VALUES ('$id','$name','$stat','$pswd')");

    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script type='text/javascript'> document.location = 'index.php?page=data_user'; </script>"; 
?>