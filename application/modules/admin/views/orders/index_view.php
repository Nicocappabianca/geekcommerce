<h2 class="title-index py-4">LISTA DE PEDIDOS</h2>

<?php if($this->session->flashdata('message')): ?>
    <p id="alertMessage" class="alert alert-primary container alert-message py-4"><?= $this->session->flashdata('message') ?></p>
<?php endif ?>

<?php if(!empty($orders)): ?>
    <div class="container pt-2">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th style="text-align:left">Número</th>
                    <th style="text-align:left">Fecha - Hora</th>
                    <th style="text-align:left">Cliente</th>
                    <th style="text-align:left">Detalle</th>
                </tr>

                <?php foreach ($orders as $order_item): ?>
                    <tr>
                        <td style="text-align:left">#<?= $order_item->id?></td>
                        <td style="text-align:left"><?= $order_item->created_on?></td>
                        <td style="text-align:left"><?= $order_item->first_name?> <?= $order_item->last_name?></td>
                        <td style="text-align:left">
                            <a href="<?= base_url('admin/orders/view_order/'.$order_item->id); ?>">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="py-3">
            <p class="paginate-links"> <?= $links; ?></p>
        </div>
        <p class="py-4"><a href="<?= base_url('admin/products'); ?>"> Volver al listado </a></p>
    </div><!-- .container -->
    <?php else: ?>
        <div class="container text-center pb-10 mb-4">
            <p class="py-4">No recibiste compras por el momento.</p>
            <a href="<?= base_url('home')?>">Ir al inicio</a>
        </div>       
<?php endif; ?>









