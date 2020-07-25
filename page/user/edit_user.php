<?php
    $edit = $mysqli->query("SELECT * FROM tbuser WHERE iduser = '$_GET[kode]'");
    $e = mysqli_fetch_array($edit);
?>
<form role="form" method="post" action="index.php?page=update_user">
    <div class="card-body">
        <div class="form-group">
        <label for="exampleInputEmail1">ID USER</label>
        <input type="text" class="form-control" name="iduser" value="<?php echo $e['iduser']; ?>"  placeholder="type user id">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">NAMA</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $e['namauser']; ?>"placeholder="type user id">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">STATUS</label>
        <input type="text" class="form-control" name="status" value="<?php echo $e['setatus']; ?>" placeholder="type user id">
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="pswd" value="<?php echo $e['pasword']; ?>" placeholder="Password">
        </div>
    
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>