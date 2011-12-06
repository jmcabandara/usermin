<div class="umusers form">
<?php echo $this->Form->create('Umuser');?>
	<fieldset>
		<legend><?php echo __('Add Umuser'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('umrole_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Umusers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Umroles'), array('controller' => 'umroles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Umrole'), array('controller' => 'umroles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Umpermissions'), array('controller' => 'umpermissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Umpermission'), array('controller' => 'umpermissions', 'action' => 'add')); ?> </li>
	</ul>
</div>