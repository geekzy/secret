<html>
<head>
	<title>Home</title>
</head>
<body>
<p>My view Has been Loaded</p>

	<?php foreach ($baris as $row) : ?>
	<h1><?php echo $row->title; ?></h1>
	<div class="container"><?php echo $row->contents; ?></div>
<?php endforeach; ?>
</body>
</html>