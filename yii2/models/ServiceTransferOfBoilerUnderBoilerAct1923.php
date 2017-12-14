<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%service_transfer_of_boiler_under_boiler_act_1923}}".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $type_of_boiler
 * @property string $boiler_registration_number
 * @property string $owner_name
 * @property string $Tentative_inspection_date
 * @property string $created
 * @property string $updated
 */
class ServiceTransferOfBoilerUnderBoilerAct1923 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_transfer_of_boiler_under_boiler_act_1923}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'type_of_boiler', 'boiler_registration_number', 'owner_name'], 'required'],
            [['project_id'], 'integer'],
            [['Tentative_inspection_date', 'created', 'updated'], 'safe'],
            [['type_of_boiler', 'boiler_registration_number', 'owner_name'], 'string', 'max' => 255],

			
			['Tentative_inspection_date', 'match', 'pattern' => '/^[0-9]{2}[-|\/]{1}[0-9]{2}[-|\/]{1}[0-9]{4}$/'],
			[['Tentative_inspection_date'], 'date', 'format' => 'php:d-m-Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'type_of_boiler' => 'Type Of Boiler',
            'boiler_registration_number' => 'Boiler Registration Number',
            'owner_name' => 'Owner Name',
            'Tentative_inspection_date' => 'Tentative Inspection Date',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

	
	public function beforeSave($insert = true) {
		
		if(isset($this->Tentative_inspection_date)) {
			$this->Tentative_inspection_date = date('Y-m-d', strtotime($this->Tentative_inspection_date)); 
		} 
		return parent::beforeSave($insert);
	}
}
