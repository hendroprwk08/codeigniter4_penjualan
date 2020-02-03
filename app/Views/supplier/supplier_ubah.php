<?php
if (! empty( $supplier ) && is_array( $supplier ) ) :

    echo form_open( 'supplier/perbarui' );

    $data_id = array(
        'name' => 'id',
        'value' => $supplier[0]['idsupplier'],
        'readonly' => 'readonly'
    );
    
    echo 'ID: '.form_input( $data_id ).'</br>';
    echo 'Nama: '.form_input( 'nama', $supplier[0]['namasupplier'] ).'</br>';
    echo 'Aamat: '.form_input( 'alamat', $supplier[0]['alamatsupplier'] ).'</br>';
    echo 'Telepon: '.form_input( 'telepon', $supplier[0]['telpsupplier'] ).'</br>';
    echo 'Email: '.form_input( 'email', $supplier[0]['emailsupplier'] ).'</br>';
    echo 'PIC: '.form_input( 'pic', $supplier[0]['picsupplier'] ).'</br>';
    echo form_submit( 'perbarui', 'Perbarui data' );
    echo form_close();

else : 

    echo 'Data terpilih sepertinya salah';

endif
?>