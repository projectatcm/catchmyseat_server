<?php 
session_start();
?>
<script>
	<?php if (empty($_SESSION['CMS_ADMIN'])): ?>
	alert("Login required ! Please login to continue");
	window.location = 'index.php';
<?php endif;?>
</script>