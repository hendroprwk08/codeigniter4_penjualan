<?php 
echo anchor( 'barang/form', 'Tambah' );

if ( ! empty( $barang ) && is_array( $barang ) ) : 
?>

	<table border="1">
		<tr>
		<td>#</td>
		<td>Nama</td>
		<td>Harga</td>
		<td>Stok</td>
		<td>Supplier</td>
		<td>Expired</td>
		<td>&nbsp;</td>
		</tr>
		
    <?php foreach ( $barang as $row ): ?>
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