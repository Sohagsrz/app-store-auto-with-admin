<?php
$type= "app";
$name= 'All Apps';
global $title;
$title = $name;

$page = isset($_GET['page'])?$_GET['page']:1;
$page= max(1,$page);
$limit = $_ENV['per_page'];
$offset= ($page-1)*$limit;
$total_apps= db()::table('srz_cpt')->where([
    'post_type' =>$type,
     'status' => 1
    ])->count();
$total_pages= ceil($total_apps/$limit);


$apps = db()::table('srz_cpt')->where([
    'post_type' =>'app',
    'status' => 1
    ])->limit($limit)->offset($offset)->orderBy('ID','desc')->get();

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
                                    <span><?php echo $name; ?></span>
                                </div>
                                <!--Can't find substitution for tag [defaultAdStart]-->

                                <?php foreach($apps as $app){
                                    
                                    
                                    ?>

                                <div class="date-outer">

                                    <h2 class="date-header"><span>Friday, October 1, 2021</span></h2>

                                    <div class="date-posts">

                                        <div class="cat-outer">
                                            <article class="cat-post-wrapper">
                                                
                                                <a content="https://1.bp.blogspot.com/-GetQ_jMQCXk/XadXD6CqU7I/AAAAAAAADNc/TRGQTjf2VJIbkREs5Q6vEGyEZ2ath9mLQCLcBGAsYHQ/s1600/WhatsApp%2BMessenger.webp"></a>
                                                <a href="/<?php echo $app->slug; ?>"><img alt="thumbnail" class="post-thumbnail" src="https://1.bp.blogspot.com/-GetQ_jMQCXk/XadXD6CqU7I/AAAAAAAADNc/TRGQTjf2VJIbkREs5Q6vEGyEZ2ath9mLQCLcBGAsYHQ/s72-c/WhatsApp%2BMessenger.webp"></a>
                                                <div class="cat-post-info">
                                                    <h2 class="post-title entry-title">
                                                        <a href="/<?php echo $app->slug; ?>" title="<?php echo $app->title; ?>">
<?php echo $app->title; ?>
</a>
                                                    </h2>
                                                    <div class="post-info">
                                                        <span class="cat-time-info">
<a class="timestamp-link" href="/<?php echo $app->slug; ?>" rel="bookmark" title="permanent link"><abbr class="published updated" title="<?php echo date('F j, Y', strtotime($app->pub_date));?>"><?php echo date('F j, Y', strtotime($app->pub_date));?></abbr></a>
</span>
                                                        <div class="cat-recent-com"><a href="/<?php echo $app->slug; ?>" title="<?php echo $app->title; ?>"><i aria-hidden="true" class="fa fa-download"></i> Download</a></div>
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
                                        <a href="/page/app?page=<?php echo $page-1;?>"><i class="fa fa-chevron-left"></i></a>
                                    </span>

                                    <?php 
                                        for($i=1;$i<=$total_pages;$i++){
                                            ?>
                                            <span class="showpageNum <?php echo $page==$i?'showpagePoint':'';?>">
                                                <a class="page-link" href="/page/app?page=<?php echo $i;?>"><?php echo $i;?></a>
                                            </span>

                                            <?php
                                        }
                                        ?>

                                    <span class="showpageNum">
                                        <a href="/page/app?page=<?php echo $page+1;?>"><i class="fa fa-chevron-right"></i></a>
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