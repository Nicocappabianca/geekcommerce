<div class="container mt-4">
    <div class="col-12 col-md-6">
        <h2 class="pb-4">Modificar</h2>
        <?php if($this->session->flashdata('message')): ?>
            <p><?= $this->session->flashdata('message') ?></p>
        <?php endif ?>

        <img src="<?= thumb($products_item->img, 300, 250, 2, NULL) ?>" alt="<?= $products_item->title ?>">
        
        <?php $attributes = array('id' => 'update-form'); ?>
        <?= form_open_multipart('admin/products/update', $attributes); ?>
            <div class="mb-4">
                <label for="title">Titulo</label>
                <input class="form-control" type="text" name="title" value="<?= $products_item->title ?>" required/>
            </div>
            <div class="mb-4">
                <label for="description" >Descripcion</label>
                <textarea class="form-control" name="description"><?= $products_item->description ?></textarea>
            </div>
            <div class="mb-4">
                <label for="stock">Cantidad</label>
                <input class="form-control" type="number" min="0" name="stock" value="<?= $products_item->stock ?>" required/>
            </div>
            <div class="mb-4">
                <label for="price">Precio($)</label>
                <input class="form-control" type="number" min="0" name="price" value="<?= $products_item->price ?>" required/>
            </div>
                <input type="hidden" name="id" value="<?= $products_item->id ?>">
                <label for="price">Cambiar imagen</label>
            <div class="pb-4">
                <input class="input-file" type="file" name="userfile" size="20" />
            </div>
            <div>
                <?php if($products_item->visible): ?>
                    <select class="form-control my-4" name="visible">
                        <option value="1">Visible</option>
                        <option value="0">No Visible</option>
                    </select>
                    <?php else: ?>        
                        <select class="form-control my-4" name="visible">
                            <option value="0">No Visible</option>
                            <option value="1">Visible</option>
                        </select>
                <?php endif ?>
            </div>

            <input class="btn btn-success mt-4" type="submit" name="submit" value="Guardar cambios" />
        </form>
        <p class="py-4"><a href="<?= base_url('admin/products'); ?>"> Volver atras </a></p>
    </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
    $("#update-form").validate();
</script>