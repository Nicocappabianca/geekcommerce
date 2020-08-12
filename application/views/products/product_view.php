<div class="container mt-4 mb-2">
    <div class="row">
        <div class="col-12 col-lg-6">
            <?php if(empty($products->img)): ?>
                <img class="mt-3" src="<?= base_url('assets/img/no_img.jpg')?>" width="200" height="200" alt="<?= $products->title?>">
            <?php else: ?>
                <div class="img-hover-zoom">
                    <img class="img-fluid" src="<?=thumb($products->img, 600, 500, 2, NULL);?>" alt="<?= $products->title?>">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-5 mt-4">
            <div class="border-bottom">
                <h2 class=><?= $products->title?></h2>
                <p><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>  5 Reseñas</p>
            </div>
            <div class="border-bottom mb-4">
                <div class="row mt-4">
                    <div class="col-12 col-lg-6 mb-3">
                        <h3>$<?= $products->price?></h3>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <p><?= $products->description?></p>
                    </div>
                </div>
            </div>
            <?= form_open('Cart/add_to_cart'); ?>
                <label for="quantity">Cantidad</label>
                <div class="col-2 col-sm-3 p-0">
                    <input type="number" name="qty" min="1" class="form-control" value="1" max="<?= $products->stock?>">
                </div>
                <input class="btn btn-primary mt-3" type="submit" name="add" value="Agregar al Carrito" />
                <input type="hidden" name="id" value="<?= $products->id; ?>">
                <input type="hidden" name="price" value="<?= $products->price; ?>">
                <input type="hidden" name="name" value="<?= $products->title; ?>">
                <input type="hidden" name="img" value="<?= $products->img; ?>">
                <input type="hidden" name="description" value="<?= $products->description; ?>">
            </form>
            <p class="pt-3"><a href="<?= base_url('products'); ?>"> Ir al listado </a></p>
        </div><!-- .col-5 -->
    </div><!-- .row -->
</div><!-- .container -->

<hr class="w-100"></hr>

<div class="container pb-3">
    <h3 class="my-4 text-center">Productos Similares</h3>
    <div class="row ">
        <?php for($i = 0; $i < 3 ; $i++): ?>
            <div class="col-12 col-lg-4">
                <div class="row ml-auto" style="align-items: center">
                    <div class="col-6">
                        <a href="<?= base_url('products/view/'.$bottom[$i]->id);?>">
                            <img class="img-fluid" src="<?=thumb($bottom[$i]->img, 600, 500, 2, NULL);?>" alt="<?= $bottom[$i]->title;?>">
                        </a>
                    </div>
                    <div class="col-6">
                        <div>
                            <p><b class="pt-4"><?= $bottom[$i]->title;?></b></p>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i  class="far fa-star"></i>
                            <p class="mt-2">$<?= $bottom[$i]->price;?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div><!-- .container-fluid -->


<hr class="w-100"></hr>

<div class="container mb-6">
    <h3 class="mt-3">Opiniones</h3>
    <div class="row pt-4" style="align-items: center">
        <div class="col-4 col-lg-1">
            <img class="img-fluid mb-3" src="<?= thumb(base_url('assets/img/avatar.png'), 150, 150, 2, NULL)?>" style="border-radius:50%" alt="avatar">
        </div>
        <div class="col-6 col-lg-2 pt-2">
            <h5>JOHN DOE</h5>
            <small>18, Febrero 2020</small>
            <p class="mt-1"><small><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i  class="far fa-star"></i></small></p>
        </div>
        <div class="col-12 col-lg-8">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est vero corporis dignissimos a iste porro quod deserunt itaque cupiditate tenetur, quis magni, officia eos accusamus nostrum fugiat, esse sed. Dolorum delectus laboriosam omnis tempora ut molestiae molestias dolorem dolores rerum.</p>
        </div>
    </div>
    <div class="col-12 col-lg-1 border-bottom mt-3"></div>
    <div class="row pt-4" style="align-items: center">
        <div class="col-4 col-lg-1">
            <img class="img-fluid mb-3" src="<?= thumb(base_url('assets/img/avatar2.png'), 150, 150, 2, NULL)?>" style="border-radius:50%" alt="avatar">
        </div>
        <div class="col-6 col-lg-2 pt-2">
            <h5>EVA SMITH</h5>
            <small>15, Febrero 2020</small>
            <p class="mt-1"><small><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i  class="far fa-star"></i></small></p>
        </div>
        <div class="col-12 col-lg-8">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est vero corporis dignissimos a iste porro quod deserunt itaque cupiditate tenetur, quis magni, officia eos accusamus nostrum fugiat, esse sed. Dolorum delectus laboriosam omnis tempora ut molestiae molestias dolorem dolores rerum.</p>
        </div>
    </div>
</div><!-- .container-fluid -->