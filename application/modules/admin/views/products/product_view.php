<div class="container pb-4 pl-4">
    <div class="row">
    <div class="col-12 col-md-6">
    <div class="img-product">
        <?php if(empty($products->img)): ?>
            <img src="<?= base_url('assets/img/no_img.jpg')?>" width="200" height="200" alt="<?= $products->title; ?>>
        <?php else: ?>
            <img class="img-fluid" src="<?= thumb($products->img, 300, 250, 2, NULL);?>" alt="<?= $products->title; ?>">
        <?php endif; ?>
    </div>
    </div>
    <div class="col-12 col-md-6">
    <h2 class="pb-3"><?= $products->title ?></h2>
    <p><?= $products->description ?></p>
    <p>Stock: <?= $products->stock ?></p>
    <?php if($products->visible): ?>
        <p>Estado: Visible</p>
    <?php else: ?>
        <p>Estado: No Visible</p>
    <?php endif; ?>
    <p class="py-3"><a href="<?= base_url('admin/products'); ?>"> Volver al listado </a></p>
    </div>
    </div><!-- .row -->
</div>

