<!doctype html>
<html>
<head>
        <title><?= $title; ?></title>
        <style type="text/css">
            .pagination
            {
                margin-left: -30px;
            }
            
            .pagination li 
            {
                display: inline-block;
                text-decoration: none;
            }
            
            .pagination li a
            {
                text-decoration: none;
                color: #404042;
                padding: 3px 5px;
                border: 1px solid #404042;
            }
            
            .pagination li a:hover
            {
                font-weight: bold;
            }
            
            .pagination .active a
            {
                text-decoration: none;
                color: #fff;
                background: #404042; 
            }
        </style>
</head>
<body style='margin: 0px; padding:0px'>
    <div style='display:block; background:#fafafa; padding:10px; margin-bottom:20px;'>
        <b>Menu</b>&nbsp;&nbsp;
        <?= anchor('../supplier', 'Supplier'); ?>&nbsp;&nbsp;
        <?= anchor('../barang', 'Barang ( +Pencarian )'); ?>&nbsp;&nbsp;
        <?= anchor('../customer', 'Customer'); ?>&nbsp;&nbsp;
        <?= anchor('../jual', 'Penjualan'); ?>
    </div>
