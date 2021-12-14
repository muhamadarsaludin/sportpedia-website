<?= $this->extend('templates/dashboard'); ?>

<!-- End Banner -->
<?= $this->section('content'); ?>

<!-- Page Heading -->
<section class="py-5">
  <div class="d-sm-flex align-items-center justify-content-between">
    <h3 class="content-heading mb-0 text-gray-800">Daftar Fasilitas</h3>
    <a href="/admin/facility/add" class="d-block d-sm-inline-block btn rounded-pill btn-warning"><i class="fas fa-plus-square mr-1"></i> Tambah Fasilitas</a>
  </div>
  <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>

  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('message'); ?>
    </div>
  <?php endif; ?>
  <div class="container-fluid table-responsive">
    <table class="table table-bordered" id="dataUsers" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Icon</th>
          <th>Fasilitas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Icon</th>
          <th>Fasilitas</th>
          <th>Aksi</th>
        </tr>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($facilities as $facility) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td class="text-center"><i class="<?= $facility['icon']; ?>"></i></td>
              <td><?= $facility['facility_name']; ?></td>
              <td class="text-center">
                <a href="/admin/facility/detail/<?= $facility['id']; ?>" class="btn btn-action btn-sm small mb-1"><span class="d-lg-none fa fa-eye"></span><span class="d-sm-none d-lg-inline">Detail</span></a>
                <a href="/admin/facility/edit/<?= $facility['id']; ?>" class="btn btn-action btn-sm small mb-1"><span class="d-lg-none fa fa-pencil-alt"></span><span class="d-sm-none d-lg-inline">Edit</span></a>
                <form action="/admin/facility/<?= $facility['id']; ?>" method="POST" class="d-inline form-delete">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-action btn-sm small mb-1 btn-delete"><span class="d-lg-none fa fa-trash"></span><span class="d-sm-none d-lg-inline">Delete</span></span></button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </tfoot>
      <tbody>
      </tbody>
    </table>
  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#dataUsers').DataTable();
  });

  const swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    autoplay: {
      delay: 4000,
    },
    loop: true,
  });

  const swiperService = new Swiper('.swiper-container-service', {
    slidesPerView: 6,
    spaceBetween: 25,
  });
</script>
<?= $this->endSection(); ?>