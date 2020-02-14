<?php
if ( ! empty( $barang ) && is_array( $barang ) ) :

    //menampilkan error hasil validasi form
    echo form_open('../barang/perbarui');
    
    echo 'ID: '. form_input( array( 'name'      => 'id',
                                    'maxlength' => '3',
                                    'value'     => $barang[0]['idbarang'],
                                    'readonly'  => 'readonly')) .'</br>';
    
    echo 'Nama: '. form_input('nama', $barang[0]['namabarang']) .'</br>';
    echo 'Harga Beli: '. form_input('beli', $barang[0]['hargabeli']) .'</br>';
    echo 'Harga Jual: '. form_input('jual', $barang[0]['hargajual']) .'</br>';
    echo 'Stok: '. form_input('stok', $barang[0]['stok']) .'</br>';
    
    //persiapan dropdown
    foreach ($supplier as $row):
        $option[ $row['idsupplier'] ] = $row['namasupplier'];
    endforeach;
    
    echo 'Supplier: '. form_dropdown('idsupplier', $option, $barang[0]['idsupplier']) .'</br>';
    
    echo 'Expired: '. form_input('expired', substr( $barang[0]['expired'], 0, 10 ) ) .'</br>';
    echo form_submit( 'perbarui', 'Perbarui data' );
    echo form_close();

else :

    echo 'Data terpilih sepertinya salah';

endif
?>