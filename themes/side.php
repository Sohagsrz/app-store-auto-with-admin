 <?php 
 
 global $gplay;
 
 
 $apps = $gplay->getTopGrossingApps(
    'APPLICATION',
    10,
  );
 
  $categories = $gplay
    ->getCategories();


 ?>
 
 
 <div id="sidebar-wrapper">
        <div class="sidebar-area animated moveUp" id="sidebar">
            <div class="sidebarbtop section" id="sidebarbtop">
                
                <div class="widget PopularPosts" data-version="1" id="PopularPosts1">
                    <h2>Trendings</h2>
                    <div class="widget-content popular-posts">
                        <ul>

                        <?php foreach($apps as $app){
                            
                            $img = $app->getIcon();
                            ?>

                            <li>
                                <div class="item-thumbnail-only">
                                    <div class="item-thumbnail">
                                        <a href="/<?php echo $app->getId(); ?>" target="_blank">
                                            <img alt="<?php echo $app->getId(); ?>" border="0" src="<?php echo  $img; ?>" />
                                        </a>
                                    </div>
                                    <div class="item-title"><a href="/<?php echo $app->getId(); ?>"><?php echo $app->getName(); ?></a></div>
                                </div>
                                <div style="clear: both;"></div>
                            </li>

                            <?php } ?>

                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                

                <div class="widget Label" data-version="1" id="Label1">
                    <h2>Categories</h2>
                    <div class="widget-content cloud-label-widget-content">

                            <?php foreach($categories as $category){ ?>
                        <span class="label-size label-size-2">
                            <a dir="ltr" href="/category/<?php echo strtolower($category->getId()); ?>"><?php echo $category->getName(); ?></a>
                        </span>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>