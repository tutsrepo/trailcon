<div class="container">
<h2><?php echo $title; ?></h2>
<?php 
	$errors = validation_errors();
	if ($errors)
	{
	?>
		<div class="alert alert-warning"><?=$errors;?></div>
	<?php
	}	
	?>
<?php echo form_open('contest/details/' . $contests['id']); ?>

<div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="input" name="firstname" value="<?php echo $contests['firstname'];?>" class="form-control" placeholder="Enter Firstname"/>
</div>    
<div class="form-group">
    <label for="lastname">LastName</label>
    <input type="input" name="lastname" value="<?php echo $contests['lastname'];?>" class="form-control" placeholder="Enter Lastname"/>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="input" name="email" value="<?php echo $contests['email'];?>" class="form-control" placeholder="Enter Email"/>
</div>
    <input type="hidden" name="update" value="true" />
    <input type="submit" name="submit" value="Save" />
</form>
</div>