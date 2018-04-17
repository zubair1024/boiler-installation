<?php include "header.php"; ?>
<?php 
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	if(!array_key_exists(session_id(), $_SESSION) || !array_key_exists('product_id',$_SESSION[session_id()])){
		print 'Page not found';
		return;	
	}
?>	

<?php include "footer.php"; ?>