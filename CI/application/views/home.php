<html>
<head>
	<title></title>
</head>
<body>
	<p>My Load View</p>

	<?php foreach ($records as $row) : ?>
	<h1><?php echo $row->title; ?></h1>

	<?php endforeach; ?>
</body>
</html>