<?php

/**
 * This is the model class for table "payroll".
 *
 * The followings are the available columns in table 'payroll':
 * @property string $firstname
 * @property string $familyname
 * @property string $middlename
 * @property string $Payroll_Ref
 * @property integer $Total_Hours_Worked
 * @property double $Total_Pay
 * @property string $Work_Date
 * @property integer $id
 */
class Payroll extends CActiveRecord
{

	public $filename;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payroll';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Total_Hours_Worked', 'numerical', 'integerOnly'=>true),
			array('filename', 'required'),
			//array('filename', 'file','types'=>'csv', 'allowEmpty'=>true),
			array('Total_Pay', 'numerical'),
			array('firstname, familyname, middlename', 'length', 'max'=>20),
			array('Payroll_Ref, Work_Date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('firstname, familyname, middlename, Payroll_Ref, Total_Hours_Worked, Total_Pay, id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'firstname' => 'Firstname',
			'familyname' => 'Familyname',
			'middlename' => 'Middlename',
			'Payroll_Ref' => 'Payroll Ref',
			'Total_Hours_Worked' => 'Total Hours Worked',
			'Total_Pay' => 'Total Pay',
			'Work_Date' => 'Work Date',
			'id' => 'ID',
		);
	}

	public function getWorkDateNew(){
        
        $new = date('dS F Y',$this->Work_Date);
		return $new ;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('Payroll_Ref',$this->Payroll_Ref,true);
		$criteria->compare('Total_Hours_Worked',$this->Total_Hours_Worked);
		$criteria->compare('Total_Pay',$this->Total_Pay);
		$criteria->compare('Work_Date',$this->Work_Date,true);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Payroll the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
