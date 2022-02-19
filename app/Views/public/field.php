<?= $this->extend('templates/main'); ?>


<!-- Banner -->
<?= $this->section('banner'); ?>
<nav aria-label="breadcrumb pt-4">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/main/venue/<?= $venue['slug']; ?>"><?= $venue['venue_name']; ?></a></li>
    <li class="breadcrumb-item"><a href="/main/arena/<?= $arena['slug']; ?>">Arena <?= $arena['sport_name']; ?></a></li>
    <li class="breadcrumb-item"><?= $field['field_name']; ?></li>
  </ol>
</nav>

<div class="banner-container row">
  <div class="col-12">
    <img class="banner-img w-100 rounded" src="/img/venue/arena/fields/main-images/<?= $field['field_image']; ?>">
  </div>
  <?php foreach ($images as $image) : ?>
    <div class="col-12">
      <img class="banner-img w-100 rounded" src="/img/venue/arena/fields/other-images/<?= $image['image']; ?>">
    </div>
  <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>
<!-- End Banner -->


<?= $this->section('content'); ?>

<form id="payment-form" method="post" action="<?= base_url('transaction/finish'); ?>">
  <input type="text" name="result_type" id="result-type" value=""></div>
  <input type="text" name="result_data" id="result-data" value=""></div>
</form>

<section class="my-5">

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-2">
          <img src="/img/venue/logos/<?= $arena['logo']; ?>" alt="" class="w-100">
        </div>
        <div class="col-lg-7">
          <h5 class="m-0 font-weight-bold d-inline mr-2 text-gray-700"><?= $arena['venue_name']; ?></h5><span class="badge badge-primary"><?= $arena['level_name']; ?></span>
          <p class="m-0 mt-1"><?= $arena['address']; ?></p>
          <p class="mt-2 mb-0"><span class="small">start from</span> <span class="card-price text-primary font-weight-bold text-lg">Rp<?= number_format(150000, 0, ',', '.'); ?>,-</span></p>
          <div class="rating">
            <span class="fa fa-star text-warning"></span>
            <span class="fa fa-star text-warning"></span>
            <span class="fa fa-star text-warning"></span>
            <span class="fa fa-star text-warning"></span>
            <span class="fa fa-star text-secondary"></span>
            <span class="small">4.2 | 200 Penilaian</span>
          </div>
        </div>
        <div class="col-lg-3 text-right">
          <a href="/main/venue/<?= $arena['venue_slug']; ?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-fw fa-door-open"></i>
            </span>
            <span class="text">Kunjungi Venue</span>
          </a>
        </div>
      </div>
      <hr class="sidebar-divider">
      <h6 class="text-pirmary font-weight-bold">Fasilitas</h6>
      <?php if (session()->getFlashdata('facility-message')) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashdata('facility-message'); ?>
        </div>
      <?php endif; ?>


      <div class="row align-items-center mt-4">
        <?php foreach ($facilities as $facility) : ?>
          <?php if ($facility['served']) : ?>
            <div class="col-lg-3 mb-1 row">
              <div class="col-12">
                <p><i class="<?= $facility['icon']; ?>"></i> <?= $facility['facility_name']; ?></p>
              </div>
            </div>
          <?php endif ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Jadwal Operasional</h6>
    </div>
    <div class="card-body">
      <div class="row align-items-center mt-4">
        <?php foreach ($schedules as $schedule) : ?>
          <div class="col-lg-4 mb-1">
            <p><?= $schedule['day']; ?> : (<?= $schedule['start_time'] ? $schedule['start_time'] : ''; ?> - <?= $schedule['end_time'] ? $schedule['end_time'] : ''; ?>)</p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Pilih Jadwal</h6>
    </div>
    <div class="card-body row">
      <div class="col-7">
        <!-- <div class="input-group date mb-3">
          <input type="text" class="form-control" id="event-date">
          <div class="input-group-append input-group-addon">
            <span class="input-group-text fa fa-calendar-alt"></span>
          </div>
        </div> -->

        <form class="mb-4">
          <div class="input-group">
            <input type="date" class="form-control bg-light border-0 small" id="choose-date" name="choose-date" value="<?= $dateChoose ? $dateChoose : date('Y-m-d', time()); ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="row">
          <?php foreach ($details as $detail) : ?>
            <div class="col-3 mb-4">
              <button class="btn btn-light w-100 py-4 btn-detail-scedule" data-id="<?= $detail['id']; ?>">
                <span class="">(<?= date_format(date_create($detail['start_time']), 'H:i'); ?> - <?= date_format(date_create($detail['end_time']), 'H:i'); ?>)</span>
                <span> Rp<?= number_format($detail['price'], 0, ',', '.'); ?>,-</span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-5">
        <div class="card">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody class="list-order">

                </tbody>
              </table>
            </div>
            <h6 class="mb-4 font-weight-bold">Total : <span class="text-lg text-primary total-pay"></span></h6>
            <button class="btn btn-primary w-100" id="btn-pay">Bayar</button>
            <button class="btn btn-primary w-100 mt-4" id="btn-snap" data-snaptoken="">snap</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>



<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<!-- Initialize Swiper -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });

  $('.banner-container').slick({
    slidesToShow: 1,
    dots: true,
    autoplay: true,
    infinite: true,
  });


  let details = document.querySelectorAll(".btn-detail-scedule");
  let cart = [];
  console.log(details);
  details.forEach((e) => {
    e.addEventListener("click", () => {
      e.classList.toggle("btn-light");
      e.classList.toggle("btn-primary");
      if (cart.includes($(e).data('id'))) {
        cart.pop($(e).data('id'))
      } else {
        cart.push($(e).data('id'))
      }
      updateCartOrder();
    })
  })

  function updateCartOrder() {
    $.ajax({
      url: "/transaction/update",
      type: "post",
      data: {
        listOrder: cart
      },
      success: function(data) {
        let orders = JSON.parse(data);
        let html = "";
        let i = 1;
        let totalPay = 0;
        if (orders.length > 0) {
          console.log(orders);
          orders.forEach((order) => {
            totalPay = totalPay + parseInt(order.price);
            html += `
          <tr>
            <td>${i++}</td>
            <td>${order.start_time}-${order.end_time}</td>
            <td>${new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(order.price)}</td>
          </tr>
          `;
          })
        }
        $(".list-order").html(html);
        $(".total-pay").html(new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR"
        }).format(totalPay));
      }
    });
  }


  const btnPay = document.getElementById("btn-pay");

  btnPay.addEventListener("click", () => {
    let bookingDate = document.getElementById("choose-date").value;
    $.ajax({
      url: "/transaction/order",
      type: "post",
      data: {
        listOrder: cart,
        bookingDate: bookingDate
      },
      success: function(data) {
        console.log(data);
        $("#btn-snap").data("snaptoken", data);
        // $("#btn-snap").click();
      }
    })
  });


  function changeResult(type, data) {
    $("#result-type").val(type);
    $("#result-data").val(data);
  }

  $("#btn-snap").click(() => {
    let snapToken = $("#btn-snap").data('snaptoken')
    // snap Logic
    snap.pay(snapToken, {
      // Optional
      onSuccess: function(result) {
        console.log(result);
        changeResult('success', result);
        $("#payment-form").submit();
      },
      onPending: function(result) {
        console.log(result);
        changeResult('pending', result);
        $("#payment-form").submit();
      },
      onError: function(result) {
        console.log(result);
        changeResult('error', result);
        $("#payment-form").submit();
      }

    });

  });
</script>
<?= $this->endSection(); ?>