<?php
session_start();	
	include '../config/koneksi.php';include 'Admin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add News</title>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../style/default.css"/>
	<script type="text/javascript" src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
		<br> 
			<br> 
			<br>
			<br>
	<div class="container">
			<div class="row">
				<div class="span12">
					<form class="form-horizontal well" method="POST" action="" id="registerHere">
						<fieldset>
							<legend>Add News</legend>
							<blockquote>
								<p><small>* Pastikan anda menulis dengan benar</small></p>
							</blockquote>
							<div class="control-group">
								<label class="control-label" for="input01">Judul Berita</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-th"></strong></span>
										<input type="text" class="input-xlarge" id="judul" name="judul" rel="popover" data-content="Enter Your Judul Berita". data-original-title="Judul berita" placeholder="input your Judul Berita..">
									</div>
								</div>
							</div>							
							<div class="control-group">
								<label class="control-label" for="input01">Kategori</label>
								<div class="controls">
									<div class="input-prepend">	
									<?php		
									echo "																																																																	
												<select class='span2' name='kategori'>
													<option>- Pilih Kategori -</option>		";												
													$sql = mysql_query("SELECT * FROM kategori ORDER BY idkategori ");
													while ($data=mysql_fetch_array($sql)) {
									echo "			 <option value=$data[idkategori]>$data[namakategori]</option>";
												}
												?>
												</select>
													
																								
									
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Isi Berita</label>
								<div class="controls">
									<div class="input-prepend">											
										<textarea class="span6"rows="10"></textarea>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Gambar</label>
								<div class="controls controls-row">
									<div class="input-prepend">
										
										<input type="file" class="input-large s" id="gambar" name="photo" rel="popover" placeholder="input picture.."/ >
									</div>
								</div>
							</div>							
							<div class="control-group">
								<label class="control-label"></label>
								<div class="controls">
									<button type="submit" class="btn btn-success">Save</button> <button type="reset" class="btn btn-success"> Cancel</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
</body>
</html>