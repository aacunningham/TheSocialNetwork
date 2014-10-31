<?php if (!empty($_SESSION['uid'])) : ?>
    <!-- Back Navigtion -->
    <a href="interface.php" target="_self">Home</a>
<?php endif; ?>

<?php
    require_once "../layout/header.php";
	if(!isset($_SESSION['attempts'])) {
		$_SESSION['attempts'] = 0;
	}