<div id="payroll-update-modal-container" >

</div>

<script type="text/javascript">
function update()
 {
  
   var data=$("#payroll-update-form").serialize();

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("payroll/update"); ?>',
   data:data,
success:function(data){
                if(data!="false")
                 {
                  $('#payroll-update-modal').modal('hide');
                  renderView(data);
                  $.fn.yiiGridView.update('payroll-grid', {
                     
                         });
                 }
                 
              },
   error: function(data) { // if error occured
          alert(JSON.stringify(data)); 

    },

  dataType:'html'
  });

}

function renderUpdateForm(id)
{
 
   $('#payroll-view-modal').modal('hide');
 var data="id="+id;

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("payroll/update"); ?>',
   data:data,
success:function(data){
                 // alert("succes:"+data); 
                 $('#payroll-update-modal-container').html(data); 
                 $('#payroll-update-modal').modal('show');
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}
</script>
