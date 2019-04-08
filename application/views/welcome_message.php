<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="container">
	<div id="body">
		<ul class="list-group">
		<?php
			foreach($arr as $key => $val)
            {
        ?>
        	<li class="list-group-item"><?php echo $val; ?></li>
		<?php
			}
        ?>
        </ul>        		    		
	</div>
</body>
</html>