<h2 class="title-index mb-6 pt-4">LISTA DE PRODUCTOS</h2>

<?php if($this->session->flashdata('message')): ?>
    <p id="alertMessage" class="alert alert-primary container alert-message"><?= $this->session->flashdata('message') ?></p>
<?php endif ?>

<?php if(!empty($products)): ?>
    <div class="container">
        <div class="row">
            <?php foreach ($products as $products_item): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="container-product border">
                        <?php if(empty($products_item->img)): ?>
                            <img src="<?= base_url('assets/img/no_img.jpg')?>" width="auto" height="150" alt="<?= $products_item->title; ?>">
                        <?php else: ?>
                            <img src="<?=thumb($products_item->img, 200, 150, 2, NULL);?>" alt="<?= $products_item->title; ?>">
                        <?php endif; ?>
                        <h3><?= $products_item->title; ?></h3>
                        <div class="main">
                            <h5>$<?= $products_item->price; ?></h5>
                        </div>
                        <p><a class="btn btn-info mt-3" href="<?= base_url('products/view/'.$products_item->id); ?>">Ver producto</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- .row -->
        <p class="paginate-links mt-4 mb-6"> <?= $links; ?> </p>
    </div>
    <?php else: ?>                            
        <div class="container text-center mb-10">
            <p class="pb-3">La lista de productos está vacía.</p>
            <a href="<?= base_url('home')?>">Ir al inicio</a>
        </div>        
<?php endif; ?>