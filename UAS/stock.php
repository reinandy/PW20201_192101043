<?php
$record = mysqli_query($con, "SELECT id, kelas, SUM(jumlah) as jumlah, harga FROM stocks GROUP BY kelas");
?>
<h3>Cek Stock</h3>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th width="1%">No.</th>
			<th width="25%">Kelas</th>
			<th width="25%">Jumlah</th>
			<th width="25%">Harga</th>
			<th width="25%">Nilai Persediaan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
		?>
		<?php while ($row = mysqli_fetch_assoc($record)) : ?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $row['kelas'] ?></td>
				<td class="text-right"><?= $row['jumlah'] ?></td>
				<td class="text-right"><?= number_format($row['harga']) ?></td>
				<td class="text-right"><?= number_format($row['jumlah'] * $row['harga']) ?></td>
			</tr>
		<?php endwhile ?>
	</tbody>
</table>