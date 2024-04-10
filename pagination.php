<?php
	session_start();
	include("DBconnect.php");
	$page_url = "manage-home.php";
	$id = (int)$_SESSION['user_id'];
	$display = 3;

	$sql = "SELECT * FROM `place` WHERE `host_id` = $id;";
	$records = $conn->query($sql);
	$total_rows = $records->rowCount();

	if (isset($_GET['page']) && is_numeric($_GET['page'])) {
		$curr_page = $_GET['page'];
	} else {
		$curr_page =  1;
	}

	$position = (($curr_page - 1) * $display);
	$total_pages = ceil($total_rows / $display);
	$num_links = ceil($total_rows / $display);

	if ($curr_page > $num_links)
		$start = $curr_page - ($num_links - 1);
	else
		$start = 1;

	if (($curr_page + $num_links) < $total_pages)
		$end = $curr_page + $num_links;
	else
		$end = $total_pages;
?>
