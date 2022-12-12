<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>
  <div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-primary mb-2 tombolTambahIntensif" data-toggle="modal" data-target="#formModalIntensif"><i class="fas fa-plus-circle"></i> Tambah Data</button>
      <?= $this->session->flashdata('pesan'); ?>
    </div>
  </div>
  <!-- Content Row -->
  <div class="row">
    <div class="col-md">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Intensif</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Intensif</th>
                  <th>Jumlah Intensif</th>
                  <th><i class="fas fa-cogs"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($intensif as $p) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['intensif']; ?></td>
                    <td><?= number_format($p['jml_intensif'], 0, ',', '.'); ?></td>
                    <td>
                      <button type="button" class="btn btn-primary tombolUbahIntensif" data-toggle="modal" data-target="#formModalIntensif" data-id="<?= $p['id_intensif']; ?>"><i class="fas fa-edit"></i></button>
                      <a href="<?= base_url('/admin/intensif/hapus/') . $p['id_intensif']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal -->
<div class="modal fade" id="formModalIntensif" tabindex="-1" aria-labelledby="formModalLabelIntensif" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabelIntensif">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" id="id_intensif" name="id_intensif">
          <div class="form-group">
            <label for="intensif">Jenis Intensif</label>
            <input type="text" name="intensif" id="intensif" class="form-control" value="<?= set_value('intensif'); ?>">
            <small class="muted text-danger"><?= form_error('intensif'); ?></small>
          </div>
          <div class="form-group">
            <label for="jml_intensif">Jumlah Intensif</label>
            <input type="number" name="jml_intensif" id="jml_intensif" class="form-control" value="<?= set_value('jml_intensif'); ?>">
            <small class="muted text-danger"><?= form_error('jml_intensif'); ?></small>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>