<?= $this->extend('templates/dashboard'); ?>

<!-- End Banner -->
<?= $this->section('content'); ?>

<!-- Page Heading -->
<section class="py-5">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="content-heading mb-0 text-gray-800">Tambah Fasilitas</h3>
  </div>

  <form action="/admin/facility/save" method="post" class="user">
    <?= csrf_field(); ?>
    <div class="form-group row">
      <label for="facility" class="col-sm-2 col-form-label">Fasilitas<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.facility') ? 'is-invalid' : ''); ?>" id="facility" name="facility" placeholder="Fasilitas...">
        <div class="invalid-feedback">
          <?= $validation->getError('facility'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="icon" class="col-sm-2 col-form-label">Icon<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.icon') ? 'is-invalid' : ''); ?>" id="icon" name="icon" placeholder="Class icon Fontawesome...">
        <div class="invalid-feedback">
          <?= $validation->getError('icon'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-checkbox small">
        <input type="checkbox" class="custom-control-input" id="active" name="active" checked>
        <label class="custom-control-label" for="active">Active?</label>
      </div>
    </div>
    <button type="submit" class="btn btn-warning btn-user btn-sm">Save</button>
    <a href="/admin/facility" class="btn btn-secondary btn-user btn-sm">Cancel</a>
  </form>
</section>
<?= $this->endSection(); ?>