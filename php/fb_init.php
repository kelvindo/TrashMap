<?php
	require_once('facebook.php');

 	$config = array();
  	$config[‘appId’] = '375003062578548';
  	$config[‘secret’] = 'd87a98e1243081c18708f47f81237bac';
  	$config[‘fileUpload’] = false; // optional

  	$facebook = new Facebook($config);

	$facebook = new Facebook(array(
  		'appId'  => '375003062578548',
  		'secret' => 'd87a98e1243081c18708f47f81237bac',
	));
?>