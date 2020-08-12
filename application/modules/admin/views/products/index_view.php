<h2 class="title-index mb-4">MIS PRODUCTOS</h2>

<?php if($this->session->flashdata('message')): ?>
    <p id="alertMessage" class="alert alert-primary container alert-message mb-4"><?= $this->session->flashdata('message') ?></p>
<?php endif ?>

<?php if(!empty($products)): ?>
    <div class="container pt-2 pb-4">
        <p><a class="btn btn-primary btn-sm mb-3" href="<?= base_url('admin/products/create'); ?>"> Cargar un nuevo producto </a></p>
        <div class="table-responsive">
            <table class="table" style="width:100%">
                <tr>
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Imagen</th>
                    <th style="text-align:left">Titulo</th>
                    <th style="text-align:left">Precio</th>
                    <th style="text-align:left">Stock</th>
                    <th style="text-align:left">Estado</th>
                    <th style="text-align:center">Editar</th>
                    <th style="text-align:center">Eliminar</th>
                </tr>
                <?php foreach ($products as $products_item): ?>
                    <tr>
                        <td style="text-align:center"><?= $products_item->id ?></td>
                        <td style="text-align:center">
                            <?php if(!empty($products_item->img)): ?>
                                <img class="img-fluid" src="<?= thumb($products_item->img, 70, 50, 2, NULL); ?>" alt="<?php $products_item->title?>">
                            <?php else:?>
                                <img src="<?= base_url('assets/img/no_pic.svg')?>" alt="product_img" width="30" height="30" alt="<?php $products_item->title?>">
                            <?php endif?>
                        </td>
                        <td style="text-align:left">
                            <a href="<?= base_url('admin/products/view/'.$products_item->id); ?>">
                                <?= $products_item->title ?>
                            </a>
                        </td>
                        <td style="text-align:left">$<?= $products_item->price ?></td>
                        <td style="text-align:left"><?= $products_item->stock ?></td>
                        <?php if($products_item->visible):?>
                            <td style="text-align:left">Visible</td>
                        <?php else:?>
                            <td style="text-align:left">No visible</td>
                        <?php endif;?>
                        <td style="text-align:center">
                            <a href="<?= base_url('admin/products/update_form/'.$products_item->id);?>">
                                <img src="<?= base_url('assets/img/pencil.png')?>" alt="pencil" width="22" height="22">
                            </a>
                        </td>
                        <td style="text-align:center">
                            <a href="#" class="btn-delete" data-id="<?= $products_item->id?>" data-name="<?= $products_item->title?>">
                                <img src="<?= base_url('assets/img/trash.svg')?>" alt="bin" width="22" height="22">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div><!-- .table-responsive -->
        <p class="paginate-links"> <?= $links; ?></p>
    </div><!-- .container -->
    <?php else: ?>
        <div class="container text-center pb-10">
            <p class="pb-3 mt-6">No tienes productos en tu lista.</p>
            <a class="mb-4" href="<?= base_url('admin/products/create'); ?>">¡Carga uno!</a>
        </div>
<?php endif; ?>

<script>
    $('.btn-delete').click(function(e){
        e.preventDefault();
        let res = confirm('desea eliminar el producto: "'+ $(this).data('name') +'" ?'); 
        if(res === true){
            window.location.href = '<?= base_url('admin/products/delete/'); ?>' + $(this).data('id');
        }
    })
</script>