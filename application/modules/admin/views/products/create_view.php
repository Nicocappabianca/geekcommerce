<div class="container">
    <div class="col-12 col-md-6">
        <h2 class="py-4">NUEVO PRODUCTO</h2>
        <?php if(!empty($error)): ?>
            <div class="alert alert-warning"> <?= $error ?> </div>
        <?php endif ?>
        <?php $attributes = array('id' => 'create-form'); ?>
        <?= form_open_multipart('admin/products/create', $attributes); ?>
            <div class="mb-4">
                <label for="title">Titulo</label>
                <input class="form-control" type="text" name="title" value="<?= set_value('title'); ?>" required/>
            </div>
            <div class="mb-4">
                <label for="description">Descripcion</label>
                <textarea class="form-control" name="description"><?= set_value('description');?></textarea>
            </div>
            <div class="mb-4">
                <label for="stock">Cantidad</label>
                <input class="form-control" type="number" min="0" name="stock" value="<?= set_value('stock'); ?>" required/>
            </div>
            <div class="mb-4">
                <label for="price">Precio($)</label>
                <input class="form-control" type="number" min="0" name="price" value="<?= set_value('price'); ?>" required/>
            </div>
            <label for="file">Subir imagen</label>
            <div>
                <input class="mb-2 input-file" type="file" name="userfile" size="20"/>
            </div>            
            <input class="btn btn-success mt-4" type="submit" name="submit" value="Guardar producto" />
        </form>
        <p class="py-4"><a href="<?= base_url('admin/products'); ?>"> Volver al listado </a></p>
    </div><!-- .col-6 -->
</div><!-- .container -->

<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/libs/jquery-validation/localization/messages_es_AR.js');?>"> </script>
<script>
    $("#create-form").validate();
</script>
