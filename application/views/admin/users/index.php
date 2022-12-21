<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>
  <div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-primary mb-2 tombolTambahUser" data-toggle="modal" data-target="#formModalUserubah"><i class="fas fa-plus-circle"></i> Tambah Data User</button>
    </div>
  </div>
  <div class="row">
    <div class="col-md">
      <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible show fade" role="alert">
          <?= $this->session->flashdata('pesan');; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- Content Row -->
  <div class="row">
    <div class="col-md">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Nama Pegawai</th>
                  <th>Roles</th>
                  <th><i class="fas fa-cogs"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($users as $p) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['username']; ?></td>
                    <td><?= $p['nama_pegawai']; ?></td>
                    <td><?= $p['nama_roles']; ?></td>
                    <td>
                      <?php if ($p['status'] == 0) : ?>
                        <div class="badge badge-danger" role="alert">Nonaktif</div>
                      <?php else : ?>
                        <div class="badge badge-success" role="alert">Aktif</div>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary tombolUbahUser" data-toggle="modal" data-target="#formModalUserubah" data-id="<?= $p['id_user']; ?>"><i class="fas fa-edit"></i></button>
                      <a href="<?= base_url('/admin/user/hapus/') . $p['id_user']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="formModalUserubah" tabindex="-1" aria-labelledby="formModalLabelUser" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabelUser">Ubah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formModalUser" enctype="multipart/form-data">
          <input type="hidden" id="id_user" name="id_user">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
            <small class="muted text-danger"><?= form_error('username'); ?></small>
          </div>
          <div class="form-group">
            <label for="nama_pegawai">Nama Pegawai</label>
            <select name="nama_pegawai" id="nama_pegawai" class="form-control">
              <option value="">-- Pilih Pegawai --</option>
              <?php foreach ($pegawai as $j) : ?>
                <option value="<?= $j['id_pegawai']; ?>"><?= $j['nama_pegawai']; ?></option>
              <?php endforeach; ?>
            </select>
            <small class="muted text-danger"><?= form_error('nama_pegawai'); ?></small>
          </div>
          <div class="form-group">
            <label for="roles">Roles</label>
            <select name="roles" id="roles" class="form-control">
              <option value="">-- Pilih Roles --</option>
              <?php foreach ($roles as $j) : ?>
                <option value="<?= $j['id_roles']; ?>"><?= $j['nama_roles']; ?></option>
              <?php endforeach; ?>
            </select>
            <small class="muted text-danger"><?= form_error('nama_roles'); ?></small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
            <small class="muted text-danger"><?= form_error('password'); ?></small>
          </div>
          <div class="modal-footer">
            <button type="reset" id="btnCloseModalUser" class="btn btn-info" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>