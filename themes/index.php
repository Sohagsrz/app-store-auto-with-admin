<?php
global $gplay;

$type = 'app';

$apps = $gplay->getListApps(null, null, 99);
 
// $apps = db()::table('srz_cpt')->where([
//     'post_type' =>'app',
//     'status' => 1
//     ])->limit(10)->orderBy('ID','desc')->get();

$top_views = $gplay->getTopSellingFreeApps (
    'APPLICATION',
    7
);




get_header();

?>
<div id="outer-wrapper">
    <div class="moveUp animated section" id="recent6">
        <div class="widget HTML" data-version="1" id="HTML1">
            <div class="widget-content">
                <div class="title">
                    <a href="#"><i aria-hidden="true" class="fa fa-link" style="margin: 0 0; font-size: 15px; color: #fff !important; padding: 8px; border-radius: 100px; background: #ea4335;"></i> Weekly Trending</a>
                    <!-- <div class="viewall">
                        <a href="/search/label/Featured">View All <i aria-hidden="true" class="fa fa-rss"></i></a>
                    </div> -->
                </div>
                <div class="mobres">
                    <ul class="recent_posts_with_thumbs">
                    
                    <?php foreach($top_views as $app) {

                            $img = $app->getIcon();

                        
                        ?>

                        <li class="recent-box">
                            <img class="recent_thumb" src="<?php echo $img; ?>" />
                            <div class="label_title"><a href="<?php echo  $app->getId(); ?>" target="_top"><?php echo  $app->getName(); ?></a></div>
                             <?php echo number_format($app->getScore(),1);?>
                            <div class="recent-com">
                                <a href="<?php echo  $app->getId(); ?>" target="_top"><i aria-hidden="true" class="fa fa-download"></i> Download</a>
                            </div>
                        </li>

                        <?php } ?>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bwrapsite-content" id="bwrapcontent">
        <div class="content-area" id="primarybwrap">
            <div class="mag-wrapper">

            

                <div class="moveUp section animated" id="recent5">
                    <div class="widget HTML" data-version="1" id="HTML5">
                        <div class="widget-content">
                            <div class="title">
                                <a href="/page/app">
                                    <i aria-hidden="true" class="fa fa-sign-in" style="margin: 0 0; font-size: 15px; color: #fff !important; padding: 8px; border-radius: 100px; background: #8bc34a;"></i> Recently Uploaded
                                </a>
                                <div class="viewall">
                                    <a href="/search/label">View All <i aria-hidden="true" class="fa fa-rss"></i></a>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <ul class="recent_posts_with_thumbs">

                                <?php foreach($apps as $appID => $app){ 
                                    $img = $app->getIcon();
                                    // $img = get_field('img',$app->ID, $type,'');

                                    
                                    ?>
                                <li class="recent-box">
                                    <img class="recent_thumb" src="<?php echo $img; ?>" />
                                    <div class="label_title"><a href="<?php echo $appID; ?>" target="_top"><?php echo $app->getName(); ?></a></div>
                                    <?php echo number_format($app->getScore(),1);?>
                                    <div class="recent-com">
                                        <a href="<?php echo $appID; ?>" target="_top"><i aria-hidden="true" class="fa fa-download"></i> Download</a>
                                    </div>
                                </li>
                                    <?php } ?>

                            </ul>
                        </div>
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