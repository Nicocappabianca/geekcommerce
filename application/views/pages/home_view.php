<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

<?php if($this->session->flashdata('message')): ?>
    <p id="alertMessage" class="alert alert-primary container alert-message"><?= $this->session->flashdata('message') ?></p>
<?php endif ?>


<div class="container py-4">
    <h2 class="text-center mt-4">Bienvenido a GeekCommerce</h2>
    <div class="col-3 mx-auto border-bottom pt-4"></div>
        <div class="container mt-4 mb-4">
            <div class="row">   
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $products_item):?>             
                        <div class="d-none d-lg-block col-md-4 mt-1 mb-2 flex-center">
                            <a class="d-block" href="<?= base_url('products/view/'.$products_item->id); ?>">
                                <img class="img-fluid" src= "<?=thumb($products_item->img, 800, 800, 2, NULL);?>" alt="<?= $products_item->title?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- .row -->
            <p class="text-center mt-4"><a class="btn btn-success btn-lg" href="products">¡Comprar Ahora!</a></p>
        </div><!-- .container -->
    </div><!-- .col -->
</div><!-- .container -->

<hr class=W-100>

<?php if(!empty($swiper)): ?>
    <div class="container mt-4 mb-4">
        <h2 class="text-center my-4">Productos Destacados</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper mt-4">
                <?php foreach($swiper as $swiper_item):?>    
                    <div class="swiper-slide">
                        <a href="<?= base_url('products/view/'.$swiper_item->id);?>">
                            <img class="pr-4 mx-auto d-block img-fluid" src="<?=thumb($swiper_item->img, 350, 350, 2, NULL);?>" alt="<?= $swiper_item->title;?>">
                        </a>
                        <h4 class="text-center mt-2"><?= $swiper_item->title;?></h4>
                        <b><p class="text-center">$<?= $swiper_item->price;?></p></b>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Arrows -->
            <div class="swiper-button-next ml-2"></div>
            <div class="swiper-button-prev mr-2"></div>
        </div><!-- .swiper-container -->
    </div><!-- .container -->
<?php endif; ?>

<div class="container-fluid border-top border-bottom pb-3 mb-4">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h2>Newsletter</h2>
                <p>Suscribite a nuestro newsletter para recibir todas las novedades y ofertas. Sólo debes ingresar tu correo electrónico</p>
            </div>
            <div class="col-12 col-lg-6">
                <form class="mt-4" action="<?= base_url('Pages/suscribe');?>" id="form-newsletter">
                    <input class="mt-2 form-control" type="email" style="width: 60%" required>
                    <button type="submit" class="btn btn-secondary ml-2 mt-2" style="height: 10%">Suscribirse</button>
                </form>
            </div>    
        </div>
    </div>
</div><!-- .container-fluid (newsletter) -->

<?php if(count($bottom) > 4): ?>
    <div class="container mb-4">
            <div class="row mt-1">
                <div class="col-12 col-lg-4 my-auto pl-4">
                    <div class="pr-4">
                        <a href="<?= base_url('products/view/'.$bottom[0]->id);?>">
                            <img class="img-fluid" src="<?=thumb($bottom[0]->img, 350, 290, 2, NULL);?>" alt="<?= $bottom[0]->title;?>">
                        </a>
                        <div class="row mx-auto pl-4">
                            <h5><?= $bottom[0]->title;?></h5>
                            <p class="mx-auto"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>
                        </div>
                        <b class="pl-4">$<?= $bottom[0]->price;?></b>
                    </div>
                </div><!-- .col-md-4 -->
                <div class="col-12 col-lg-8">
                    <div class="row mt-4">
                        <?php for($i = 1; $i < 5 ; $i++): ?>
                            <div class="col-12 col-lg-6 pb-4 pl-4">
                                <a href="<?= base_url('products/view/'.$bottom[$i]->id);?>">
                                    <img class="img-fluid" src="<?=thumb($bottom[$i]->img, 250, 200, 2, NULL);?>" alt="<?= $bottom[$i]->title;?>">
                                </a>
                                <div class="row mx-auto">
                                    <h5><?= $bottom[$i]->title;?></h5>
                                    <p class="mx-auto"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far  fa-star"></i><i class="far fa-star"></i></p>
                                </div>
                                <b>$<?= $bottom[$i]->price;?></b>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div><!-- .row (principal) -->
    </div><!-- .container-fluid -->
<?php endif; ?>

<div class="w-100 border-bottom"></div>
<div class="container pt-4">
    <h2 class="text-center pt-2">
        Sobre Nosotros
    </h2>
    <div class="text-center mb-6">
        <p class="pt-3 w-75 mx-auto">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, corporis voluptatibus a, doloremque facilis quam fugit quia et perspiciatis illum libero laborum voluptates! Officiis, perspiciatis doloremque! Tempore, nisi quisquam quasi beatae incidunt quaerat repellat accusamus nesciunt quam eum quia dolores.
        </p>
    </div>
</div><!-- .container-fluid (sobre nosotros) -->

<!----------------------- SCRIPTS ----------------------------->

<!-- Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 2,
    spaceBetween: 0,
    slidesPerGroup: 2,
    loop: true,
    loopFillGroupWithBlank: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>