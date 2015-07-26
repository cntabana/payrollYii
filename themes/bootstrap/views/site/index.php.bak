<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
        'options'=>array(
            'chart'=> array('type'=>'column','width'=>1000),
		    'tooltip'=>array ('valueSuffix'=> ' persons'), 
			'legend'=>array('borderWidth'=> 1),
            'credits'=>array('enabled'=>false),
            'title' => array('text'=>'Picture of Ziontemple '),
            'legend'=> array('enabled'=>false),
            'plotOptions'=>array('pie'=>array('dataLabels'=>array('enabled'=>true),'showInLegend'=> true, 'allowPointSelect'=> true,                    'cursor'=> 'pointer')),
             'xAxis' => array('categories'=>$family),
            'yAxis' => array('title'=>array('text'=>'Number')),
            'series' => array(array('name' => 'Counts', 'data' => $num),
        ))
     ));
?>



