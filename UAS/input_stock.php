<?php
if (isset($_POST['save'])) {
	if (!isset($_GET['id'])) {
		$save = mysqli_query($con, "INSERT INTO stocks VALUES (null, '$_POST[kelas]', '$_POST[jumlah]', '$_POST[harga]', 1, null)");
	} else {
		$save = mysqli_query($con, "UPDATE stocks SET kelas = '$_POST[kelas]', jumlah = '$_POST[jumlah]', harga = '$_POST[harga]' WHERE id = '$_GET[id]'");
	}

	if ($save) {
		echo "<script>alert('Berhasil menyimpan data');window.location.href='?menu=input_stock'</script>";
	} else {
		echo "<script>alert('Gagal menyimpan data')</script>";
	}
}

if (isset($_GET['id'])) {
	if (isset($_GET['delete'])) {
		$delete = mysqli_query($con, "DELETE FROM stocks WHERE id = '$_GET[id]'");
		if ($delete) {
			echo "<script>alert('Berhasil menghapus data');window.location.href='?menu=input_stock'</script>";
		} else {
			echo "<script>alert('Gagal menghapus data')</script>";
		}
	}

	$record = mysqli_query($con, "SELECT * FROM stocks WHERE id = '$_GET[id]'");
	$edit = mysqli_fetch_assoc($record);
}

$record = mysqli_query($con, "SELECT * FROM stocks WHERE _type = 1");
?>
<!-- Form -->
<h3>Form Input Stock LKS</h3>
<form method="POST">
	<table width="100%">
		<tr>
			<td width="20%">Kelas</td>
			<td>
				<select name="kelas" required>
					<?php for ($i = 1; $i <= 6; $i++) : ?>
						<?php if (@$edit): ?>
							<?php if ($edit['kelas'] == $i): ?>
								<option value="<?= $i ?>" selected><?= $i ?></option>
							<?php else: ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endif ?>
						<?php else: ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php endif ?>
					<?php endfor ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>
				<input type="number" name="jumlah" required value="<?= @$edit['jumlah'] ?>">
			</td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>
				<input type="number" name="harga" required value="<?= @$edit['harga'] ?>">
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
<h3>Data Stock LKS</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th width="1%">No.</th>
			<th width="25%">Kelas</th>
			<th width="25%">Jumlah</th>
			<th width="25%">Harga</th>
			<th width="25%">Nilai Persediaan</th>
			<th width="1%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			$tlks = 0;
			$tnp = 0;
		?>
		<?php while ($row = mysqli_fetch_assoc($record)) : ?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $row['kelas'] ?></td>
				<td class="text-right"><?= $row['jumlah'] ?></td>
				<td class="text-right"><?= number_format($row['harga']) ?></td>
				<td class="text-right"><?= number_format($row['jumlah'] * $row['harga']) ?></td>
				<td class="d-flex">
					<a href="?menu=input_stock&id=<?= $row['id'] ?>">Edit</a>
					&nbsp;
					<a href="?menu=input_stock&id=<?= $row['id'] ?>&delete=true" onclick="return confirm('Yakin ingin menghapus data No. <?= $no - 1 ?>?')">Hapus</a>
				</td>
			</tr>
			<?php
				$tlks += $row['jumlah'];
				$tnp += $row['jumlah'] * $row['harga'];
			?>
		<?php endwhile ?>
	</tbody>
</table>
<table width="100%">
	<tr>
		<td width="20%">Jumlah LKS Seluruh</td>
		<td>
			<input type="text" value="<?= $tlks ?>" readonly>
		</td>
	</tr>
	<tr>
		<td>Total Nilai Persediaan</td>
		<td>
			<input type="text" value="<?= number_format($tnp) ?>" readonly>
		</td>
	</tr>
</table>