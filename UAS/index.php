<?php
include 'koneksi.php';

$menu = @$_GET['menu'];
if (!$menu) {
	echo "<script>window.location.href='?menu=input_stock'</script>";
}
?>
<html>
<head>
	<title>UAS</title>
	<style>
		.text-center {
			text-align: center;
		}
		.text-right {
			text-align: right;
		}
		.d-flex {
			display: flex;
		}
	</style>
</head>
<body>
	<div class="header">
		<h1>DATA LOGISTIK LEMBAR KERJA SISWA (LKS)</h1>
		<div>Programmer : Reinandy Fediyanto</div>
		<br>
		<div>
			<?php if ($menu == 'input_stock'): ?>
				<span>Input Stock</span>
			<?php else: ?>
				<a href="?menu=input_stock">Input Stock</a>
			<?php endif ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if ($menu == 'distribusi'): ?>
				<span>Distibusi</span>
			<?php else: ?>
				<a href="?menu=distribusi">Distibusi</a>
			<?php endif ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if ($menu == 'stock'): ?>
				<span>Check Stock</span>
			<?php else: ?>
				<a href="?menu=stock">Check Stock</a>
			<?php endif ?>
		</div>
	</div>
	<div class="body">
		<?php
			include $menu.'.php';
		?>
	</div>
</body>
</html>