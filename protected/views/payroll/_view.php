<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('familyname')); ?>:</b>
	<?php echo CHtml::encode($data->familyname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middlename')); ?>:</b>
	<?php echo CHtml::encode($data->middlename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Payroll_Ref')); ?>:</b>
	<?php echo CHtml::encode($data->Payroll_Ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Total_Hours_Worked')); ?>:</b>
	<?php echo CHtml::encode($data->Total_Hours_Worked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Total_Pay')); ?>:</b>
	<?php echo CHtml::encode($data->Total_Pay); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Work_Date')); ?>:</b>
	<?php echo CHtml::encode($data->Work_Date); ?>
	<br />

	*/ ?>

</div>