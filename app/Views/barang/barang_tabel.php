<?php
echo anchor( 'barang/form', 'Tambah' );

if ( ! empty( $data ) && is_array( $data ) ) :
?>

	<table border="1" style="border-collapse: collapse">
		<tr>
		<td>#</td>
		<td>Nama</td>
		<td>Harga</td>
		<td>Stok</td>
		<td>Supplier</td>
		<td>Expired</td>
		<td>&nbsp;</td>
		</tr>

    <?php foreach ( $data as $row ): ?>
		 <tr>
    		<td><?= $row['idbarang'] ?></td>
    		<td><?= $row['namabarang'] ?></td>
    		<td>
    			Beli: <?= $row['hargabeli'] ?>
    			Jual: <?= $row['hargajual'] ?>
			</td>
    		<td><?= $row['stok'] ?></td>
    		<td>
    			<?= $row['idsupplier'] ?> -
    			<?= $row['namasupplier'] ?>
			</td>
    		<td><?= $row['expired'] ?></td>
			<td>
				<?= anchor( 'barang/ubah/'. $row['idbarang'], 'Ubah' ) ?>
				<?= anchor( 'barang/hapus/'. $row['idbarang'], 'Hapus', array( 'onClick' => 'return confirm("Hapus data?")' ) ) ?>
			</td>
         </tr>

	<?php endforeach; ?>

	</table>

<?php else : ?>

	<p>Sayang sekali, data barang masih kosong.</p>

<?php endif ?>
