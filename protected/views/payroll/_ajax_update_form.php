    <div id='payroll-update-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
   
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Update payroll #<?php echo $model->id; ?></h3>
    </div>
    
    <div class="modal-body">
 
    
    
    <div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'payroll-update-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("payroll/update"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ update(); } " /* Do ajax call when user presses enter key */
                            ),               
	
)); ?>
     	<fieldset>
		<legend>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
		</legend>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
			<?php echo $form->hiddenField($model,'id',array()); ?>
			
	               				  <div class="row">
					  <?php echo $form->labelEx($model,'firstname'); ?>
					  <?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20)); ?>
					  <?php echo $form->error($model,'firstname'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'familyname'); ?>
					  <?php echo $form->textField($model,'familyname',array('size'=>20,'maxlength'=>20)); ?>
					  <?php echo $form->error($model,'familyname'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'middlename'); ?>
					  <?php echo $form->textField($model,'middlename',array('size'=>20,'maxlength'=>20)); ?>
					  <?php echo $form->error($model,'middlename'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'Payroll_Ref'); ?>
					  <?php echo $form->textArea($model,'Payroll_Ref',array('rows'=>6, 'cols'=>50)); ?>
					  <?php echo $form->error($model,'Payroll_Ref'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'Total_Hours_Worked'); ?>
					  <?php echo $form->textField($model,'Total_Hours_Worked'); ?>
					  <?php echo $form->error($model,'Total_Hours_Worked'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'Total_Pay'); ?>
					  <?php echo $form->textField($model,'Total_Pay'); ?>
					  <?php echo $form->error($model,'Total_Pay'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'Work_Date'); ?>
					  <?php echo $form->textField($model,'Work_Date'); ?>
					  <?php echo $form->error($model,'Work_Date'); ?>
				  </div>

			  
                        </div>   
  </div>

  </div><!--end modal body-->
  
  <div class="modal-footer">
	<div class="form-actions">

	                
		<?php		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'id'=>'sub2',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'htmlOptions'=>array('onclick'=>'update();'),
		));
		
		?>
             
	</div> 
   </div><!--end modal footer-->	
</fieldset>

<?php $this->endWidget(); ?>

</div>


</div><!--end modal-->



