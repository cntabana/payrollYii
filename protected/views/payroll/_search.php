<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-payroll-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>


	<?php echo $form->textFieldRow($model,'firstname',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'familyname',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'middlename',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textAreaRow($model,'Payroll_Ref',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'Total_Hours_Worked',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Total_Pay',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Work_Date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Search')); ?>
               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
	</div>

<?php $this->endWidget(); ?>


<?php $cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap/jquery-ui.css');
?>	
   <script>
	$(".btnreset").click(function(){
		$(":input","#search-payroll-form").each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		if (type == "text" || type == "password" || tag == "textarea") this.value = "";
		else if (type == "checkbox" || type == "radio") this.checked = false;
		else if (tag == "select") this.selectedIndex = "";
	  });
	});
   </script>

