<div class="container mt-4 mb-10">
    <?php if(!empty($error)): ?>
        <div class="alert alert-warning mb-4"> <?= $error ?> </div>
    <?php endif ?>
    <div class="row">
        <div class="col-12 col-lg-6 order-lg-first pt-4 pt-lg-0">
            <h4>Datos de envío</h4>
            <hr class="mt-0">
            <?php $attributes = array('id' => 'shipping-form'); ?>
            <?= form_open_multipart('Cart/shipping_form', $attributes); ?>
                <div class="row">
                    <div class="col-12 col-lg-6">
                    <input placeholder="Nombre" class="form-control mb-4" type="text" name="first_name" value="<?= set_value('first_name');?>" required/>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input placeholder="Apellido" class="form-control mb-4" type="text" name="last_name" value="<?= set_value('last_name');?>" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input placeholder="Direccion" class="form-control mb-4" type="text" name="address" value="<?= set_value('address');?>" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                        <select class="form-control" id="country" name="country">
                            <?php foreach($countries as $country): ?>
                                <option value="<?= $country->country_name?>"> <?= $country->country_name?> </option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input placeholder="Provincia" class="form-control mb-4" type="text" name="province" value="<?= set_value('province');?>" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <input placeholder="Ciudad" class="form-control mb-4" type="text" name="city" value="<?= set_value('city');?>" required/>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input placeholder="Telefono" class="form-control mb-4" type="tel" name="phone" value="<?= set_value('phone');?>" required/>
                    </div>
                </div>

                <hr class="mt-0">

                <div class="col-12">
                    <div class="row mt-4 mb-4">
                        <div class="col-12 col-lg-6 p-lg-0">
                            <div class="border">
                                <div class="form-check my-2 ml-2">
                                    <input id="free" class="form-check-input mt-3" type="radio" name="shipping" value="free" checked>
                                    <label class="form-check-label pl-3" for="shipping">Envío Gratis</label>
                                    <div>
                                        <small class="pl-3">2 a 5 días hábiles.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-lg-0 pt-2">
                            <div class="ml-0 ml-lg-2 border">
                                <div class="form-check my-2 ml-2">
                                    <input id="fast" class="form-check-input mt-3" type="radio" name="shipping" value="fast">
                                    <label class="form-check-label pl-3" for="shipping">Envío en 24 hs - $399</label>
                                    <div>
                                        <small class="pl-3">24 horas desde el checkout</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div>

                <hr class="mt-0">
            
                <input class="btn btn-primary" type="submit" name="submit" value="ENVIAR PEDIDO" />
                <a class="btn btn-secondary ml-2" href="<?= base_url('cart/cancel')?>">CANCELAR</a>
                <p class="mt-4"><a href="<?= base_url('cart/view'); ?>"> Volver atras </a></p>
            </form>
        </div><!-- .col-8 -->

        <div class="col-12 col-lg-4 offset-lg-2 order-first pb-4 pb-lg-0">
            <div class="row">
                <h4 class="ml-2 ml-lg-0">Resumen</h4>
                <table class="table border-bottom">                    
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                        <?= form_hidden($i.'[rowid]', $items['rowid']); ?>
                        <tr>
                            <td style="text-align:center"><img src="<?= thumb($items['img'], 130, 90, 2, NULL); ?>" alt="<?= $items['name']; ?>"></td>
                            <td style="text-align:left">
                                <?= $items['name']; ?>
                                <div>
                                    $<?= $this->cart->format_number($items['price']); ?>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="row">
                <div class="col-6 mt-2">
                    <p>SUBTOTAL</p>
                </div>
                <div class="col-6 mt-2 text-right">
                    <p id="subtotal" data-amount="<?=$this->cart->total();?>">$<?= $this->cart->format_number($this->cart->total()); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>ENVIO</p>
                </div>
                <div class="col-6 text-right">
                    <p id="shipping_cost">GRATIS</p>
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
                    <b id="total">$<?= $this->cart->format_number($this->cart->total()); ?></b>
                </div>
            </div>
        </div><!-- .col-4 -->
    </div><!-- .row -->
</div><!-- .container -->

<!------------------ SCRIPTS ----------------------------->
<script>
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
});
    
    $('input[name="shipping"]').on('change',function(){
        let subtotal = $("#subtotal").data("amount");
        let total = 0;
        
        if($(this).val()=='free'){
            $("#shipping_cost").text("GRATIS");
            total = subtotal;
        } else{
            $("#shipping_cost").text("$399.00"); 
            total = subtotal + 399; 
        }

        $("#total").html(formatter.format(total));
    }); 
</script>

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
    $("#create-form").validate();
</script>
