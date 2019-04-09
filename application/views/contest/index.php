<div class="container">
  <h2><?php echo $title; ?></h2>

      <a href="<?php echo site_url($lang . $add_link); ?>" class="btn btn-info" role="button">Add New Contest</a>

<?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
    <?php } ?>

<?php if (!$contests) { ?>
        <div align="center">No Records Found </div>
    <?php } else { ?>

  <table class="table table-hover">
    <thead>
      <tr>
        <th><?php echo $contest_firstname;?></th>
        <th><?php echo $contest_lastname;?></th>
        <th><?php echo $contest_email;?></th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach ($contests as $contest_item): ?>
      <tr>
        <td><?php echo $contest_item['firstname']; ?></td>
        <td><?php echo $contest_item['lastname']; ?></td>
        <td><?php echo $contest_item['email']; ?></td>
		<td><a href="<?php echo site_url($lang . '/contest/details/'.$contest_item['id']); ?>" class="btn btn-warning" role="button">Edit Contest</a></td>
        
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
    <?php } ?>  
</div>