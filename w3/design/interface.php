<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<!--BOOTSTRAP -->
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../style/default.css" />
<script type="text/javascript" src="../style/bootstrap/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../style/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
<script language="javascript">
   $(function() {
      // Setup drop down menu
      $('.dropdown-toggle').dropdown();
     
      // Fix input element click problem
      $('.dropdown input, .dropdown label').click(function(e) {
        e.stopPropagation();
      });
    });
</script>
</head>
<body >
    <!-- HEADER -->
   		<!-- HEADER -->
     <div class=" container">
  <div class="row">
    <div class="span12">
        <ul class="nav nav-tabs nav-pills">
              <li class="active" style="padding-right:22px">
                  <a href="#"><font face="Trebuchet MS, Arial, Helvetica, sans-serif" size="+2">Water Seven</font></a>
                </li>
                <li class="na nav-tabs">
                	<a href="#"><font face="Comic Sans MS, cursive" size="+2">Home</font></a>
                </li>  
                  <ul class="nav nav-pills">
               		<li class=" dropdown">
                		<a class="dropdown-toggle" data-toggle = "dropdown" href="#"><font face="Comic Sans MS, cursive" size="+2">Category<b class="caret"></b></font></a>
                			<ul class="dropdown-menu">
                        
                	</li>   
                  </ul>
                <li class="na nav-tabs">
                	<a href="#"><font face="Comic Sans MS, cursive" size="+2">Tutorial</font></a>
                </li>   
                <li class="na nav-tabs" style="padding-left:10px">
                	<a href="#"><font face="Comic Sans MS, cursive" size="+2">Profil Me</font></a>
                </li>   
        		<li class="divider-vertical">
                <li class="dropdown pull-right">               
                  <a class="dropdown-toggle" data-toggle="dropdown" href=""><font face="MS Serif, New York, serif" size="+1">Have an Account ? Login 
                  <strong class="caret"></strong></font></a>
                 <div class="dropdown-menu" style="padding:20px; padding-bottom:0px;">
                         <form action="" method="post" accept-charset="UTF-8">
                            <div class="input-prepend">
                                Username Or Email
                              <input style="margin-bottom:0px;" type="text" placeholder="Username" size="30"/>
                           </div>
                           <div class="input-prepend">
                              Password
                              <input style="margin-bottom:0px;" type="password" placeholder="Password" />
                           </div> 
                             <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
                             <label class="string optional" for="user_remember_me"> Remember me</label>
                             <input class="btn btn-primary"  type="submit" name="commit" value="Sign In" />
             
                       	</form>
              
                 </div>      
                   
                
                 </li>
                 </li>
                 </ul>
            </ul>
    </div>
  </div>
</div>

    <!-- Wrap -->   
    <!-- Wrap -->    
</body>
</html>