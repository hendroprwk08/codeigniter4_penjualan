<?php
echo form_open( '../barang/simpan' );

echo 'ID: '. form_input( array( 'name' => 'id', 
                                'maxlength' => '3') ) .'</br>';

echo 'Nama: '. form_input('nama') .'</br>';
echo 'Harga Beli: '. form_input('beli') .'</br>';
echo 'Harga Jual: '. form_input('jual') .'</br>';
echo 'Stok: '. form_input('stok') .'</br>';

//persiapan dropdown
foreach ($supplier as $row):
    $option[ $row['idsupplier'] ] = $row['namasupplier'];
endforeach;

echo 'Supplier: '. form_dropdown('idsupplier', $option) .'</br>';

echo 'Expired: '. form_input('expired', date('Y-m-d')) .'</br>';
echo form_submit('simpan', 'Simpan data');
echo form_reset('reset', 'Ulangi');
echo form_close();
?>