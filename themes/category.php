<?php 
global $title; 

$page = isset($_GET['page'])?$_GET['page']:1;

// var_dump($apps );
$total_pages = 1;
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
                                    <span><a href="/" rel="nofollow"></a></span>
                                    <span><?php echo $slug; ?></span>
                                </div>
                                <!--Can't find substitution for tag [defaultAdStart]-->

                                <?php foreach($apps as $appId => $app){
                                    
                                    $img =  $app->getIcon();

                                    
                                    ?>

                                <div class="date-outer">

                                    <h2 class="date-header"><span>Friday, October 1, 2021</span></h2>

                                    <div class="date-posts">

                                        <div class="cat-outer">
                                            <article class="cat-post-wrapper">
                                                
                                                <a content="/<?php echo $appId; ?>"></a>
                                                <a href="/<?php echo $appId; ?>"><img alt="thumbnail" class="post-thumbnail" src="<?php echo $img; ?>"></a>
                                                <div class="cat-post-info">
                                                    <h2 class="post-title entry-title">
                                                        <a href="/<?php echo $appId; ?>" title="<?php echo $app->getName(); ?>">
<?php echo $app->getName(); ?>
</a>
                                                    </h2>
                                                    <div class="post-info">
                                                        <span class="cat-time-info">
<a class="timestamp-link" href="/<?php echo strtolower( $slug);?>" rel="bookmark" title="permanent link"> <?php echo $slug;?></a>
</span>
                                                        <div class="cat-recent-com"><a href="/<?php echo $appId; ?>" title="<?php echo $app->getName(); ?>"><i aria-hidden="true" class="fa fa-download"></i> Download</a></div>
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


                            <?php if($total_pages > 1){ ?>
                            <div style="clear: both;"></div>
                            <div class="old_new">

                                    

                                <div class="blog-pager" id="blog-pager">
                                    <span class="showpageOf"> <?php echo 'Page'. count($apps) .'of' . $total_apps; ?> of 4</span>

                                    <span class="showpageNum">
                                        <a href="/category/<?php echo $category->value; ?>?page=<?php echo $page-1;?>"><i class="fa fa-chevron-left"></i></a>
                                    </span>

                                    <?php 
                                        for($i=1;$i<=$total_pages;$i++){
                                            ?>
                                            <span class="showpageNum <?php echo $page==$i?'showpagePoint':'';?>">
                                                <a class="page-link" href="/category/<?php echo $category->value; ?>?page=<?php echo $i;?>"><?php echo $i;?></a>
                                            </span>

                                            <?php
                                        }
                                        ?>

                                    <span class="showpageNum">
                                        <a href="/category/<?php echo $category->value; ?>?page=<?php echo $page+1;?>"><i class="fa fa-chevron-right"></i></a>
                                    </span>
                                </div>  
                             </div>
                            <div class="clear"></div>

                            <?php } ?>


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