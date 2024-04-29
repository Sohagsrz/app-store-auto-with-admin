<?php
$type= "page";
$name= 'Page';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post = db()::table('srz_cpt')->where('id',$id)->first();
    if(!$post){
        redirect('/dashboard/'.$type);
    }
    db()::table('srz_cpt')->where('id',$id)->delete();
    db()::table('srz_fields')->where('obj_id',$id)->where('type',$type)->delete();
    db()::table('cat_post_realtion')->where('post_id',$id)->where('type',$type)->delete();
    $_SESSION['success'] = $name.' deleted successfully';
    redirect('/dashboard/'.$type);
}