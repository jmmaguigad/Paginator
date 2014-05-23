<html lang="en">
<title>Learning to Paginate</title>
<head>
	<style>
		body {
			font-family:arial;
			font-size:12px;
		}
		table {
			border: 1px solid #ccc;
			border-collapse:collapse;
		}
		tr {
			width:200px;
			border:1px solid #ccc;
		}
		td {
			border:1px solid #ccc;
		}
		.paginate {
			padding:5px;
			font-size:15px;
		}
	</style>
</head>
<body>
<?php
/*
 * requiring the core initiator for the files
 * this line could be deleted and just reconfigure the connection method in the paginate.php
 */
require_once 'script/paginate.php';
/*
 * instance of the class paginate started
 */
$page = new Paginate();
/*
 * getting the sql string
 */
$page->getSQL( "SELECT * FROM web_users ORDER BY id" );

/*
 * getting the pager value
 */
$page->getPagerName('jmpager');

/*
 * fetching the result of the sql processed
 */
//echo ($page->getResultProvided());
echo $page->displayUpper();
echo $page->fetchPaginatedData();

echo $page->displayLower();
?>
</body>
</html>
