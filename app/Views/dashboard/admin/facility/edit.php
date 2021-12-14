<?= $this->extend('templates/dashboard'); ?>

<!-- End Banner -->
<?= $this->section('content'); ?>

<!-- Page Heading -->
<section class="py-5">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="content-heading mb-0 text-gray-800">Edit Fasilitas</h3>
  </div>
  <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>

  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('message'); ?>
    </div>
  <?php endif; ?>
  <form action="/admin/facility/update/<?= $facility['id']; ?>" method="post" class="user">
    <?= csrf_field(); ?>
    <div class="form-group row">
      <label for="facility" class="col-sm-2 col-form-label">Fasilitas<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.facility') ? 'is-invalid' : ''); ?>" id="facility" name="facility" placeholder="Nama Fasilitas" value="<?= (old('facility')) ? old('facility') : $facility['facility_name']; ?>">
        <div class="invalid-feedback">
          <?= $validation->getError('facility'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="icon" class="col-sm-2 col-form-label">icon<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.icon') ? 'is-invalid' : ''); ?>" id="icon" name="icon" placeholder="Class icon Fontawesome..." value="<?= (old('icon')) ? old('icon') : $facility['icon']; ?>">
        <div class="invalid-feedback">
          <?= $validation->getError('facility'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" rows="4"><?= $facility['description']; ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-checkbox small">
        <input type="checkbox" class="custom-control-input" id="active" name="active" checked>
        <label class="custom-control-label" for="active">Active?</label>
      </div>
    </div>
    <button type="submit" class="btn btn-warning btn-user btn-sm">Edit</button>
    <a href="/admin/facility" class="btn btn-secondary btn-user btn-sm">Cancel</a>
  </form>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#dataUsers').DataTable();
  });
</script>
<?= $this->endSection(); ?>