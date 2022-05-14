<?php
include("modulos/ventas.php");
?>
<?php include("header.php") ?>
<!-- Main Sidebar Container -->
<?php include("sidebar.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Vistapanel.php">Home</a></li>
            <li class="breadcrumb-item active">Ventas</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control
                      float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Status</th>
                <th>Reason</th>
              </tr>
            </thead>
            <tbody>
              <?php $sentencia = $pdo->prepare("SELECT * FROM `ventas`");
              $sentencia->execute();
              while ($registro = $sentencia->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td><?php echo $registro['id'] ?></td>
                  <td><?php echo $registro['nombre'] ?></td>
                  <td><?php echo $registro['apellido'] ?></td>
                  <?php
                  $estado = $registro['status'];
                  if ($estado == 'completo') {
                    echo "<td><span class='badge badge-success'>".$estado."</span></td>";
                  } elseif ($estado == 'aprobado') {
                    echo "<td><span class='badge badge-info'>".$estado."</span></td>";
                  } else {
                    echo "<td><span class='badge badge-warning'>".$estado."</span></td>";
                  }
                  ?>
                  <td><?php echo $registro['numero'] ?></td>
                  <td><?php echo $registro['ciudad'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("footer.php") ?>