<?php
if (isset($_POST['save'])) {
	if (!isset($_GET['id'])) {
		$save = mysqli_query($con, "INSERT INTO stocks VALUES (null, '$_POST[kelas]', '-$_POST[jumlah]', 0, 0, '$_POST[sekolah]')");
	} else {
		$save = mysqli_query($con, "UPDATE stocks SET kelas = '$_POST[kelas]', jumlah = '-$_POST[jumlah]', sekolah = '$_POST[sekolah]' WHERE id = '$_GET[id]'");
	}

	if ($save) {
		echo "<script>alert('Berhasil menyimpan data');window.location.href='?menu=distribusi'</script>";
	} else {
		echo "<script>alert('Gagal menyimpan data')</script>";
	}
}

if (isset($_GET['id'])) {
	if (isset($_GET['delete'])) {
		$delete = mysqli_query($con, "DELETE FROM stocks WHERE id = '$_GET[id]'");
		if ($delete) {
			echo "<script>alert('Berhasil menghapus data');window.location.href='?menu=distribusi'</script>";
		} else {
			echo "<script>alert('Gagal menghapus data')</script>";
		}
	}

	$record = mysqli_query($con, "SELECT * FROM stocks WHERE id = '$_GET[id]'");
	$edit = mysqli_fetch_assoc($record);
}

$record = mysqli_query($con, "SELECT * FROM stocks WHERE _type = 0");
?>
<!-- Form -->
<h3>Distribusi LKS</h3>
<form method="POST">
	<table width="100%">
		<tr>
			<td width="20%">Nama Sekolah</td>
			<td>
				<input type="text" name="sekolah" required value="<?= @$edit['sekolah'] ?>">
			</td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td>
				<?php for ($i = 1; $i <= 6; $i++) : ?>
					<?php if (@$edit): ?>
						<?php if ($edit['kelas'] == $i): ?>
							<label for="kelas-<?= $i ?>"><?= $i ?></label><input type="radio" name="kelas" value="<?= $i ?>" required id="kelas-<?= $i ?>" checked>
						<?php else: ?>
							<label for="kelas-<?= $i ?>"><?= $i ?></label><input type="radio" name="kelas" value="<?= $i ?>" required id="kelas-<?= $i ?>">
						<?php endif ?>
					<?php else: ?>
						<label for="kelas-<?= $i ?>"><?= $i ?></label><input type="radio" name="kelas" value="<?= $i ?>" required id="kelas-<?= $i ?>">
					<?php endif ?>
				<?php endfor ?>
			</td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>
				<input type="number" name="jumlah" required value="<?= @$edit['jumlah'] ? abs(@$edit['jumlah']) : '' ?>">
			</td>
		</tr>
		<tr>
			<td>
				<button name="save" value="true">Submit</button>
			</td>
		</tr>
	</table>
</form>
<!-- Data -->
<h3>Data Distribusi</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th width="1%">No.</th>
			<th width="25%">Nama Sekolah</th>
			<th width="25%">Kelas</th>
			<th width="25%">Jumlah</th>
			<th width="1%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
		?>
		<?php while ($row = mysqli_fetch_assoc($record)) : ?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td><?= $row['sekolah'] ?></td>
				<td class="text-center"><?= $row['kelas'] ?></td>
				<td class="text-right"><?= abs($row['jumlah']) ?></td>
				<td class="d-flex">
					<a href="?menu=distribusi&id=<?= $row['id'] ?>">Edit</a>
					&nbsp;
					<a href="?menu=distribusi&id=<?= $row['id'] ?>&delete=true" onclick="return confirm('Yakin ingin menghapus data No. <?= $no - 1 ?>?')">Hapus</a>
				</td>
			</tr>
		<?php endwhile ?>
	</tbody>
</table>