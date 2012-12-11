<?php
session_start();
include "../config/koneksi.php";

#### Bagian Module Home ####
if ($_GET[module]=='home')
	{ echo "<div class='hero-unit'><h2 class=text-error>Welcome In Dashboard</h2><hr>
		<blockquote><p class='text-info'>Hai <b>$_SESSION[level]</b>, Untuk memulai silahkan klik menu pilihan yang berada
		di Atas untuk mengelola content website.</p> ";
		// membuat baris baru yg kosong <p>&nbsp;</p> <p>&nbsp;</p>
		echo "<p class='text-success pull-right'><small>Login Hari ini: "; 
		echo (date("Y-m-d")); echo " | "; echo date("H:i:s a");
		echo "</small></p></blockquote></div>";




			########################################
			####	Bagian Module Management	####
			########################################


}elseif ($_GET[module]=='user') {
?>
<div class="container">
		<div class="row">
			<div class="span12">
				<form action="" class="form-horizontal">
					<legend><h3>User Management</h3></legend>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="span7">
				<fieldset>
					<form action="" class="form-stacked well">
						<input type="text" placeholder="Input Your ID ...">&nbsp;&nbsp;<a href ="###"class="btn"><i class="icon-search"></i> Search</a>&nbsp;&nbsp;<a href="?act=tambahuser" class="btn btn-primary"><i class="icon-user icon-white"></i> Add New User</a>
					</form>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<fieldset>
					<table class="table table-bordered table-condensed table-striped">
						<thead>
							<tr>
								<th><center>Username</center></th>
								<th><center>Nama Lengkap</center></th>
								<th><center>Email</center></th>
								<th><center>Level</center></th>
								<th><center>Blokir</center></th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<?php
							include "../config/koneksi.php";
							$tampil = mysql_query("SELECT * FROM user ORDER BY username");
							// $data= 0;
							while ($hasil = mysql_fetch_array($tampil)) { ?>
							<tbody>
								<tr>
									<td><center><?php echo "$hasil[username]"; ?></center></td>
									<td><?php echo "$hasil[namalengkap]"; ?></td>
									<td><?php echo "<a href = mailto:$hasil[email]>$hasil[email]</a>"; ?></td>
									<td><center><?php echo "$hasil[level]"; ?></center></td>
									<td><center><?php echo "$hasil[blokir]"; ?></center></td>
									<td><center><?php echo "<a href=?act=edituser&username=$hasil[username]>Edit</a>"; ?> || <?php echo "<a href=act.php?module=user&act=hapus&username=$hasil[username] onclick=confirmDelete()>Delete</a>"; ?></center></td>
								</tr>
							</tbody>
							<?php
							// $data++;
						}
							?>
									
					</table>
				</fieldset>
			</div>
		</div>
	</div>
	<?php

	#### Bagian Add User #####
		} elseif ($_GET[act]=='tambahuser') {
	?>
	<div class="row">
				<div class="span12">
					<form class="form-horizontal well" method="POST" action="act.php?module=user&act=input" id="registerHere">
						<fieldset>
							<legend>Add User</legend>						
							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-user"></strong></span>
										<input type="text" class="input-large" id="username" rel="popover" value="<?=@$_REQUEST['username']?>" name="username" data-content="Enter Your Username". data-original-title="Username" placeholder="input username..">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-lock"></strong></span>
										<input type="password" class="input-large" id="password" rel="popover" name="password" data-content="Enter Your Password". data-original-title="passworrd" placeholder="input your password..">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password2">Ulangi Password</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-lock"></strong></span>
										<input type="password" class="input-large" id="password2" rel="popover" name="password2" data-content="Re Enter Your Password". data-original-title="passworrd" placeholder="re-input your password..">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="namalengkap">Nama Lengkap</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-star"></strong></span>
										<input type="text" class="input-large" id="namalengkap" name="namalengkap" rel="popover" data-content="Enter Your Nama Lengkap". data-original-title="Nama_Lengkap" placeholder="input your name..">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-envelope"></strong></span>
										<input type="text" class="input-large" id="email" name="email" rel="popover" data-content="Enter Your Email Address". data-original-title="Email" placeholder="input your email addres..">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="telp">No Telp.</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-envelope"></strong></span>
										<input type="text" class="input-large" id="telp" name="telp" rel="popover" data-content="Enter Your No Telp". data-original-title="telp" placeholder="input your telephone.." value="<?= $r['no_telp']?>">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"></label>
								<div class="controls">
									<button type="submit" class="btn btn-success">Save</button> <button type="reset" class="btn btn-success" onclick="window.history.back()"> Cancel</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>

			<?php

			#### Bagian Edit User ####
				}elseif ($_GET[act]=='edituser') {
					$edit = mysql_query("SELECT * from user where username='$_GET[username]'");
					$r = mysql_fetch_array($edit);
			?>
			<div class="row">
				<div class="span12">
					<form class="form-horizontal well" method="POST" action="act.php?module=user&act=update" id="registerHere">						
						<fieldset>
							<legend>Edit User</legend>
							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-user"></strong></span>
										<input type="text" class="input-large" id="username" rel="popover" value="<?= $r['username']?>" name="username" data-content="Enter Your Username". data-original-title="Username" placeholder="input username..">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class=""></strong></span>
										<input type="password" class="input-large" id="password" rel="popover" name="password" data-content="Enter Your Password". data-original-title="passworrd" placeholder="input your password.." value="<?= $r['password']?>">
										<span id="validateUsername"><?php if ($error) { echo $error['msg']; } ?></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="namalengkap">Nama Lengkap</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-star"></strong></span>
										<input type="text" class="input-large" id="namalengkap" name="namalengkap" rel="popover" data-content="Enter Your Nama Lengkap". data-original-title="Nama_Lengkap" placeholder="input your name.." value="<?= $r['namalengkap']?>">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-envelope"></strong></span>
										<input type="text" class="input-large" id="email" name="email" rel="popover" data-content="Enter Your Email Address". data-original-title="Email" placeholder="input your email addres.." value="<?= $r['email']?>">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="telp">No Telp.</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><strong class="icon-envelope"></strong></span>
										<input type="text" class="input-large" id="telp" name="telp" rel="popover" data-content="Enter Your No Telp". data-original-title="telp" placeholder="input your telephone.." value="<?= $r['no_telp']?>">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="blokir" class="control-label">Blokir</label>
								<div class="controls">									
								    <input type="radio" name="blokir" checked="checked" value="Y"> Y
									<input type="radio" name="blokir" checked="checked" value="N"> N
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"></label>
								<div class="controls">
									<button type="submit" class="btn btn-success">Edit</button> <button type="reset" class="btn btn-success" onclick="window.history.back()"> Cancel</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<?php


			########################################
			####	Bagian Module Management	####
			########################################	
				} 
				elseif($_GET[module]=='modull')
				{
			?>
			<div class="container">
			<div class="row">
				<div class="span12">
					<form action="" class="form-horizontal">
						<legend><h3>Module Management</h3></legend>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="span7">
					<fieldset>
						<form action="" class="form-stacked well">
							<input type="text" placeholder="Input Your Module Name ..">&nbsp;&nbsp;<a href ="###"class="btn"><i class="icon-search"></i> Search</a>&nbsp;&nbsp;<a href="?act1=tambahmodule" class="btn btn-primary"><i class="icon-user icon-white"></i> Add Module</a>
						</form>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<fieldset>
						<table class="table table-bordered table-condensed table-hover">

							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Nama Module</center></th>
									<th><center>Link</center></th>
									<th><center>Publish</center></th>
									<th><center>Status</center></th>
									<th><center>Urutan</center></th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<?php
								include "../config/koneksi.php";
								$tampil = mysql_query("SELECT * FROM modul ORDER BY id_modul");								
								while ($hasil = mysql_fetch_array($tampil)) { ?>
								<tbody>
									<tr>
										<td><center><?php echo "$hasil[id_modul]"; ?></center></td>
										<td><?php echo "$hasil[nama_modul]"; ?></td>
										<td><?php echo "$hasil[link]</a>"; ?></td>
										<td><center><?php echo "$hasil[publish]"; ?></center></td>
										<td><center><?php echo "$hasil[status]"; ?></center></td>
										<td><center><?php echo "$hasil[urutan]"; ?></center></td>
										<td><center><?php echo "<a href=?act1=editmodule&nama_modul=$hasil[nama_modul]>Edit</a>"; ?> || <?php echo "<a href=act.php?module=modull&act1=delete&nama_modul=$hasil[nama_modul] onclick=confirmDelete()>Delete</a>"; ?></center></td>
									</tr>
								</tbody>
								<?php				
							}
								?>
										
						</table>
					</fieldset>
				</div>
			</div>
		</div>
		<?php 

		#### Bagian Add Module ####
			} elseif ($_GET[act1]=='tambahmodule') {
		?>
		<div class="row">
			<div class="span7 offset2">
				<form class="form-horizontal well" method="POST" action="act.php?module=modull&act1=addmodule">
					<fieldset>
						<legend>Add Module</legend>
						<div class="control-group">
							<label for="namamodul" class="control-label">Nama Module</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><strong class="icon"></strong></span>
									<input type="text" class="input-large" id="namamodul" rel="popover" name="namamodul" data-content="Enter Your Module Name". data-original-title="addmodule" placeholder="Input Your Module Name ..">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="link" class="control-label">Link</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><strong class="icon"></strong></span>
									<input type="text" class="input-large" id="link" rel="popover" name="link" data-content="Enter Your link module". data-original-title="link" placeholder="Input Your Link ..">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="publish" class="control-label">Publish</label>
							<div class="controls">								
									<select class="success" name="publish">
                               	    <option>-- Pilih --</option>
                                	<option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
							</div>
						</div>
                        <div class="control-group">
							<label for="status" class="control-label">Status</label>
							<div class="controls">								
								<select class="success" name="status">
                               	    <option>-- Pilih --</option>
                                	<option>Admin</option>
                                    <option>User</option>
                                </select>
							</div>
						</div>
						<div class="control-group">
							<label for="urutan" class="control-label">Urutan</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><strong class="icon"></strong></span>
									<input type="text" class="input-small" id="urutan" rel="popover" name="urutan" data-content="Enter Your urutan module". data-original-title="urutan" placeholder="Input Your Urutan ..">
								</div>
							</div>
						</div>
                        <div class="controls">																	
									<input type="submit" id="save" rel="popover" name="save" class="btn btn-primary" value="Save"> <input type="button" id="cancel" rel="popover" name="cancel" class="btn btn-primary" value="cancel" onclick="window.history.back()">					
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<?php
			}

			#### Bagian Edit Module ####
			elseif ($_GET[act1]== 'editmodule') {
			?>
			<div class="row">
			<div class="span7 offset2">
				<form class="form-horizontal well" method="POST" action="act.php?module=modull&act1=ubahmodule">
					<fieldset>
						<legend>Add Module</legend>
						<div class="control-group">
							<label for="addmodule" class="control-label">Nama Module</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><strong class="icon"></strong></span>
									<input type="text" class="input-large" id="addmodule" rel="popover" name="addmodule" data-content="Enter Your Module Name". data-original-title="addmodule" placeholder="Input Your Module Name ..">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="link" class="control-label">Link</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><strong class="icon"></strong></span>
									<input type="text" class="input-large" id="link" rel="popover" name="link" data-content="Enter Your link module". data-original-title="link" placeholder="Input Your Link ..">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="publish" class="control-label">Publish</label>
							<div class="controls">								
									<select class="success">
                               	    <option>-- Pilih --</option>
                                	<option>Yes</option>
                                    <option>No</option>
                                </select>
							</div>
						</div>
                        <div class="control-group">
							<label for="status" class="control-label">Status</label>
							<div class="controls">								
								<select class="success">
                               	    <option>-- Pilih --</option>
                                	<option>Admin</option>
                                    <option>User</option>
                                </select>
							</div>
						</div>
                        <div class="controls">																	
								<input type="submit" id="save" rel="popover" name="save" class="btn btn-primary" value="Save"> <input type="button" id="cancel" rel="popover" name="cancel" class="btn btn-primary" value="cancel" onclick="window.history.back()">					
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<?php	
			}
		?>