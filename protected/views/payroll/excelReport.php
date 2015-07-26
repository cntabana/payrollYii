<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      firstname		</th>
 		<th width="80px">
		      familyname		</th>
 		<th width="80px">
		      middlename		</th>
 		<th width="80px">
		      Payroll_Ref		</th>
 		<th width="80px">
		      Total_Hours_Worked		</th>
 		<th width="80px">
		      Total_Pay		</th>
 		<th width="80px">
		      Work_Date		</th>
 		<th width="80px">
		      id		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->firstname; ?>
		</td>
       		<td>
			<?php echo $row->familyname; ?>
		</td>
       		<td>
			<?php echo $row->middlename; ?>
		</td>
       		<td>
			<?php echo $row->Payroll_Ref; ?>
		</td>
       		<td>
			<?php echo $row->Total_Hours_Worked; ?>
		</td>
       		<td>
			<?php echo $row->Total_Pay; ?>
		</td>
       		<td>
			<?php echo $row->Work_Date; ?>
		</td>
       		<td>
			<?php echo $row->id; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
