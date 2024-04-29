<?php
$type= "settings";
$name= 'Settings';
global $title;
$title = $name;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
      foreach ($_POST as $key => $value) {
        update_option($key,$value);
      }
        if(isset($_FILES['logo_file'])){ 

            
            $upload = new \Delight\FileUpload\FileUpload();
            $upload->withTargetDirectory(app_dir.'/assets/uploads');
            $upload->from('logo_file');
            $upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png' ]);
        
            try {
                $uploadedFile = $upload->save();
                update_option('logo','/assets/uploads/'.$uploadedFile->getFilenameWithExtension()); 
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


        $_SESSION['success'] = 'Settings updated successfully';
      redirect('/dashboard/'.$type);

}
  
 


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
                <h5 class="mb-0">Settings</h5>
                 
            </div>
            </div>
            <?php 
        if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        ?>
        <div class="card shadow border-0 mb-7 add-container">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="sitename" class="form-label">Sitename</label>
                        <input type="text" name="sitename" value="<?php echo htmlspecialchars(get_option('sitename',''));?>" class="form-control" id="sitename"  >
                    </div>
                    
                    <div class="mb-3">
                        <label for="siteurl" class="form-label">Site Url</label>
                        <input type="text" name="siteurl" value="<?php echo htmlspecialchars(get_option('siteurl',$_ENV['siteurl']));?>" class="form-control" id="siteurl"  >
                    </div>


                    <div class="mb-3">
                        <label for="sitename" class="form-label">Site slogan</label>
                        <input type="text" name="siteDescription" value="<?php echo htmlspecialchars(get_option('siteDescription',''));?>" class="form-control" id="slogan"  >
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description"  required><?php echo htmlspecialchars(get_option('description',''));?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="posts_per_page" class="form-label">Posts Per Page</label>
                        <input type="number" name="posts_per_page" value="<?php echo htmlspecialchars(get_option('posts_per_page',$_ENV['per_page']));?>" class="form-control" id="posts_per_page"  >
                    </div>


                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keywords</label>
                        <input type="text" name="keywords" value="<?php echo htmlspecialchars(get_option('keywords',''));?>" class="form-control" id="keywords" >
                    </div>
                   
                    

                    

                    <div class="mb-3">
                        <label for="img" class="form-label">Logo Url:</label>
                        <input type="text" name="logo" class="form-control" id="logo"   value="<?php echo htmlspecialchars(get_option('logo',''));?>">
                        <br/>
                        <h5>OR</h5>
                        <input type="file" name="logo_file" class="form-control" id="logo" >
                    </div>



                    <div class="mb-3">
                        <label for="favicon" class="form-label">Favicon URL</label>
                        <input type="url" name="favicon" class="form-control" id="favicon"  >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Site Email</label>
                        <input type="emaurlil" name="email" value="<?php echo htmlspecialchars(get_option('email',''));?>" class="form-control" id="email"  >
                    </div>
                    
                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" name="facebook" value="<?php echo htmlspecialchars(get_option('facebook',''));?>" class="form-control" id="facebook"  >
                    </div>
                    <div class="mb-3">
                        <label for="telegram" class="form-label">Telegram</label>
                        <input type="text" name="telegram" value="<?php echo htmlspecialchars(get_option('telegram',''));?>" class="form-control" id="telegram"  >
                    </div>
                    
                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" name="instagram" value="<?php echo htmlspecialchars(get_option('instagram',''));?>" class="form-control" id="instagram"  >
                    </div>
                    <div class="mb-3">
                        <label for="twitter" class="form-label">Twitter</label>
                        <input type="text" name="twitter" value="<?php echo htmlspecialchars(get_option('twitter',''));?>" class="form-control" id="twitter"  >
                    </div>
                    <div class="mb-3">
                        <label for="youtube" class="form-label">Youtube</label>
                        <input type="text" name="youtube" value="<?php echo htmlspecialchars(get_option('youtube',''));?>" class="form-control" id="youtube"  >
                    </div>

                    



                    <div class="mb-3">
                        <label for="telegram" class="form-label">Header Codes</label>
                        <textarea name="header_codes" class="form-control" id="header_codes"  ><?php echo htmlspecialchars(get_option('header_codes',''));?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="footer_codes" class="form-label">Footer Codes</label>
                        <textarea name="footer_codes" class="form-control" id="footer_codes"  ><?php echo htmlspecialchars(get_option('footer_codes',''));?></textarea>
                    </div>
                      
                  

                    <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%; " >Update</button>
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
          </script>  

    <?php 
    
get_dashboard_footer();
 ?>
