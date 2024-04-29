<?php

  
 


  

$related_apps  = $gplay->getSimilarApps($app->getId(), 12);

$categoris = $app->getCategory();


  
$img = $app->getIcon();
$screenShoots= $app->getScreenshots();
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
                                <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <a href="/" itemprop="url"><span >Home</span></a>
                                </span>
                                <i class="fa fa-angle-right"></i>
                                <span itemprop="title" >
                                <a href="/category/<?php echo $categoris->getId() ?>" itemprop="url"><span ><?php echo $categoris->getName() ?></span></a>

                                </span>
                            </div>
                            <!--Can't find substitution for tag [defaultAdStart]-->

                            <div class="date-outer">
                                <h2 class="date-header"><span><?php 
                                //echo date('F j, Y',  $app->getReleased()->getTimestamp());?></span></h2>

                                <div class="date-posts">
                                    <div class="post-outer">
                                        <article class="post post-wrapper">
                                            <a content="#"></a>
                                            <div class="data-info">
                                                <div class="first-image">
                                                    <img alt="Facebook" src="<?php echo   $img; ?>" title="<?php echo $app->getName();?>" />
                                                </div>
                                                <h1 class="post-title entry-title">
                                                <?php echo $app->getName(); ?>
                                                </h1>
                                                <div class="sharepost">
                                                    <ul>
                                                        <li>
                                                            <a class="twitter" href="https://twitter.com/share?url=<?php echo get_url();?>" rel="nofollow" target="_blank" title="Twitter Tweet">
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="facebook"
                                                                href="https://www.facebook.com/sharer.php?u=<?php echo get_url();?>"
                                                                rel="nofollow"
                                                                target="_blank"
                                                                title="Facebook Share"
                                                            >
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="linkedin"
                                                                href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_url();?>&amp;title=Facebook&amp;summary="
                                                                target="_blank"
                                                            >
                                                                <i class="fa fa-linkedin"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="pinterest"
                                                                href="https://pinterest.com/pin/create/button/?url=<?php echo get_url();?>&amp;media=https://1.bp.blogspot.com/-IlDvON2Qqck/XadYoQqvipI/AAAAAAAADN4/cb09qWzqaJgTZmgMNHltdhP29g-RhA8KACLcBGAsYHQ/s72-c/Facebook.webp&amp;description= + data:post.title"
                                                                target="_blank"
                                                            >
                                                                <i class="fa fa-pinterest"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="post-info">
                                                    <span class="label-info"> 
                                                        <a  href="/category/<?php echo $categoris->getId() ?>"><i aria-hidden="true" class="fa fa-star"></i> <?php echo $categoris->getName() ?></a> 
                                                      </span>
                                                    <span class="time-info">
                                                        <a class="timestamp-link" href="<?php echo get_url();?>" rel="bookmark" title="permanent link">
                                                            <i aria-hidden="true" class="fa fa-clock-o"></i> <abbr class="published updated" title="<?php echo date('F j, Y',  $app->getReleased()->getTimestamp());?>"><?php echo date('F j, Y',  $app->getReleased()->getTimestamp());?></abbr>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="post-body entry-content" id="post-body-1731900364175433484">
                                                <div>
                                                <div style='text-align: center;'>
                                            <ul class='btn'>
                                            <li><a class='gplay' href='<?php echo $app->getUrl();?>' target='_blank'>Google Play</a></li>
                                            <li><a class='download' href="http://dl.apkleecher.com/apks/<?php echo $app->getId();?>.apk" target='_blank'>APK Download</a></li>
                                            </ul>
                                            </div>

                                                    <?php echo $app->getDescription(); ?>
                                                </div>
                                                <br>
                                                <ol>
                                                    <?php foreach($screenShoots as $screenShoot){
                                                        $imgUrl = $screenShoot->getUrl();
                                                        $imgUrl2 = $screenShoot->getOriginalSizeUrl();
                                                        echo '
                                                        <li>
                                                            <a href="#">
                                                                <img src="'. $imgUrl.'" />
                                                            </a>
                                                        </li>';
                                                    }?>
                                                     
                                                </ol>
                                                <div style="clear: both;"></div>
                                            </div>
                                        </article>
                                        <div style="clear: both;"></div>
                                        <?php if(count($related_apps ) > 0){?>
                                        <div class="related-postbwrap" id="bpostrelated-post">
                                            <h4>Related</h4>
                                            <ul class="related-post-style-2">

                                            <?php foreach($related_apps as  $related_app){

                                                $img =$related_app->getIcon();
                                                 ?>
                                            

                                                <li>
                                                    <img
                                                        alt=""
                                                        class="related-post-item-thumbnail"
                                                        src="<?php echo $img; ?>"
                                                        width="72"
                                                        height="72"
                                                    />
                                                    <a class="related-post-item-title" title="<?php echo $related_app->getName(); ?>" href="/<?php echo $related_app->getId(); ?>"><?php echo $related_app->getName(); ?> </a>
                                                    <span class="related-post-item-summary">
                                                        <div class="recent-com">
                                                            <a href="/<?php echo $related_app->getId(); ?>" class="related-post-item-more"><i aria-hidden="true" class="fa fa-download"></i> Download</a>
                                                        </div>
                                                    </span>
                                                    <span style="display: block; clear: both;"></span>
                                                </li>
                                                <?php } ?>

                                            </ul>
                                            <span style="display: block; clear: both;"></span>
                                        </div>
                                        <?php }?>

                                        <?php 
                                        $comments = $app->getReviews();

                                        ?>
                                        <div style="clear: both;"></div>
                                        <div class="comments" id="comments">
                                            <a name="comments"></a>
                                            <h4><?php echo  ($app->getNumberReviews());?> comments:</h4>
                                            <div class="comments-content">
                                                <div id="comment-holder">
                                                    <div class="comment-thread toplevel-thread">
                                                        <ol id="top-ra">
                                                            <?php 
                                                            foreach($comments as $comment){
                                                                ?>
                                                                <li class="comment" id="c8012736592672729512">
                                                                <div class="avatar-image-container"><img src="<?php echo $comment->getAvatar()->getUrl();?>" alt="" /></div>
                                                                <div class="comment-block">
                                                                    <div class="comment-header">
                                                                        <cite class="user"><a href="#" rel="nofollow"><?php echo $comment->getUserName();?></a></cite><span class="icon user"></span>
                                                                        <span class="datetime secondary-text">
                                                                            <a rel="nofollow" href="<?php echo get_url();?>?showComment=1674307139663#c8012736592672729512">
                                                                                
                                                                        <?php echo $comment->getDate()->format("F j, Y");?>
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                    <p class="comment-content">
                                                                    
                                                                            <b><?php echo $comment->getScore();?> Star</b><br/>
                                                                         
                                                                        
                                                                        <?php echo $comment->getText();?>
                                                                    </p>
                                                                </div>
  
                                                            </li>
                                                                <?php 
                                                            }?>

                                                           
                                                        </ol>
                                                        <div id="top-continue" class="continue hidden"><a class="comment-reply" target="_self" href="javascript:;">Add comment</a></div>
                                                        <div class="comment-replybox-thread" id="top-ce">
                                                           
                                                        </div>
                                                        <div class="loadmore hidden" data-post-id="1731900364175433484"><a target="_self">Load more...</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="comment-footer"></p>
                                            <div class="comment-form">
                                                <a name="comment-form"></a>
                                                <p></p>
                                                <a href="https://www.blogger.com/comment/frame/6764457970373871563?po=1731900364175433484&amp;hl=en&amp;blogspotRpcToken=8929453" id="comment-editor-src"></a>

                                                <!--Can't find substitution for tag [post.friendConnectJs]-->
                                                <script src="https://www.blogger.com/static/v1/jsbin/4235886812-comment_from_post_iframe.js" type="text/javascript"></script>
                                                <script type="text/javascript">
                                                    BLOG_CMT_createIframe("https://www.blogger.com/rpc_relay.html", "0");
                                                </script>
                                            </div>
                                            <p></p>
                                            <div id="backlinks-container">
                                                <div id="Blog1_backlinks-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Can't find substitution for tag [adEnd]-->
                        </div>
                        <div style="clear: both;"></div>
                        <div class="old_new">
                            
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
