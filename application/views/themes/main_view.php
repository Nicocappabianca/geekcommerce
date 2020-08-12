<!DOCTYPE html>
<html lang="es">
    <head>
        <title>GeekCommerce<?=(!empty($custom_title) ? ' | ' . $custom_title : '')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
        <link type="text/css" href="<?= base_url('assets/css/style.css')?>" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link rel="icon" href="<?= base_url('assets/img/favicon.png');?>">

        <script src="<?= base_url('assets/js/jquery.js')?>"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/eb380d84c9.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php if (!empty($header)) echo $header; ?>
        <main>
            <?php if (!empty($section)) echo $section; ?>
        </main>
        <?php if (!empty($footer)) echo $footer; ?>
    </body>

</html>