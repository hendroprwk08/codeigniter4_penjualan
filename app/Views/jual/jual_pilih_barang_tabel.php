<?php if ( ! empty( $data ) && is_array( $data ) ) : ?>

    <table border="1" width="100%" style="border-collapse: collapse">
        <tr>
            <td>#</td>
            <td>Nama</td>
            <td>Harga</td>
            <td>&nbsp;</td>
        </tr>

        <?php foreach ( $data as $row ): ?>

            <tr>
                <td><?= $row['idbarang'] ?></td>
                <td><?= $row['namabarang'] ?></td>
                <td><?= $row['hargajual'] ?></td>

                <td><a href='' onclick = 'return select_item( "<?= $row['idbarang'] ?>", "<?= $row['namabarang'] ?>", "<?= $row['hargajual'] ?>" )'>Pilih</a></td>
            </tr>

         <?php endforeach; ?>

    </table>

    <script>
    function select_item( id, nama, harga )
    {
        window.opener.document.getElementsByName('id')[0].value = id;
        window.opener.document.getElementsByName('nama')[0].value = nama;
        window.opener.document.getElementsByName('harga')[0].value = harga;
        window.opener.hitung();
        top.close();
        return false;
    }
    </script>

<?php else : ?>

    <p>Sayang sekali, data barang masih kosong.</p>

<?php endif ?>
