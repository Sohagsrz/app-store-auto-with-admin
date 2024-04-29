<?php
$type= "app";
$name= 'App';
global $title;
$title = 'Add '.$name;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $img = $_POST['img_url']; 
    $category = $_POST['category'];
    $slug = make_slug($title);
    $post_id = db()::table('srz_cpt')->insertGetId([
        'post_type' => $type,
        'title' => $title,
        'description' => $content,
        'slug' => $slug,
        'status' => 1,
        'pub_date' => date('Y-m-d H:i:s')
    ]);
    if($post_id){
        
        if($img){
            update_field('img',$img,$type,$post_id);
        }
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

         
        foreach($category as $cat){
            db()::table('cat_post_realtion')->updateOrInsert([
                'post_id' => $post_id,
                'cat_id' => $cat,
                'type' => $type
            ]);
        }
        
        
        $_SESSION['success'] = 'Post added successfully';
        redirect('/dashboard/'.$type.'/edit?id='.$post_id);
    }
}
  
$categories= db()::table('srz_cats')->where([
    'type' =>'app'
    ])->orderBy('name','asc')->get();


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
                <h5 class="mb-0">Add <?php echo $name;?></h5>
                 
            </div>
            </div>

        <div class="card shadow border-0 mb-7 add-container">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="title"  required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" name="content" id="content"  rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="img_url" class="form-label">Image Url:</label>
                        <input type="text" name="img_url" class="form-control" id="img_url" >
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
                            <option value="<?php echo $category->ID;?>"><?php echo $category->name;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%; " >Add <?php echo $name;?></button>
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

function addGalleryInput() {
    var inputContainer = document.getElementById("input-container-gallery");
    var newInput = document.createElement("div");
    newInput.classList.add("input-group");
    newInput.innerHTML = `
        <input type="file" name="gallery[]" class="form-control">
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
