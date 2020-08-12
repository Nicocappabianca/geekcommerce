<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 pb-3 pt-3">
    <a class="navbar-brand" href="<?= base_url('home')?>">
        <img src="<?= base_url('assets/img/logo.png');?>" alt="GeekCommerce">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <!-- SI ESTÁ LOGEADO -->
            <?php if($this->ion_auth->logged_in()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout')?>">Cerrar sesión</a>
                </li>
                <!-- SI ES ADMIN -->
                <?php if($this->ion_auth->is_admin()): ?>
                    <li class="nav-item">    
                        <a class="nav-link" href="<?= base_url('admin/orders/index')?>">Ver pedidos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/products')?>">Mis productos</a>
                    </li>
                <?php endif ?>
            <!-- SI NO ESTÁ LOGEADO -->
            <?php else:?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/login')?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/create_user')?>">Registrarse</a>
                </li>
            <?php endif ?>  
            <!-- TODOS -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('products')?>">Listado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('cart/view')?>">
                    <i class="fas fa-shopping-cart"></i> <span>Carrito</span> 
                </a>
            </li>
        </ul>
    </div>
</nav>
