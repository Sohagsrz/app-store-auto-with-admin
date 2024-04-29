<?php
$type= "app";
$name= 'App';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = db()::table('srz_cats')->where('ID',$id)->first();
    if(!$category){
        redirect('/dashboard/'.$type);
    }
    db()::table('srz_cats')->where('ID',$id)->delete();
    db()::table('srz_fields')->where('obj_id',$id)->where('type','movies_cat')->delete();
    db()::table('cat_post_realtion')->where('cat_id',$id)->where('type',$type)->delete();
    $_SESSION['success'] = $name.' deleted successfully';
    redirect('/dashboard/'.$type);
}