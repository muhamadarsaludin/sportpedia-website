<?= $this->extend('templates/main'); ?>
<?= $this->section('banner'); ?>
<!-- Banner -->
<!-- <div class="banner-container">
  <div>
    <img class="banner-img shadow" src="/img/banner/1.png">
  </div>
</div> -->
<div class="banner-container row">
  <div class="col-12">
    <img class="banner-img w-100 rounded" src="/img/banner/banner.png">
  </div>
  <div class="col-12">
    <img class="banner-img w-100 rounded" src="/img/banner/banner.png">
  </div>
</div>


<?= $this->endSection(); ?>
<!-- End Banner -->

<!-- CONTENT -->
<?= $this->section('content'); ?>

<?php $this->endSection(); ?>
<!-- END CONTENT -->

<!-- SCRIPT -->
<?= $this->section('script'); ?>
<script>
  $('.banner-container').slick({
    slidesToShow: 1,
    autoplay: true,
    infinite: true,
  });
</script>
<?= $this->endSection(); ?>