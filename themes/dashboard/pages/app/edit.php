<?php
$type= "app";
$name= 'App';
global $title;
$title = 'Edit '.$name;
$post = db()::table('srz_cpt')->where([
    'ID' => $_GET['id'],
    'post_type' => $type
])->first();
if(!$post){ 
    redirect('/dashboard/'.$type);
}
$post_id = $post->ID;
 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $img = $_POST['img'];
    $category = $_POST['category']; 
    $updated = db()::table('srz_cpt')->where(
        [
            'ID' => $_GET['id'],
        ]
    )->update([
        'post_type' => $type,
        'title' => $title,
        'description' => $content, 
        'status' => 1,
        'pub_date' => date('Y-m-d H:i:s')
    ]);

    if($updated){
        
        if(isset($_FILES['img_file'])){
            
            $upload = new \Delight\FileUpload\FileUpload();
            $upload->withTargetDirectory(app_dir.'/assets/uploads');
            $upload->from('img_file');
            $upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png' ]);
        
            try {
                $uploadedFile = $upload->save();
                update_field('img','/assets/uploads/'.$uploadedFile->getFilenameWithExtension(), $type,$post_id);
            }
            catch (\Delight\FileUpload\Throwable\InputNotFoundException $e) {
                // input not found
            }
            catch (\Delight\FileUpload\Throwable\InvalidFilenameException $e) {
                // invalid filename
            }
            catch (\Delight\FileUpload\Throwable\InvalidExtensionException $e) {
                // invalid extension
            }
            catch (\Delight\FileUpload\Throwable\FileTooLargeException $e) {
                // file too large
            }
            catch (\Delight\FileUpload\Throwable\UploadCancelledException $e) {
                // upload cancelled
            } catch(Exception $e){

            }

        }else if($img){
            update_field('img',$img,$type,$post_id);
        }






        if(isset($_FILES['gallery'])){
            
            $upload = new \Delight\FileUpload\FileUpload();
            $upload->withTargetDirectory(app_dir.'/assets/uploads');
            $upload->from('gallery');
            $upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png' ]);
        
            try {
                $uploadedFile = $upload->save();
                update_field('gallery','/assets/uploads/'.$uploadedFile->getFilenameWithExtension(), $type,$post_id);
            }
            catch (\Delight\FileUpload\Throwable\InputNotFoundException $e) {
                // input not found
            }
            catch (\Delight\FileUpload\Throwable\InvalidFilenameException $e) {
                // invalid filename
            }
            catch (\Delight\FileUpload\Throwable\InvalidExtensionException $e) {
                // invalid extension
            }
            catch (\Delight\FileUpload\Throwable\FileTooLargeException $e) {
                // file too large
            }
            catch (\Delight\FileUpload\Throwable\UploadCancelledException $e) {
                // upload cancelled
            } catch(Exception $e){

            }

        }



        //clear cat first 
        db()::table('cat_post_realtion')
        ->where(
            [
                'post_id' => $post_id,
                'type' => $type
            ]
        )
        ->whereNotIn('cat_id',$category)->delete();
  
        foreach($category as $cat){
            db()::table('cat_post_realtion')->updateOrInsert([
                'post_id' => $post_id,
                'cat_id' => $cat,
                'type' => $type
            ]);
        }

        if(isset($_POST['featured'])){
            update_field('featured',1,$type,$post_id);
        }else{
            update_field('featured',0,$type,$post_id);
        }
       

        $_SESSION['success'] = 'Updated successfully';
        redirect('/dashboard/'.$type.'/edit?id='.$post_id);
    }
} 
 
  
$categories= db()::table('srz_cats')->where([
    'type' =>'app'
    ])->orderBy('name','asc')->get();

$selected_cats = db()::table('cat_post_realtion')->where([
    'post_id' => $post_id,
    'type' => $type
])
->select('cat_id')
->get();

//$selected_cats = $selected_cats ? $selected_cats : [];
$selected_catsIds= [];
foreach($selected_cats as  $cat){
    $selected_catsIds[] = $cat->cat_id;
}
$selected_cats = $selected_catsIds;
 
$img = get_field('img',$post_id, $type,'');
$is_featured = get_field('featured',$post_id, $type,0);


get_dashboard_header();


 ?>
 <style>
    .input-group {
      margin-bottom: 10px;
    }
  </style>
 <div class="h-screen flex-grow-1 overflow-y-lg-auto">

<main class="py-6 bg-surface-secondary">
    <div class="container-fluid">

        <div class="card shadow border-0 mb-7">
            
            <div class="card-header add_cat">
                <h5 class="mb-0">Edit <?php echo $name;?></h5>
                 
            </div>
            </div>
            <?php if(isset($_SESSION['success'])){?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success'];?>
            </div>
            <?php unset($_SESSION['success']);}?>
            <?php if(isset($_SESSION['error'])){?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
            </div>
            <?php unset($_SESSION['error']);}?>
            
        <div class="card shadow border-0 mb-7 add-container">
            <div class="card-body">
                <form action="?id=<?php echo $post_id;?>" method="POST" enctype="multipart/form-data" >
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?php echo htmlspecialchars($post->title);?>"  required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" name="content" id="content"  rows="4" required><?php echo  ($post->description);?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Featured?</label>
                        <input type="checkbox" name="featured" value="1" <?php echo $is_featured == 1 ? 'checked' : '';?>>
                    </div>


                    <div class="mb-3">
                        <label for="img" class="form-label">Image Url:</label>
                        <input type="text" name="img" class="form-control" id="img" value="<?php echo htmlspecialchars($img);?>">
                        <br/>
                        <h5>OR</h5>
                        <input type="file" name="img_file" class="form-control" id="img" >
                    </div>


                    <div class="mb-3">
                        <label for="gallery" class="form-label">Product Gallery:</label>
                        <div id="input-container-gallery">
                            <div class="input-group">
                                <input type="file" name="gallery[]" class="form-control">
                                <button type="button" class="btn btn-danger" onclick="removeInput(this)">Delete</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm bg-surface-secondary btn-neutral" onclick="addGalleryInput()">Add Image</button>
                    </div>
                    


                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <select class="form-control" id="category" name="category[]" multiple required>
                            <option value="" disabled>Select Category</option>
                            <?php 
                            foreach($categories as $category){
                                ?>
                            <option value="<?php echo $category->ID;?>"
                            <?php echo in_array($category->ID,  $selected_cats) ? 'selected' : '';?>
                            ><?php echo $category->name;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mb-3">
                    <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" >Update <?php echo $name;?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</div>
<link
  rel="stylesheet"
  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
/>
<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script>
          <script>
            
            var editor = Jodit.make('#content');

            jQuery(document).ready(function($) {
    $('select').select2();
});
function addInput() {
      var inputContainer = document.getElementById("input-container");
      var newInput = document.createElement("div");
      newInput.classList.add("input-group");
      newInput.innerHTML = `
        <input type="url" name="watch_url[]" class="form-control">
        <button type="button" class="btn btn-danger" onclick="removeInput(this)">Delete</button>
      `;
      inputContainer.appendChild(newInput);
    }
    function addDlinput() {
      var inputContainer = document.getElementById("input-container-dl");
      var newInput = document.createElement("div");
      newInput.classList.add("input-group");
      newInput.innerHTML = `
        <input type="url" name="dl_urls[]" class="form-control">
        <button type="button" class="btn btn-danger" onclick="removeInput(this)">Delete</button>
      `;
      inputContainer.appendChild(newInput);
    }


    function removeInput(btn) {
      btn.parentNode.remove();
    }
          </script>  

    <?php 
    
get_dashboard_footer();
 ?>
