<?php if (!empty($this->cart->contents())): ?>
    <div class="container pt-4">
        <div class="row pt-3 pb-4">
            <div class="col-12 col-lg-7">
                <table class="table border-bottom" style="width:100%">
                    <h4>Carrito</h4>
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                        <?= form_hidden($i.'[rowid]', $items['rowid']); ?>
                        <tr>
                            <td style="text-align:center"><img class="mt-2" src="<?= thumb($items['img'], 90, 80, 2, NULL);?>" alt="<?= $items['name']; ?>"></td>
                            <td style="text-align:left">
                                <?= $items['name']; ?>
                                <div>
                                    <small><?= $items['description']; ?></small>
                                </div>
                                <div class="pt-3">
                                    $<?= $this->cart->format_number($items['price']); ?>
                                </div>
                            </td>
                            <td class="mt-4" style="text-align:left">
                                <div class="pt-4">
                                    <?= form_input(array('readonly' => 'TRUE', 'class'=> 'form-control', 'name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="col-12 col-lg-4 offset-lg-1">
                <h4>Resumen</h4>
                <div class="row border-top">
                    <div class="col-6 mt-2">
                        <p>SUBTOTAL</p>
                    </div>
                    <div class="col-6 mt-2 text-right">
                        <p>$<?= $this->cart->format_number($this->cart->total()); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>ENVIO</p>
                    </div>
                    <div class="col-6 text-right">
                        <p>GRATIS</p>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6">
                        <p>IMPUESTOS</p>
                    </div>
                    <div class="col-6 text-right">
                        <p>$0.00</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <b>TOTAL</b>
                    </div>
                    <div class="col-6 text-right">
                        <b>$<?= $this->cart->format_number($this->cart->total()); ?></b>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($this->ion_auth->logged_in()): ?>
            <a class="btn btn-primary" href="<?= base_url('cart/shipping_form')?>">CONTINUAR</a>
        <?php else: ?>
            <a class="btn btn-primary" href="<?= base_url('auth/login')?>">INICIAR SESION</a>
        <?php endif?>
        <a class="btn btn-secondary ml-2" href="<?= base_url('cart/cancel')?>">CANCELAR</a>
        <p class="mb-10 mt-4"><a href="<?= base_url('products'); ?>">Seguir comprando</a></p>
    </div><!-- .container -->
<?php else:?>
    <div class="text-center pt-4 pb-10">
        <p class="pt-10">Su carrito está vacío.</p>
        <p class="pt-2"><a href="<?= base_url('products'); ?>">Ir al listado</a></p>
    </div>
<?php endif?>

