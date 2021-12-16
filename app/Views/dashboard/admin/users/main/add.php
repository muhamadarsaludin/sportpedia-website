<?= $this->extend('templates/dashboard'); ?>

<!-- End Banner -->
<?= $this->section('content'); ?>

<!-- Page Heading -->
<section class="py-5">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="content-heading mb-0 text-gray-800">Tambah User</h3>
  </div>

  <form action="/admin/users/main/save" method="post" class="user">
    <?= csrf_field(); ?>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Alamat Email<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.email') ? 'is-invalid' : ''); ?>" id="email" name="email" placeholder="Alamat email..." value="<?= (old('email') ? old('email') : ''); ?>">
        <div class="invalid-feedback">
          <?= $validation->getError('email'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user <?= (session('errors.username') ? 'is-invalid' : ''); ?>" id="username" name="username" placeholder="Username..." value="<?= (old('username') ? old('username') : ''); ?>">
        <div class="invalid-feedback">
          <?= $validation->getError('username'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="role" class="col-sm-2 col-form-label">Role<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <select class="custom-select" id="role-id" name="role-id">
          <option selected>Pilih salah satu...</option>
          <?php foreach ($roles as $role) : ?>
            <option value="<?= $role['id']; ?>"><?= $role['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password<sup class="text-danger font-weight-bold">*</sup></label>
      <div class="col-sm-10">
        <div class="form-group row">
          <div class="col-sm-6 mb-2">
            <i class="visible fas fa-eye-slash"></i>
            <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" id="password" placeholder="Password" autocomplete="off">
            <div class="invalid-feedback">
              <?= $validation->getError('password'); ?>
            </div>
          </div>
          <div class="col-sm-6 mb-2">
            <i class="visible fas fa-eye-slash"></i>
            <input type="password" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" id="pass_confirm" placeholder="Repeat Password" autocomplete="off">
            <div class="invalid-feedback">
              <?= $validation->getError('pass_confirm'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-warning btn-user btn-sm">Save</button>
    <a href="/admin/users/main" class="btn btn-secondary btn-user btn-sm">Cancel</a>
  </form>
</section>
<?= $this->endSection(); ?>