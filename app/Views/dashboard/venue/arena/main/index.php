<?= $this->extend('templates/dashboard'); ?>

<!-- CONTENT -->
<?= $this->section('content'); ?>
<section class="py-2">
  <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>
  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('message'); ?>
    </div>
  <?php endif; ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Arena</h6>

      <a href="/venue/arena/main/add" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-plus-square"></i>
        </span>
        <span class="text">Tambah Arena</span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th width="50">Image</th>
              <th>Olahraga</th>
              <th>Rating</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th width="50">Image</th>
              <th>Olahraga</th>
              <th>Rating</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($arenas as $arena) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><img src="/img/venue/arena/main-images/<?= $arena['arena_image']; ?>" alt="" class="w-100"></td>
                <td><?= $arena['sport_name']; ?></td>
                <td><?= $arena['rating'] == null ? 'Belum Ada Penilaian' : $arena['rating']; ?></td>
                <td><?= $arena['active'] == 1 ? 'Aktif' : 'Non Aktif'; ?></td>
                <td class="text-center">
                  <a href="/venue/arena/main/detail/<?= $arena['slug']; ?>" class="btn btn-info btn-sm"><i class="d-lg-none fa fa-pencil-alt"></i><span class="d-none d-lg-inline">Detail</span></a>
                  <a href="/venue/arena/main/edit/<?= $arena['id']; ?>" class="btn btn-warning btn-sm"><i class="d-lg-none fa fa-pencil-alt"></i><span class="d-none d-lg-inline">Edit</span></a>
                  <form action="/venue/arena/main/<?= $arena['id']; ?>" method="POST" class="d-inline form-delete">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm btn-delete"><span class="d-lg-none fa fa-trash"></span><span class="d-none d-lg-inline">Hapus</span></span></button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



</section>
<?= $this->endSection(); ?>
<!-- END CONTENT -->

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
<?= $this->endSection(); ?>