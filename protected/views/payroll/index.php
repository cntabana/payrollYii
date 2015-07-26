<?php
$this->breadcrumbs=array(
	'Payrolls',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('payroll-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1>Payrolls</h1>
<hr />

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>'javascript:void(0);','linkOptions'=>array('onclick'=>'renderCreateForm()')),
        array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Import from csv', 'icon'=>'icon-download', 'url'=>'javascript:void(0);','linkOptions'=>array('onclick'=>'renderUploadCSV()')),
		array('label'=>'Export to PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Export to Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payroll-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'filter' => $model,
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		'firstname',
		'familyname',
		'middlename',
		'Payroll_Ref',
		'Total_Hours_Worked',
		'Total_Pay',		
		'workDateNew',
		//'id',
		
               array(
		     
		      'type'=>'raw',
		       'value'=>'"
		      <a href=\'javascript:void(0);\' onclick=\'renderView(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'renderUpdateForm(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-pencil\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'delete_record(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'icon-trash\'></i></a>
		     "',
		      'htmlOptions'=>array('style'=>'width:150px;')  
		     ),
        
	),
)); 


 $this->renderPartial("_ajax_update");
 $this->renderPartial("_ajax_create_form",array("model"=>$model));
  $this->renderPartial("_ajax_upload_csv",array("model"=>$model));
 $this->renderPartial("_ajax_view");
 ?>

 
<script type="text/javascript"> 
function delete_record(id)
{
 
  if(!confirm("Are you sure you want delete this?"))
   return;
   
 //  $('#ajaxtest-view-modal').modal('hide');
 
 var data="id="+id;
 

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("payroll/delete"); ?>',
   data:data,
success:function(data){
                 if(data=="true")
                  {
                     $('#payroll-view-modal').modal('hide');
                     $.fn.yiiGridView.update('payroll-grid', {
                     
                         });
                 
                  } 
                 else
                   alert("deletion failed");
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
       //  alert(data);
    },

  dataType:'html'
  });

}
</script>

<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
 

