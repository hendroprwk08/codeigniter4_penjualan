<?php
//menampilkan error hasil validasi form
echo form_open('customer/simpan');

echo 'ID: '. form_input( array( 'name' => 'id',
                                'maxlength' => '3')) .'</br>';

echo 'Nama: '. form_input('nama') .'</br>';
echo 'Telepon: '. form_input('telp') .'</br>';
echo form_submit('simpan', 'Simpan data');
echo form_reset('reset', 'Ulangi');
echo form_close();
?>
