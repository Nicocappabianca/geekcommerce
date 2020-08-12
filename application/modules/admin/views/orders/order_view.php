<div class="container pt-4">
    <h2>Orden #<?= $order->id;?></h2>
    <h3>Cliente: <?= $order->first_name;?> <?= $order->last_name;?></h3>
    <div class="row pt-4">
        <div class="col-12 col-md-6">
            <h5 class="pt-4">Pedido</h5>
            <p><?= $order->detail;?></p>
        </div>
        <div class="col-12 col-md-6">
            <h5 class="pt-4">Datos de envío</h5>
            <p><u>País</u>: <?= $shipping->country;?> </p>
            <p><u>Provincia</u>: <?= $shipping->province;?> </p>
            <p><u>Ciudad / Localidad</u>: <?= $shipping->city;?> </p>
            <p><u>Direccion</u>: <?= $shipping->address;?> </p>
        </div>
    </div>
    <p class="py-4"><a href="<?= base_url('admin/orders/index'); ?>"> Volver atras </a></p>
</div>

