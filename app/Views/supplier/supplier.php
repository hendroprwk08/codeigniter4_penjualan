<?php
echo form_open('supplier/simpan');
echo 'ID: '.form_input('id').'</br>';
echo 'Nama: '.form_input('nama').'</br>';
echo 'ALamat: '.form_input('alamat').'</br>';
echo 'Telepon: '.form_input('telepon').'</br>';
echo 'Email: '.form_input('email').'</br>';
echo 'PIC: '.form_input('pic').'</br>';
echo form_submit('simpan', 'Simpan data');
echo form_reset('reset', 'Ulangi');
echo form_close();
?>
