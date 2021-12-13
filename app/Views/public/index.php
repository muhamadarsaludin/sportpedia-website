<?= $this->extend('templates/main'); ?>

<!-- Banner -->
<?= $this->section('banner'); ?>
<?php if ($banners) : ?>
  <div class="banner-container row">
    <?php foreach ($banners as $banner) : ?>
      <div class="col-12">
        <img class="banner-img w-100 rounded" src="/img/banner/<?= $banner['image']; ?>">
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
<?= $this->endSection(); ?>
<!-- End Banner -->

<!-- CONTENT -->
<?= $this->section('content'); ?>

<section class="mt-4">
  <!-- Category -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kategori Olahraga</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <?php foreach ($sports as $sport) : ?>
          <div class="col-3 col-lg-1">
            <a href="/sports/<?= $sport['slug']; ?>">
              <img src="/img/sports/<?= $sport['sport_icon']; ?>" alt="" class="img-category rounded w-100">
              <p class="text-center text-gray-600"><?= $sport['sport_name']; ?></p>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!-- End Category -->

  <!-- Show All Arena -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Futsal</h6>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12 col-lg-3">
      <a href="/arena/slug" class="clear-style">
        <div class="card shadow text-gray-600">
          <img class="card-img-top img-card-arena" src="/img/venue/arena/main-images/arena1.jpg">
          <div class="card-body">
            <h6 class="m-0 font-weight-bold d-inline mr-2 text-gray-700">Aulia Sport Center</h6><span class="badge badge-primary">Futsal</span>
            <p class="mt-1"><span class="small">start from</span> <span class="card-price text-primary font-weight-bold text-lg">Rp<?= number_format(150000, 0, ',', '.'); ?>,-</span></p>
            <div class="rating">
              <span class="fa fa-star text-warning"></span>
              <span class="fa fa-star text-warning"></span>
              <span class="fa fa-star text-warning"></span>
              <span class="fa fa-star text-warning"></span>
              <span class="fa fa-star text-secondary"></span>
              <span class="small">4.2 | 200 Penilaian</span>
            </div>
          </div>
          <div class="card-footer">
            <p class="m-0">Tasikmalaya</p>
          </div>
        </div>
      </a>
    </div>
  </div>

</section>
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