<?= $this->extend('templates/main'); ?>

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
      <h6 class="m-0 font-weight-bold text-primary">Datail Transaksi</h6>
    </div>
    <div class="card-body">


      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pesan</th>
                  <th>Kode Lapangan</th>
                  <th>Jadwal</th>
                  <th>Harga</th>
                  <th>Akasi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pesan</th>
                  <th>Kode Lapangan</th>
                  <th>Jadwal</th>
                  <th>Harga</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($details as $detail) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
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