<?php
include "../koneksi.php";
$data = mysqli_query($koneksi,"
SELECT p.*, ps.nama_peserta 
FROM pembayaran p
JOIN peserta ps ON p.peserta_id = ps.peserta_id
ORDER BY p.tanggal DESC
");
?>

<div class="container card">
<h2>Data Pembayaran</h2>

<table class="table-modern">
<tr>
<th>Peserta</th>
<th>Total</th>
<th>Metode</th>
<th>Bukti</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php foreach ($data as $d): ?>
<tr>
<td><?= $d['nama_peserta'] ?></td>
<td>Rp <?= number_format($d['total_bayar']) ?></td>
<td><?= $d['metode'] ?></td>
<td>
<?php if ($d['bukti_bayar']) { ?>
<a href="../uploads/bukti/<?= $d['bukti_bayar'] ?>" target="_blank">Lihat</a>
<?php } else { echo "-"; } ?>
</td>
<td><?= $d['status'] ?></td>
<td>
<a href="verif_pembayaran.php?id=<?= $d['pembayaran_id'] ?>&s=Approved">Setujui</a> |
<a href="verif_pembayaran.php?id=<?= $d['pembayaran_id'] ?>&s=Rejected" style="color:red;">Tolak</a>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
