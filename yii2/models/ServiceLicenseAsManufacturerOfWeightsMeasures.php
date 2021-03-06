<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%service_license_as_manufacturer_of_weights_measures}}".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $date_of_establishment_of_workshop
 * @property string $types_of_weights_and_measures
 * @property string $types_of_weights_and_measures_instruments
 * @property string $types_of_weights_and_measures_instruments_details
 * @property integer $number_of_persons_employed_semi_skilled
 * @property integer $number_of_persons_employed_semi_unskilled
 * @property integer $number_of_persons_employed_specialist
 * @property string $monogram_trademark
 * @property string $details_of_machinery
 * @property string $details_of_foundry
 * @property string $facilities_of_steel_casting
 * @property string $availability_of_electrical_energy
 * @property string $whether_any_loan_received
 * @property string $name_of_bankers
 * @property string $vat_number
 * @property string $have_you_applied_previously_for_a_manufacturer_license
 * @property string $whether_the_item_proposed_to_be_manufactured
 * @property string $created
 * @property string $updated
 */
class ServiceLicenseAsManufacturerOfWeightsMeasures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_license_as_manufacturer_of_weights_measures}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'date_of_establishment_of_workshop', 
			'types_of_weights_and_measures', 'types_of_weights_and_measures_instruments', 'types_of_weights_and_measures_instruments_details', 
			
		'number_of_persons_employed_semi_skilled', 'number_of_persons_employed_semi_unskilled', 'number_of_persons_employed_specialist', 

		'monogram_trademark', 'details_of_machinery', 'details_of_foundry', 'facilities_of_steel_casting', 'availability_of_electrical_energy', 'whether_any_loan_received', 'name_of_bankers', 'vat_number', 'have_you_applied_previously_for_a_manufacturer_license', 'whether_the_item_proposed_to_be_manufactured'], 'required'],

            [['project_id', 'number_of_persons_employed_semi_skilled', 'number_of_persons_employed_semi_unskilled', 'number_of_persons_employed_specialist'], 'integer'],

            [['created', 'updated'], 'safe'],

            [['types_of_weights_and_measures', 'monogram_trademark', 'details_of_machinery', 'details_of_foundry', 'facilities_of_steel_casting', 'availability_of_electrical_energy', 'whether_any_loan_received', 'name_of_bankers', 'vat_number', 'have_you_applied_previously_for_a_manufacturer_license', 'whether_the_item_proposed_to_be_manufactured'], 'string', 'max' => 255],
			
			
			[['date_of_establishment_of_workshop'], 'date', 'format' => 'php:d-m-Y'],
				
			['date_of_establishment_of_workshop', 'match', 'pattern' => '/^[0-9]{2}[-|\/]{1}[0-9]{2}[-|\/]{1}[0-9]{4}$/'],	
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
            'date_of_establishment_of_workshop' => 'Date Of Establishment Of Workshop',
            'types_of_weights_and_measures' => 'Types Of Weights And Measures',
            'number_of_persons_employed_semi_skilled' => 'Number Of Persons Employed',
            'monogram_trademark' => 'Monogram Trademark',
            'details_of_machinery' => 'Details Of Machinery',
            'details_of_foundry' => 'Details Of Foundry',
            'facilities_of_steel_casting' => 'Facilities Of Steel Casting',
            'availability_of_electrical_energy' => 'Availability Of Electrical Energy',
            'whether_any_loan_received' => 'Whether Any Loan Received',
            'name_of_bankers' => 'Name Of Bankers',
            'vat_number' => 'Vat Number',
            'have_you_applied_previously_for_a_manufacturer_license' => 'Have You Applied Previously For A Manufacturer License',
            'whether_the_item_proposed_to_be_manufactured' => 'Whether The Item Proposed To Be Manufactured',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

	
	public function beforeSave($insert = true) {
		
		if(isset($this->date_of_establishment_of_workshop)) {
			$this->date_of_establishment_of_workshop = date('Y-m-d', strtotime($this->date_of_establishment_of_workshop)); 
		} 
 
		return parent::beforeSave($insert);
	}
}
