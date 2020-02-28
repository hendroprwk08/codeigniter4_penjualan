<?php
if ( ! empty( $data ) && is_array( $data ) ) :

    //menampilkan error hasil validasi form
    echo form_open('../barang/perbarui');
    
    echo 'ID: '. form_input( array( 'name'      => 'id',
                                    'maxlength' => '5',
                                    'value'     => $data[0]['idbarang'],
                                    'readonly'  => 'readonly')) .'</br>';
    
    echo 'Nama: '. form_input('nama', $data[0]['namabarang']) .'</br>';
    echo 'Harga Beli: '. form_input('beli', $data[0]['hargabeli']) .'</br>';
    echo 'Harga Jual: '. form_input('jual', $data[0]['hargajual']) .'</br>';
    echo 'Stok: '. form_input('stok', $data[0]['stok']) .'</br>';
    
    //persiapan dropdown
    foreach ($supplier as $row):
        $option[ $row['idsupplier'] ] = $row['namasupplier'];
    endforeach;
    
    echo 'Supplier: '. form_dropdown('idsupplier', $option, $data[0]['idsupplier']) .'</br>';
    
    echo 'Expired: '. form_input('expired', substr( $data[0]['expired'], 0, 10 ) ) .'</br>';
    echo form_submit( 'perbarui', 'Perbarui data' );
    echo form_close();

else :

    echo 'Data terpilih sepertinya salah';

endif
?>