<script>
function hitung()
{
    var q = document.getElementsByName('qty')[0].value;
    var h = document.getElementsByName('harga')[0].value;
    var d = document.getElementsByName('diskon')[0].value; 
    var hasil = ( h - d ) * q;
    
    document.getElementsByName('jumlah')[0].value = hasil;
}
</script>

<?php
print_r ($session);

echo form_open('../jual/set_header');

echo 'Faktur: '. form_input( array( 'name'      => 'faktur', 
                                    'maxlength' => '10',
                                    'value'     => $faktur,
                                    'readonly'  => 'readonly',
                                    'style'     => 'background:#FFFFF0')) .'</br>';

$tanggal = isset( $session['tanggal'] ) ? $session[ 'tanggal' ] : date('Y-m-d');
echo 'Tanggal: '. form_input('tanggal', $tanggal) .'</br>';

dw

//persiapan dropdown
foreach ($customer as $row):
    $option[ $row['idcustomer'] ] = $row['namacustomer'];
endforeach;

$customer = isset( $session[ 'idcustomer' ] ) ? $session[ 'idcustomer' ] : null;
echo 'Customer: '. form_dropdown('idcustomer', $option, $customer) .'</br>';

echo form_submit('submit', 'Set Faktur');

echo  form_close();

X`
?>

<table border="1" style="border-collapse: collapse">
<tr>
    <td>ID</td>
    <td>Nama Barang</td>
    <td>Harga</td>
    <td>Qty</td>
    <td>Diskon</td>
    <td>Jumlah</td>
    <td>&nbsp;</td>
</tr> 

<?= form_open('../jual/pilih_barang'); ?>

<tr>
    <td><?= form_input( array( 'name' => 'id' , 'size' => '2', 'readonly'  => 'readonly', 'style' => 'background:#FFFFF0' ) ) ?></td>
    <td><?= form_input( array( 'name' => 'nama' , 'size' => '20', 'readonly'  => 'readonly', 'style' => 'background:#FFFFF0' ) ) ?></td>
    <td><?= form_input( array( 'name' => 'harga' , 'size' => '5', 'readonly'  => 'readonly', 'style' => 'background:#FFFFF0' ) ) ?></td>
    <td><?= form_input( array( 'name' => 'qty' , 'value' => '1', 'size' => '2', 'onkeyup' => 'hitung()' ) ) ?></td>
    <td><?= form_input( array( 'name' => 'diskon' , 'value' => '0', 'size' => '5', 'onkeyup' => 'hitung()' ) ) ?></td>
    <td><?= form_input( array( 'name' => 'jumlah' , 'value' => '0', 'size' => '5', 'readonly'  => 'readonly', 'style' => 'background:#FFFFF0' ) ) ?></td>
    <td><?= form_submit('submit', 'Pilih') ?></td>
</tr>

<?= form_close(); ?>

<?php 
$total = 0;

if ( isset ( $cart ) ): 
    foreach( $cart as $row ):
    
        echo form_open( '../jual/ubah_barang');
        echo form_hidden( [ 'rowid'       => $row[ 'rowid' ], 
                            'id'          => $row[ 'id' ],
                            'namabarang'  => $row[ 'name' ],
                            'hargabarang' => $row[ 'price' ] ]);
        
        $subtotal = ($row[ 'price' ] - $row[ 'options' ][ 'diskon' ] ) * $row[ 'qty' ];
        $total += $subtotal;
?>

</tr>
    <td><?= $row[ 'id' ]; ?></td>
    <td><?= $row[ 'name' ]; ?></td>
    <td align="right"><?= number_format( $row[ 'price' ] ); ?></td>
    <td align="right"><?= form_input( array( 'name' => 'qtybarang' , 'value' => $row[ 'qty' ], 'size' => '2', 'align' => 'right', 'onkeyup' => 'hitung()' ) ); ?></td>
    <td align="right"><?= form_input( array( 'name' => 'diskonbarang', 'value' => $row[ 'options' ][ 'diskon' ], 'size' => '5', 'align' => 'right', 'onkeyup' => 'hitung()' ) ); ?></td>
    <td align="right"><?= number_format( $subtotal ); ?></td>
    <td><?= form_submit('submit', 'Ubah') ?></td>
</tr>
    
<?php
        echo form_close();
    endforeach;
endif;    
?>
        <tr><td colspan='5'>&nbsp;</td><td><?= number_format( $total ) ?></td><td>&nbsp;</td></tr>
</table>

<?= '<p>'. anchor( 'jual/simpan', 'Simpan') .'</p>'; ?>
