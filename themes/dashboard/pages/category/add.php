<?php
$type= "category";
$name= 'Category';
global $title;
$title = 'Add '.$name;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = isset($_POST['category'])?$_POST['category']:0 ;
    $slug = make_slug($title);
    $post_id = db()::table('srz_cats')->insertGetId([
        'name' => $title,
        // 'description' => $content,
        'value' => $slug,
        'type' => 'app',
        'parents' => $category,
    ]);
    if($post_id){
        update_field('description',$content,'movies_cat',$post_id);
         
        $_SESSION['success'] = ' added successfully';
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
                        <label for="category" class="form-label">Parent Category:</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="0">Select Category</option>
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
function addInput() {
      var inputContainer = document.getElementById("input-container");
      var newInput = document.createElement("div");
      newInput.classList.add("input-group");
      newInput.innerHTML = `
        <input type="url" name="watch_url[]" class="form-control" required>
        <button type="button" class="btn btn-danger" onclick="removeInput(this)">Delete</button>
      `;
      inputContainer.appendChild(newInput);
    }
    function addDlinput() {
      var inputContainer = document.getElementById("input-container-dl");
      var newInput = document.createElement("div");
      newInput.classList.add("input-group");
      newInput.innerHTML = `
        <input type="url" name="dl_urls[]" class="form-control" required>
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
