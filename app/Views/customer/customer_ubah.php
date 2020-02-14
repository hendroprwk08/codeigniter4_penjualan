<?php
if ( ! empty( $data ) && is_array( $data ) ) :

    echo form_open('../customer/perbarui');

    echo 'ID: '. form_input( array( 'name'      => 'id',
                                    'maxlength' => '3',
                                    'value'     => $data[0]['idcustomer'])) .'</br>';

    echo 'Nama: '. form_input('nama', $data[0]['namacustomer']) .'</br>';
    echo 'Telepon: '. form_input('telp', $data[0]['telpcustomer']) .'</br>';
    echo form_submit( 'perbarui', 'Perbarui data' );
    echo form_close();

else :

    echo 'Data terpilih sepertinya salah';

endif
?>
