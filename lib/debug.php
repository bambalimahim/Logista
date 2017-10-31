<div class="row">
    <div class="col-sm-4">
        <h2>SERVER</h2>
        <?php echo '<pre>'; var_dump($_SERVER); echo '</pre>'; ?>
    </div>
    <div class="col-sm-4">
        <h2>CONSTANTES</h2>
        <?php get_defined_constants(); ?>
    </div>
    <div class="col-sm-4">
        <h2>SESSION</h2>
        <?php echo '<pre>'; var_dump($_SESSION); echo '</pre>'; ?>
    </div>
</div>