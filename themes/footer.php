<?php

$categories = getCategories();



?>


<footer class="site-footer" id="footer">
        <div class="footerlinks">
            <a class="footer-link"  href="/page/About">About</a>
            <a class="footer-link"  href="/page/Sitemap">Sitemap</a>
            <a class="footer-link"  href="/page/Advertise">Advertise</a>
            <a class="footer-link"  href="/page/Privacy Policy">Privacy Policy</a>
            <a class="footer-link" href="/page/Contact">Contact</a>
        </div>
        <div class="site-info">
            Copyright © <?php echo date('Y');?>
            <a href=""><span>Pure APK</span></a> All Right Reserved -
            <div id="mscontent" style="display: inline-block;">Created with <i style="color:#ff695d;" class="fa fa-heart"></i> by <a href="https://www.templatemark.com">Template Mark</a></div>
        </div>
    </footer>
    <div class="smoothscroll-top">
        <span class="scroll-top-inner">
<i aria-hidden="true" class="fa fa-chevron-up"></i>
</span>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
 
    <script async="async" src="https://cdn.ampproject.org/v0.js"></script>
    <script async="async" custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <amp-sidebar id="offcanvas" layout="nodisplay" class="i-amphtml-element i-amphtml-layout-nodisplay i-amphtml-overlay i-amphtml-scrollable i-amphtml-built" hidden="" i-amphtml-layout="nodisplay" side="left" role="menu" tabindex="-1">
        <button class="buttonss" on="tap:offcanvas.close"><i aria-hidden="true" class="fa fa-times"></i></button>
        <div class="sidebar">
            <ul>
                 

                <?php foreach($categories as $category){?>

                <li><a href="/category/<?php echo $category->value; ?>"> 
                <!-- <i aria-hidden='true' class='fa fa-folder'>  -->
                    <?php echo $category->name; ?></a></li>

                <?php } ?>


            </ul>
            <div class="widget_social_apps">
                <div class="app_social facebook">
                    <a href="" target="_blank"><span class="app_icon"><i class="fa fa-facebook"></i></span>
</a></div>
                <div class="app_social twitter">
                    <a href="" target="_blank"><span class="app_icon"><i class="fa fa-twitter"></i></span></a></div>
                <div class="app_social instagram">
                    <a href="" target="_blank"><span class="app_icon"><i class="fa fa-instagram"></i></span></a></div>
                <div class="app_social linkedin">
                    <a href="" target="_blank"><span class="app_icon"><i class="fa fa-linkedin"></i></span></a></div>
            </div>
        </div>
        <button class="i-amphtml-screen-reader" tabindex="-1">Close the sidebar</button></amp-sidebar>
 

</body>

</html>