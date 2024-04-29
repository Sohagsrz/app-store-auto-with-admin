<?php
$type= "app";
$name= 'App';
global $title;
$title = $name;

$page = isset($_GET['page'])?$_GET['page']:1;
$page= max(1,$page);
$limit= $_ENV['per_page'];
$offset= ($page-1)*$limit;
$total_movies= db()::table('srz_cpt')->where([
    'post_type' =>$type,
    // 'status' => 1
    ])->count();
$total_pages= ceil($total_movies/$limit);
$movies= db()::table('srz_cpt')->where([
    'post_type' =>$type,
    'status' => 1
    ])->limit($limit)->offset($offset)->orderBy('ID','desc')->get();

 


get_dashboard_header();


 ?>

<div class="h-screen flex-grow-1 overflow-y-lg-auto">
        
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <?php 
                if(isset($_SESSION['success'])){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success'];?>
                    </div>
                    <?php
                    unset($_SESSION['success']);
                }
                ?>
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">All <?php echo $name;?></h5>
                            </div>
                            <div class="col text-end">
                                <a href="/dashboard/<?php echo $type;?>/add" class="btn btn-sm btn-primary">Add New</a>
                            </div>
                        </div> 
                         
                    </div>
                    
                    <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Added</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Edit / Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($movies as $movie){?>
                                        <tr> 
                                            <td>
                                                <?php echo $movie->title;?>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y',strtotime($movie->pub_date));?>
                                            </td>
                                            <td>
                                                <?php echo $movie->status == 1 ? 'Active' : 'Inactive';?>
                                            </td>
                                             
                                            <td class="text-end">
                                            <a href="/<?php echo $movie->slug;?>" class="btn btn-sm btn-neutral" target="_blank"><i class="bi bi-eye"></i></a>
                                                <a href="/dashboard/<?php echo $type;?>/edit?id=<?php echo $movie->ID;?>" class="btn btn-sm btn-neutral"><i class="bi bi-pencil"></i></a>
                                                <a href="/dashboard/<?php echo $type;?>/delete?id=<?php echo $movie->ID;?>" onclick="return confirm('Are you sure you want to Delete ?')" class="btn btn-sm btn-neutral"> <i class="bi bi-trash"></i></a>
                                                 
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                    </div>
                   

                    <div class="card-footer border-0 py-5">
                        
                        <span class="text-muted text-sm"><?php 
                        echo 'Showing '.count($movies).' items out of '.$total_movies.' results found';
                        ?></span>
                        <?php 
                        if($total_pages>1){
                            ?>
                            <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-end ">
                                <li class="page-item <?php echo $page==1?'disabled':'';?>">
                                    <a class="page-link" href="/dashboard/app?page=<?php echo $page-1;?>" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <?php 
                                for($i=1;$i<=$total_pages;$i++){
                                    ?>
                                    <li class="page-item <?php echo $page==$i?'active':'';?>">
                                        <a class="page-link" href="/dashboard/app?page=<?php echo $i;?>"><?php echo $i;?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="page-item <?php echo $page==$total_pages?'disabled':'';?>">
                                    <a class="page-link" href="/dashboard/app?page=<?php echo $page+1;?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                            <?php
                        }
                        ?>

                         
                    </div>
                </div>
            </div>
        </main>
    </div>
            

    <?php 
    
get_dashboard_footer();
 ?>
