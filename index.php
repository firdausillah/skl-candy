<?php
session_start();
require("config/database.php");
require("config/function.php");
require("config/functions.crud.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>SKL - <?= $setting['nama_sekolah'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="assets/front/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/bootstrap/assets/front/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/countdowntime/flipclock.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/front/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/front/css/main.css">
	<link rel="stylesheet" href="assets/front/vendor/izitoast/css/iziToast.min.css">
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/hover/css/hover.css">
	<!--===============================================================================================-->
</head>

<body>
	<?php
	$akhir  = new DateTime($setting['tgl_pengumuman']); //Waktu awal
	$awal = new DateTime(); // Waktu sekarang atau akhir
	$diff  = $awal->diff($akhir);

	?>

	<div class="bg-img1 size1 overlay1 p-t-24" style="background-image: url('<?= $setting['banner'] ?>');">
		<div class="flex-w flex-sb-m p-l-80 p-r-74 p-b-50 respon5">
			<div class="wrappic1 m-r-30 m-t-10 m-b-10">
				<a href="#"><img src="<?= $setting['logo'] ?>" alt="LOGO" width="50"></a>
			</div>

			<div class="flex-w m-t-10 m-b-10">
				<?php if (isset($_SESSION['id_siswaskl'])) { ?>
					<div class="animated flipInX hvr-pulse">

						<a href="logout.php" style="font-size: 25px;color:white" class=" flex-c-m  trans-04 m-l-6 m-r-6">
							<img src="assets/back/img/admin-avatar.png" alt="LOGO" width="50">
							<span class="m-l-5">Keluar</span>
						</a>
					</div>
				<?php } else { ?>
					<a href="#" class="size3 flex-c-m how-social trans-04 m-r-6">
						<i class="fa fa-facebook"></i>
					</a>

					<a href="#" class="size3 flex-c-m how-social trans-04 m-r-6">
						<i class="fa fa-twitter"></i>
					</a>

				<?php } ?>
			</div>
		</div>
		<?php if (!isset($_SESSION['id_siswaskl'])) { ?>
			<div class="flex-w flex-sa p-r-200 respon1">
				<div class="animated bounceInLeft p-t-34 p-b-60 respon3">
					<p class="l1-txt1 p-b-10 respon2">
						Pengumuman Kelulusan
					</p>
					<?php if ($akhir <= $awal) { ?>
						<h3 class="l1-txt2 p-b-45 respon2 respon4">
							Sudah Dibuka
						</h3>
					<?php } else { ?>
						<h3 class="l1-txt2 p-b-45 respon2 respon4">
							DiBuka Dalam
						</h3>

						<div class="cd100"></div>
					<?php } ?>


				</div>
				<?php if ($akhir <= $awal) { ?>
					<div class="animated bounceInRight bg0 wsize1 bor1 p-l-45 p-r-45 p-t-50 p-b-18 p-lr-15-sm">
						<h3 class="l1-txt3 txt-center p-b-43">
							Login Siswa
						</h3>

						<form id="form-login" class="w-full validate-form">

							<div class="wrap-input100 validate-input m-b-10" data-validate="Name is required">
								<input class="input100 placeholder0 s1-txt1" type="text" name="username" placeholder="Masukan NIS">
								<span class="focus-input100"></span>
							</div>
							<?php if ($setting['login'] == 2) { ?>
								<div class="wrap-input100 validate-input m-b-20" data-validate="Password is required">
									<input class="input100 placeholder0 s1-txt1" type="text" name="password" placeholder="Password">
									<span class="focus-input100"></span>
								</div>
							<?php  } ?>

							<button class="flex-c-m size2 s1-txt2 how-btn1 trans-04">
								Masuk
							</button>
						</form>

						<p class="s1-txt3 txt-center p-l-15 p-r-15 p-t-25">
							Login menggunakan Username dan Password yang diberikan sekolah
						</p>
					</div>
				<?php } ?>
			</div>
		<?php } else { ?>
			<?php $siswa = fetch($koneksi, 'siswa', ['id' => $_SESSION['id_siswaskl']]) ?>
			<div class="flex-w flex-sa p-r-200 respon1">
				<div class="p-t-34 p-b-60 respon3">

					<span style="font-size:40px" class="hvr-grow animated bounceInLeft l1-txt2 p-b-45 respon2 respon4">
						Hai, <?= $siswa['nama'] ?>
					</span>

					<p id='pbuka' class="animated flipInX l1-txt1 p-b-10 respon2">
						Silahkan buka Amplopnya ...
					</p>
					<p id="plulus" class="animated flipInX l1-txt1 p-b-10 respon2">
						<?php if ($siswa['keterangan'] == 1) {
							echo "KAMU LULUS ANAK KU";
						} elseif ($siswa['keterangan'] == 2) {
							echo "LULUS BERSYARAT HUBUNGI WALI KELAS";
						} else {
							echo "MAAF KAMU TIDAK LULUS";
						}
						?>
					</p>
					<p class="animated flipInX p-b-10 respon2">
						<b>Teruslah belajar, berkarya, dan jadilah pribadi penebar manfaat.</b>
					</p>
					<button id="pengumuman" style="background:firebrick ;height:50px" class="hvr-grow flex-c-m s1-txt2 how-btn1 m-t-30 trans-04">
						Pengumuman
					</button>
					<?php if ($siswa['skl'] == 1) { ?>
						<a target="_blank" href="print_skl.php?id=<?= enkripsi($siswa['id']) ?>" id="print"><button style="background: blue;height:50px" class="hvr-grow flex-c-m s1-txt2 how-btn1 m-t-30 trans-04">
								Print SKL
							</button></a>
					<?php } ?>

				</div>
				<div id="formpengumuman" class="animated fadeInRight bg0 wsize1 bor1 p-l-45 p-r-45 p-t-50 p-b-18 p-lr-15-sm">
					<h3 class="l1-txt3 txt-center p-b-30">
						INFORMASI
					</h3>
					<?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman");
					while ($pengumuman = mysqli_fetch_array($query)) { ?>
						<span class="s1-txt3 txt-center p-l-15 p-r-15 p-t-25">
							<?= $pengumuman['tgl'] ?>
						</span>
						<span class="s1-txt3 txt-center p-l-15 p-r-15 p-t-25">
							<?= $pengumuman['pengumuman'] ?>
						</span>
						<hr>
						<br>
					<?php } ?>
				</div>
				<div id="formamplop">
					<div class="animated tada  p-l-45 p-r-45 p-t-50 p-b-10 p-lr-15-sm">
						<div class="loader"><img src="assets/back/img/loading.gif"></div>
						<?php if ($akhir <= $awal) { ?>
							<a id="amploptutup" class="animated tada hvr-pulse" href="#">
								<img src="assets/back/img/amploptutup.png" alt="LOGO" style="width:100%;max-width:400px;" />
							</a>
							<a id="amplopbuka" class="animated tada p-b-10" href="#">
								<img src="assets/back/img/amplopbuka.png" alt="LOGO" style="width:100%;max-width:400px;" />
							</a>
						<?php } else { ?>

							<div class="cd100"></div>
						<?php } ?>
					</div>
					<span id="keterangan" class="keter  animated tada ">
						<?php if ($siswa['keterangan'] == 1) {
							echo "LULUS";
						} elseif ($siswa['keterangan'] == 2) {
							echo "PANGGILAN";
						} else {
							echo "TIDAK LULUS";
						}
						?>
					</span>
				</div>

			</div>
		<?php } ?>

	</div>





	<!--===============================================================================================-->
	<script src="assets/front/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/front/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/front/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/front/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/front/vendor/countdowntime/flipclock.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="assets/front/vendor/countdowntime/countdowntime.js"></script>
	<script src="assets/front/vendor/izitoast/js/iziToast.min.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeMonth: <?= $diff->m ?>,
			endtimeDate: <?= $diff->d ?>,
			endtimeHours: <?= $diff->h ?>,
			endtimeMinutes: <?= $diff->i ?>,
			endtimeSeconds: <?= $diff->s ?>,
			timeZone: ""
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
	<!--===============================================================================================-->

	<!--===============================================================================================-->
	<script src="assets/front/js/main.js"></script>
	<script>
		$('#form-login').submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'ceklogin.php?pg=login',
				data: $(this).serialize(),

				success: function(data) {
					var json = $.parseJSON(data);
					if (json.pesan == 'ok') {
						iziToast.success({
							title: 'Mantap!',
							message: 'Login Berhasil',
							position: 'topRight'
						});
						setTimeout(function() {
							window.location.href = "user";
						}, 2000);

					} else {
						iziToast.error({
							title: 'Maaf!',
							message: json.pesan,
							position: 'topCenter'
						});
					}

				}
			});
			return false;
		});
		<?php if (isset($_SESSION['id_siswaskl'])) { ?>
			$("#amploptutup").click(function(e) {
				e.preventDefault();
				$(this).hide();
				$(".loader").show();
				var id = '<?= $_SESSION['id_siswaskl'] ?>';
				$.ajax({
					type: 'POST',
					url: 'ceklogin.php?pg=bukaamplop',
					data: 'id=' + id,
					success: function(data) {

						setTimeout(function() {
							$(".loader").hide();
							$('#amplopbuka').show();
							$("#keterangan").show();
							$("#print").show();
							$("#pbuka").hide();
							$("#plulus").show();
						}, 3000);
					}
				});
			});
			$(".loader").hide();
			$("#plulus").hide();
			$("#amplopbuka").hide();
			$("#keterangan").hide();
			$("#print").hide();
			$("#formpengumuman").hide();
			$("#pengumuman").click(function(e) {
				e.preventDefault();
				$("#formamplop").hide();
				$("#formpengumuman").show();
			});
		<?php } ?>
	</script>

</body>

</html>