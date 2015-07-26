
    <div id='payroll-upload-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Upload CSV</h3>
    </div>
    
    <div class="modal-body">
    
    <div class="form">

   <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
   'id'=>'payroll-upload-csv',
    'action'=>array("payroll/upload"),
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

   <div class="control-group">		
			<div class="span4">
			
							  <div class="row">
					  <?php //echo $form->labelEx($model,'firstname'); ?>
					  <?php echo $form->fileField($model,'filename'); ?>
					  <?php echo $form->error($model,'filename'); ?>
				  </div>

			  		


			  
                        </div>   
  </div>

  </div><!--end modal body-->
  
  <div class="modal-footer">
	<div class="form-actions">

		<?php
		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)
			
		);
		
		?>

	</div> 
   </div><!--end modal footer-->	
</fieldset>

<?php
 $this->endWidget(); ?>

</div>

</div><!--end modal-->

<script type="text/javascript">
function upload()
 {

   var data=$("#payroll-upload-csv").serialize();
     


  jQuery.ajax({
   type: 'POST',
    url: '<?php
 echo Yii::app()->createAbsoluteUrl("payroll/upload"); ?>',
   data:data,
success:function(data){
                alert("succes:"+data); 
                if(data!="false")
                 {
                  $('#payroll-upload-modal').modal('hide');
                  renderView(data);
                    $.fn.yiiGridView.update('payroll-grid', {
                     
                         });
                   
                 }
                 
              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         alert(data);
    },

  dataType:'html'
  });

}

function renderUploadCSV()
{
    
  $('#payroll-view-modal').modal('hide');
  
  $('#payroll-upload-modal').modal({
   show:true,
   
  });
}

</script>
