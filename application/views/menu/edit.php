<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Form Edit Menu</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php
          echo form_open('menu/edit/' . $menu['id'], 'role="form" class="form-horizontal"');
          echo form_hidden('id', $menu['id']);
          ?>
          <div class="card-body col-sm-10 text-right">
            <div class="form-group row">
              <label for="namaMenu" class="col-sm-2 col-form-label">Nama Menu</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="namaMenu" placeholder="Nama Menu" value="<?php echo $menu['nama_menu']; ?>" name="nama_menu">
              </div>
            </div>
            <div class="form-group row">
              <label for="link" class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                <input type="link" class="form-control" id="link" placeholder="link" name="link" value="<?php echo $menu['link'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="icon" class="col-sm-2 col-form-label">Icon</label>
              <div class="col-sm-10">
                <input type="icon" class="form-control" id="icon" placeholder="icon" name="icon" value="<?php echo $menu['icon'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="is_main_menu" class="col-sm-2 col-form-label">is_main_menu</label>
              <div class="col-sm-10">
                <select name="is_main_menu" class="form-control col-sm-5" id="is_main_menu">
                  <option value="0">Main Menu</option>
                  <?php
                  $tabelmenu = $this->db->get('tabel_menu');
                  foreach ($tabelmenu->result() as $row) {
                    echo "<option value='$row->id' ";
                    echo $row->id == $menu['is_main_menu'] ? 'selected' : '';
                    echo ">$row->nama_menu</option> ";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success" name="submit">Update</button>
            <?php
            echo anchor('menu', 'Kembali', array('class' => 'btn btn-danger'));
            ?>
          </div>
          <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
</section>