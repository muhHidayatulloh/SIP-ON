<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Menu</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!-- tombol tambah data menu -->
            <?php
            echo anchor('menu/add', '<button class="btn btn-success btn-flat mb-1">Tambah Data</button>');
            ?>

            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="12px">No</th>
                  <th>Nama Menu</th>
                  <th>Link</th>
                  <th>Is Main Menu</th>
                  <th>Icon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($menu as $data) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data->nama_menu; ?></td>
                    <td><?= $data->link; ?></td>
                    <td><?= $data->is_main_menu == 0 ? "Main Menu" : "Sub Menu"; ?></td>
                    <td><i class="<?= $data->icon ?>"></i></td>
                    <td class="text-center">
                      <?php
                      echo anchor('menu/edit/' . $data->id, '<button class="btn btn-info btn-xs mx-1"><i class="fas fa-edit"></i></button>');
                      ?>
                      <a href="<?= base_url('menu/delete/') . $data->id; ?>" class="btn btn-danger btn-xs alert_hapus"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>