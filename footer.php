<div class="footer-line"></div>
<footer>
    <div class="container">
        <div class="footer-left">
            <h2 class="title"><?php vio_option('footer','name')?></h2>
            <p>Theme <a class="theme-logo" href="#">Violets</a></p>
        </div>
        <div class="footer-right">
        <?php 
        wp_nav_menu(array(
            'theme_location'=>'footer-link',
            'menu_class'=>'footer-link',
        ));
        vio_option('footer','custom')
        ?>
        </div>
    </div>
</footer>


</body>

</html>