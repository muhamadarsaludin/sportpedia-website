<?= $this->extend('templates/dashboard'); ?>

<!-- End Banner -->
<?= $this->section('content'); ?>
<section class="py-5">
  <div class="d-sm-flex align-items-center justify-content-between">
    <h3 class="content-heading mb-0 text-gray-800">Detail User</h3>
    <a href="/admin/users/main/edit/<?= $user['id']; ?>" class="d-block d-sm-inline-block btn rounded-pill btn-warning"><i class="fas fa-plus-square mr-1"></i> Edit User</a>
  </div>
  <div class="flash-data" data-flashdata="<?= session()->getFlashdata('message'); ?>"></div>
  <?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('message'); ?>
    </div>
  <?php endif; ?>
  <form action="/admin/users/main/update/<?= $user['id']; ?>" method="post" class="user mt-4">
    <?= csrf_field(); ?>
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= (old('username')) ? old('username') : $user['username']; ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat email" value="<?= (old('email')) ? old('email') : $user['email']; ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="role" class="col-sm-2 col-form-label">Role User</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-user" id="role" name="role" placeholder="Role User" value="<?= (old('role')) ? old('role') : 'user'; ?>" readonly>
      </div>
    </div>

  </form>
  <div class="table-responsive">
    <table class="table table-bordered td-align-middle" id="dataVendors" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th width='100px'>Logo</th>
          <th>Vendor Name</th>
          <th>Service</th>
          <!-- <th>Owner</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Logo</th>
          <th>Vendor Name</th>
          <th>Service</th>
          <!-- <th>Owner</th> -->
          <th>Action</th>
        </tr>
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
</script>
<?= $this->endSection(); ?>