<?php
global $gplay;
$apps = $gplay->search(
    $_GET['q'],
    50
);
 


get_header();

?>

    <div id="outer-wrapper">
        <div class="bwrapsite-content" id="bwrapcontent">
            <div class="content-area" id="primarybwrap">
                <div class="bwrapsite-main" id="mainbwrap" role="main">
                    <div class="mainblogsec section" id="mainblogsec">
                        <div class="widget Blog" data-version="1" id="Blog1">
                            <div class="blog-posts">
                                <div class="breadcrumbs">
                                    <span><a href="#" rel="nofollow"></a></span>
                                    <span>Search results for <?php echo $q; ?></span>
                                </div>
                                <!--Can't find substitution for tag [defaultAdStart]-->

                                <?php foreach($apps as $app){ ?>

                                <div class="date-outer">

                                    <div class="date-posts">

                                        <div class="cat-outer">
                                            <article class="cat-post-wrapper">
                                                
                                                <a content="/<?php echo $app->getId(); ?>.webp"></a>
                                                <a href="/<?php echo $app->getId(); ?>"><img alt="thumbnail" class="post-thumbnail" src="<?php echo $app->getIcon();?>"></a>
                                                <div class="cat-post-info">
                                                    <h2 class="post-title entry-title">
                                                        <a href="/<?php echo $app->getId(); ?>" title="<?php echo $app->getName(); ?>">
<?php echo $app->getName(); ?>
</a>
                                                    </h2>
                                                    <div class="post-info">
                                                        <span class="cat-time-info">
<a class="timestamp-link" href="/<?php echo $app->getId(); ?>" rel="bookmark" title="permanent link"> </a>
</span>
                                                        <div class="cat-recent-com"><a href="/<?php echo $app->getId(); ?>#more" title="<?php echo $app->getName(); ?>"><i aria-hidden="true" class="fa fa-download"></i> Download</a></div>
                                                    </div>
                                                </div>
                                            </article>
                                            <div style="clear: both;"></div>
                                        </div>

                                    </div>
                                </div>

                                <?php } ?>

                                <!--Can't find substitution for tag [adEnd]-->
                            </div>
                            <div style="clear: both;"></div>
                            <div class="old_new">
                                <div class="blog-pager" id="blog-pager"><span class="showpageOf">Page 1 of 1</span><span class="showpagePoint">1</span></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_side(); ?>
    </div>

    <?php 
get_footer();

?>