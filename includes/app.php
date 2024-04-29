<?php
require 'functions.php';


global $nonceUtil,$title,$current,$gplay;
//env load
$dotenv = Dotenv\Dotenv::createImmutable(app_dir);
$dotenv->safeLoad();
 
$gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');

$cache = new \Symfony\Component\Cache\Psr16Cache(
    new \Symfony\Component\Cache\Adapter\FilesystemAdapter()
);
$gplay->setCache($cache, \DateInterval::createFromDateString('6 months'));
$gplay->setCacheTtl(\DateInterval::createFromDateString('6 months'));


//connect db
require 'database.php';

$router = new AltoRouter();
$router->addMatchTypes([
	'pack' => '[^/]++',
  ]);


$router->map('GET|POST','/', function(){ 

	include app_dir.'/themes/index.php';
},'home');

$router->map('GET|POST','/page/app', function(){ 

	include app_dir.'/themes/allApp.php';
},'allApps');

$_ENV['per_page'] = get_option('posts_per_page',$_ENV['per_page']);

$router->map('GET|POST','/category/[pack:slug]', function($slug){

	$slug = urldecode($slug);

	global $categories,$gplay,$title;
	
	try{

		$apps = $gplay->getListApps(
			strtoupper($slug),
			null, 
			100
		);
 
		}catch(Exception $e){
				redirect('404');
				exit();
		}

		$title = $slug = str_replace('_',' ', ucfirst($slug));
	include app_dir.'/themes/category.php';
},'category');



$router->map('GET|POST','/search', function(){
	global $title;
	$q = isset($_GET['q']) ? $_GET['q']:'';
	
	$title = "Search Results for ". htmlspecialchars($q);
	include app_dir.'/themes/search.php';
},'search');

$router->map('GET|POST','/dashboard/login', function(){
	
	if(auth()->isLoggedIn()){
		redirect('/dashboard');
		return;
}
	include app_dir.'/themes/dashboard/login.php';
});

	
 
if(auth()->isLoggedIn()){
	
	$router->map('GET|POST','/dashboard', function(){
		include app_dir.'/themes/dashboard/index.php';
	},'dashboard');

	$router->map('GET|POST','/dashboard/[*:slug]', function($slug){
		$dir = app_dir.'/themes/dashboard/pages/'.$slug.'';
		$file = app_dir.'/themes/dashboard/pages/'.$slug.'.php';
		if(file_exists($dir) && is_dir($dir) ){
			include $dir.'/index.php';
			return;
		}else if(file_exists($file) && is_file($file)){
			include $file;
			return;
		} 

		redirect('/404');
	},'dashboard_pages');


		 
	$router->map('GET|POST','/logout', function(){
		
		auth()->logOut();
		redirect('/');
	});

}



$router->map('GET|POST','/[pack:slug]', function($slug){
	$slug = urldecode($slug);
	 

	global $title,$app,$gplay;
	try{

	$app = $gplay->getAppInfo($slug);
	}catch(Exception $e){
			redirect('404');
			exit();
	}
 
		$title = $app->getName(); 
	include app_dir.'/themes/single.php';
},'single');


$match = $router->match();
$current= $match['name'];

if (is_array($match) && is_callable($match['target'])) {
	call_user_func_array($match['target'], $match['params']);
} else {
	// no route was matched
	http_response_code(404);
	include app_dir.'/themes/404.php';
}
