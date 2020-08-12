<a id="back2Top" title="Back to top" href="#">&#10148;</a>
<footer class="py-4 bg-light mt-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light text-center">
        <ul class="navbar-nav m-auto">
            <li class="nav-item mx-3">
                <a class="nav-link mr-4" href="<?= base_url('home')?>">Home</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link mr-4" href="<?= base_url('products')?>">Productos</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link mr-4" href="<?= base_url('cart/view')?>">Carrito</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link mr-4" href="<?= base_url('pages/help');?>">Ayuda</a>
            </li>
        </ul>
    </nav>
    <div class="container text-center mt-3">
        <small><?=date('Y');?> Copyright &copy; <a target="_blank" href="https://github.com/Nicocappabianca">Nicolás Cappabianca</a></small>
    </div>
</footer>

<script>
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        if (height > 100) {
            $('#back2Top').fadeIn();
        } else {
            $('#back2Top').fadeOut();
        }
    });
    $(document).ready(function() {
        $("#back2Top").click(function(event) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

    });
</script>

<style>
small a{
    color: darkslategray;
}

small a:hover{
    color: black;
    text-decoration: none; 
}
</style>
