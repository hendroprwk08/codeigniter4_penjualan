<!doctype html>
<html>
<head>
        <title><?= $title; ?></title>
</head>
<body style='margin: 0px; padding:0px'>
    <div style='display:block; background:#fafafa; padding:10px; margin-bottom:20px;'>
        <b>Menu</b>&nbsp;&nbsp;
        <?= anchor('supplier', 'Supplier'); ?>&nbsp;&nbsp;
        <?= anchor('barang', 'Barang'); ?>&nbsp;&nbsp;
        <?= anchor('customer', 'Customer'); ?>&nbsp;&nbsp;
        <?= anchor('jual', 'Penjualan'); ?>
    </div>
