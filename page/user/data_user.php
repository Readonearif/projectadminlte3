<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data user dan admin</h3>
                <br>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
                <i class = "fa fa-add"> Tambah User </i>
                </button>
                <a href="index.php?page=import_data">
                <button type="button" class="btn btn-success">
                <i class = "fa fa-save"> Import Data </i>
                </a>
                </button>
                <br><br>

                <a href="page/user/print_user.php">
                <button type="button" class="btn btn-success" >
                  <i class = "fa fa-print"> Print User </i>
                </button>
                </a>
                <a href="page/user/card_user.php">
                <button type="button" class="btn btn-primary" >
                  <i class = "fa fa-print"> Card User </i>
                </button>
                </a>
                <a href="page/user/export.php">
                <button type="button" class="btn btn-danger" >
                  <i class = "fa fa-print"> Export Data </i>
                </button>
                </a>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>QR CODE</th>
                        <th>IDUSER</th>
                        <th>NAMA USER</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 0;
                        $admin=$mysqli->query("SELECT * FROM tbuser");
                        while($m=mysqli_fetch_array($admin)){
                        $no++;  
                    ?>
                    <tr>
                        <td><?php echo $no ; ?></td>
                        <td>
                          <?php
                            $kode = "pt.adminlte/".$m['iduser']."/".$m['namauser']."";
                            require_once('assets/qrcode/qrlib.php');
                            QRcode::png("$kode","kode".$no.".png","M", 2,2);
                          ?>
                          <img src="kode<?= $no ?>.png" alt="">
                        </td>
                        <td><?php echo $m['iduser']; ?></td>
                        <td><?php echo $m['namauser']; ?></td>
                        <td><?php echo $m['setatus']; ?></td>
                        <td>
                        <a href="index.php?page=edit_user&kode=<?php echo $m['iduser'];?>">
                          <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        </a>
                        <a href="index.php?page=delete_user&kode=<?php echo $m['iduser'];?>" onclick="return confirm('yakin akan menghapus data?')">
                          <button type="button" class="btn btn-danger"><i class="fa fa-edit"></i></button>
                        </a>
                        </td>
                        
                    </tr>
                        <?php } ?>
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      <!-- modal form tambah data -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">FORM TAMBAH USER</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="post" action="index.php?page=create_user">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">ID USER</label>
                    <input type="text" class="form-control" name="iduser" placeholder="type user id">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NAMA</label>
                    <input type="text" class="form-control" name="nama" placeholder="type user id">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">STATUS</label>
                    <input type="text" class="form-control" name="status" placeholder="type user id">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="pswd" placeholder="Password">
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      