<!DOCTYPE html>
<html lang="en">

<head>
  <title>SKL - <?= $setting['nama_sekolah'] ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="../assets/front/images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/vendor/bootstrap/../assets/front/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/vendor/countdowntime/flipclock.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/front/css/util.css">
  <link rel="stylesheet" type="text/css" href="../assets/front/css/main.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="../assets/front/vendor/izitoast/css/iziToast.min.css">
</head>

<body>


  <div class="bg-img1 size1 overlay1 p-t-24" style="background-image: url('../<?= $setting['banner'] ?>');">
    <div class="flex-w flex-sb-m p-l-80 p-r-74 p-b-50 respon5">
      <div class="wrappic1 m-r-30 m-t-10 m-b-10">
        <a href="#"><img src="../<?= $setting['logo'] ?>" width="50" alt="LOGO"></a>
      </div>

      <div class="flex-w m-t-10 m-b-10">
        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-6">
          <i class="fa fa-facebook"></i>
        </a>

        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-6">
          <i class="fa fa-twitter"></i>
        </a>

        <a href="#" class="size3 flex-c-m how-social trans-04 m-r-6">
          <i class="fa fa-youtube-play"></i>
        </a>
      </div>
    </div>

    <div class="flex-w flex-sa p-r-200 respon1">

      <div class="bg0 wsize1 bor1 p-l-45 p-r-45 p-t-50 p-b-18 p-lr-15-sm">
        <h3 class="l1-txt3 txt-center p-b-43">
          Admin Login
        </h3>

        <form id="form-login" class="w-full validate-form">

          <div class="wrap-input100 validate-input m-b-10" data-validate="Name is required">
            <input class="input100 placeholder0 s1-txt1" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-20" data-validate="Password is required">
            <input class="input100 placeholder0 s1-txt1" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>

          <button type="submit" class="flex-c-m size2 s1-txt2 how-btn1 trans-04">
            Masuk
          </button>
        </form>

        <p class="s1-txt3 txt-center p-l-15 p-r-15 p-t-25">
          CopyRight @ 2020 Candy-SKL
        </p>
      </div>
    </div>
  </div>





  <!--===============================================================================================-->
  <script src="../assets/front/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="../assets/front/vendor/bootstrap/js/popper.js"></script>
  <script src="../assets/front/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="../assets/front/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="../assets/front/vendor/countdowntime/flipclock.min.js"></script>
  <script src="../assets/front/vendor/countdowntime/moment.min.js"></script>
  <script src="../assets/front/vendor/countdowntime/moment-timezone.min.js"></script>
  <script src="../assets/front/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
  <script src="../assets/front/vendor/countdowntime/countdowntime.js"></script>

  <!--===============================================================================================-->
  <script src="../assets/front/vendor/tilt/tilt.jquery.min.js"></script>
  <script src="../assets/front/vendor/izitoast/js/iziToast.min.js"></script>
  <!--===============================================================================================-->
  <script src="../assets/front/js/main.js"></script>
  <script>
    $('#form-login').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'login_cek.php?id=5448dfhcr27467576c78a50vi98j0ruv0w',
        data: $(this).serialize(),
        success: function(data) {
          if (data == "ok") {
            iziToast.success({
              title: 'Berhasil!',
              message: 'Anda akan dialihkan',
              position: 'topRight'
            });
            setTimeout(function() {
              window.location.reload();
            }, 2000);
          } else {
            iziToast.error({
              title: 'Maaf Bro',
              message: 'Username atau Password Salah',
              position: 'topCenter'
            });
          }
        }
      });
      return false;
    });
  </script>
</body>

</html>