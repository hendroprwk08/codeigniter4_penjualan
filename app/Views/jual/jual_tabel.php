<?php
echo anchor( 'jual/form', 'Tambah' );

if ( ! empty( $data ) && is_array( $data ) ) :
?>

	<table border="1" style="border-collapse: collapse">
		<tr>
		<td>Faktur</td>
		<td>Tanggal</td>
		<td>Customer</td>
		<td>Total</td>
		<td>&nbsp;</td>
		</tr>

    <?php foreach ( $data as $row ): ?>
		 <tr>
    		<td><?= $row['faktur'] ?></td>
    		<td><?= $row['tanggal'] ?></td>
    		<td><?= $row['idcustomer'] ?> - <?= $row['namacustomer'] ?></td>
    		<td><?= number_format( $row['total'] ) ?></td>
    		<td>
				<?= anchor( 'jual/ubah/'. $row['faktur'], 'Ubah' ) ?>
				<?= anchor( 'jual/hapus/'. $row['faktur'], 'Hapus', array( 'onClick' => 'return confirm("Hapus data?")' ) ) ?>
			</td>
         </tr>

	<?php endforeach; ?>

	</table>

<?php else : ?>

	<p>Sayang sekali, data penjualan masih kosong.</p>

<?php endif ?>
