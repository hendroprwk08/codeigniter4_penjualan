<?php
echo anchor( '../customer/form', 'Tambah' );

if ( ! empty( $data ) && is_array( $data ) ) :
?>

    <table border="1" style="border-collapse: collapse">
        <tr>
            <td>#</td>
            <td>Nama</td>
            <td>Telepon</td>
            <td>&nbsp;</td>
        </tr>

    <?php foreach ( $data as $row ): ?>
        <tr>
            <td><?= $row[ 'idcustomer' ] ?></td>
            <td><?= $row[ 'namacustomer' ] ?></td>
            <td><?= $row[ 'telpcustomer' ] ?></td>
                <td>
                    <?= anchor( '../customer/ubah/'. $row[ 'idcustomer' ], 'Ubah' ) ?>
                    <?= anchor( '../customer/hapus/'. $row[ 'idcustomer' ], 'Hapus', array( 'onClick' => 'return confirm("Hapus data?")' ) ) ?>
                </td>
        </tr>

    <?php endforeach; ?>

    </table>

<?php else : ?>

    <p>Sayang sekali, data barang masih kosong.</p>

<?php endif; ?>
