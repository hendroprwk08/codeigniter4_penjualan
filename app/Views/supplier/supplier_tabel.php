<?php 
echo anchor( 'supplier/form', 'Tambah' );

if ( ! empty( $supplier ) && is_array( $supplier ) ) : 
?>

	<table border="1">
		<tr>
		<td>Nama</td>
		<td>Alamat</td>
		<td>Telepon</td>
		<td>Email</td>
		<td>PIC</td>
		<td>&nbsp;</td>
		</tr>

    <?php foreach ( $supplier as $row ): ?>
		 <tr>
    		<td><?= $row['namasupplier'] ?></td>
    		<td><?= $row['alamatsupplier'] ?></td>
    		<td><?= $row['telpsupplier'] ?></td>
    		<td><?= $row['emailsupplier'] ?></td>
    		<td><?= $row['picsupplier'] ?></td>
			<td>
				<?= anchor( 'supplier/ubah/'. $row['idsupplier'], 'Ubah' ) ?>
				<?= anchor( 'supplier/hapus/'. $row['idsupplier'], 'Hapus', array( 'onClick' => 'return confirm("Hapus data?")' ) ) ?>
			</td>			
         </tr>
    
	<?php endforeach; ?>

	</table>
			
<?php else : ?>

	<p>Sayang sekali, data supplier masih kosong.</p>

<?php endif ?>