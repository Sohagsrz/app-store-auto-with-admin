<?php
$type= "page";
$name= 'Page';
global $title;
$title = 'Add '.$name;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = post_cpt_slug($title,$type);
    $post_id = db()::table('srz_cpt')->insertGetId([
        'post_type' => $type,
        'title' => $title,
        'description' => $content,
        'slug' => $slug,
        'status' => 1,
        'pub_date' => date('Y-m-d H:i:s')
    ]);
    if($post_id){
        $_SESSION['success'] = 'Post added successfully';
        redirect('/dashboard/'.$type.'/edit?id='.$post_id);
    }
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
