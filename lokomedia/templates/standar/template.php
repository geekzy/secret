<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php include "dina_titel.php"; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "dina_meta1.php"; ?>">
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>">
<meta http-equiv="Copyright" content="lokomedia">
<meta name="author" content="Lukmanul Hakim">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="shortcut icon" href="favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
<link href="<?php echo "$f[folder]/style.css" ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo "$f[folder]/styles/shCore.css" ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo "$f[folder]/styles/shThemeDefault.css" ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo "$f[folder]/scripts/shCore.js" ?>" type="text/javascript"></script>
<script src="<?php echo "$f[folder]/scripts/shBrushPhp.js" ?>" type="text/javascript"></script>

<script type="text/javascript">
SyntaxHighlighter.all();
SyntaxHighlighter.config.clipboardSwf = '<?php echo "$f[folder]/scripts/clipboard.swf" ?>';
</script>

</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
  <div id="container">
  <div id="header">
    <div id="menu">
      <?php include "$f[folder]/topmenu.php"; ?>
    </div>
  </div>
  </div>
  <div id="leftcontent">
    <p>
      <?php include "$f[folder]/kiri.php"; ?>
    </p>
  </div>
  <div id="middlecontent">
    <p>
      <?php include "$f[folder]/tengah.php"; ?>
    </p>
  </div>
  <div id="rightcontent">
    <p>
      <?php include "$f[folder]/kanan.php"; ?>
    </p>
  </div>
  <div id="clearer"></div>
  <div id="footer">Copyright &copy; 2009 by bukulokomedia.com. All Rights Reserved.</div>
</div>
</body>
</html>
