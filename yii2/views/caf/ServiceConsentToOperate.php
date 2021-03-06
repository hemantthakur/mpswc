<?php
use yii\web\View;  
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha; 
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
  
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar; 
use app\assets\AppAsset;   
use yii\helpers\ArrayHelper;  
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

use app\models\State;
use app\models\Country;
use app\models\District;
use app\models\City;
use app\models\Town;
use app\models\Tehsil;

use app\models\PcbSector;

 

$this->title = 'Consent to Operate'; 
$this->params['breadcrumbs'][] = $this->title;
?> 
<?php
$form = ActiveForm::begin(); 

//$investor_project[0]
?>
<div role="main" class="main">
	<section class="">
			<div class="row">
				<div class="col-md-12">
					<?php /* Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) */ 
					echo $steps;
					?>
				</div>
			</div>
	</section>
 </div>
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
	echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
<div class="container-fluid">

	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-list"></i>Consent to Operate</div>
			<div class="tools"> </div>
		</div> 
		<div class="portlet-body">  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'electricity_company_name')->textInput(['maxlength' => true])->label('Electricity Company Name/Address'); ?>
			</div> 
			<div class="col-lg-6">
					<?= $form->field($model, 'consumer_no')->textInput(['maxlength' => true])->label("Consumer No(Electric Meter)"); ?>
			</div>
		</div>  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'on_east')->textInput(['maxlength' => true])->label('On East'); ?>
			</div> 
			<div class="col-lg-6">
					<?= $form->field($model, 'on_west')->textInput(['maxlength' => true])->label("On West"); ?>
			</div>
		</div>    
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'on_north')->textInput(['maxlength' => true])->label('On North'); ?>
			</div> 
			<div class="col-lg-6">
					<?= $form->field($model, 'on_south')->textInput(['maxlength' => true])->label("On South"); ?>
			</div>
		</div>    
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'no_of_pumps')->textInput(['maxlength' => true])->label('No. of Pumps Requirement (per day) minimum'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'tube_wells')->textInput(['maxlength' => true])->label('Tube wells'); ?>
			</div>  
		</div>   

		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'bore_wells')->textInput(['maxlength' => true])->label('Bore wells'); ?>
			</div>  
		</div>   

		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'latitude')->textInput(['maxlength' => true])->label('Latitude'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'longitude')->textInput(['maxlength' => true])->label('Longitude'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'capacity_of_all')->textInput(['maxlength' => true])->label('Capacity of ALL'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'nationality')->textInput(['maxlength' => true])->label('Nationality'); ?>
			</div>  
		</div>
		<div class="row"> 
			<div class="col-lg-6">					
				
					<?= $form->field($model, 'production_date')->textInput(['readonly' => true])->widget(DatePicker::classname(), [
                                    'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                    'startDate'=>date('d-m-Y'),
                                    'endDate'=>'01-01-2100',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    
                                ])->label('Production Date');  ?> 
			</div> 
			<div class="col-lg-6">  
						<?= $form->field($model, 'plant_commission')->textInput(['readonly' => true])->widget(DatePicker::classname(), [
                                    'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                    'startDate'=>date('d-m-Y'),
                                    'endDate'=>'01-01-2100',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    
                                ])->label('Plant Commission'); ?>
			</div>  
		</div>   


		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'tsdf_name')->textInput(['maxlength' => true])->label('TSDF Name'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'cetp_name')->textInput(['maxlength' => true])->label('CETP Name'); ?>
			</div>  
		</div>   
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'licence_ssi')->textInput(['maxlength' => true])->label('Licence SSI/IEM No.'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'area')->textInput(['maxlength' => true])->label('Area in Sq Mtr'); ?>
			</div>  
		</div>   
		<div class="row"> 
			<div class="col-lg-6">   
					<?= $form->field($model, 'plantation_open')->textInput(['maxlength' => true])->label('Plantation Open'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'source_of_water_supply')->textInput(['maxlength' => true])->label('Source of Water Supply Premise Area-SqMtr'); ?>
			</div>  
		</div>   
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'fresh_water_consumption')->textInput(['maxlength' => true])->label('Fresh Water Consumption(KLPD) (Industrial Domestic)'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'waste_water_generation')->textInput(['maxlength' => true])->label('Waste Water Generation (Industrial Domestic )'); ?>
			</div>  
		</div>   
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'industrial_domestic')->textInput(['maxlength' => true])->label('Industrial Domestic'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'waste_water_discharge')->textInput(['maxlength' => true])->label('Waste Wtr Discharge Pt'); ?>
			</div>  
		</div>  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'ultimate_receiving_body')->textInput(['maxlength' => true])->label('Ultimate Receiving Body'); ?>
			</div> 
			<div class="col-lg-6">   
					<?= $form->field($model, 'hazd_waste_storage')->checkbox(array(
								'label'=>'',
								'labelOptions'=>array('style'=>'padding:5px;'), 
								))
								->label('Hazardous Waste Storage'); ?>
			</div>  
		</div>   



		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'critical_polluted_area')->dropdownList([
							'Yes' => 'Yes', 
							'No' => 'No',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
							)->label('Critical Polluted Area'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'distance_from_residential')->textInput(['maxlength' => true])->label('Distance from Residential'); ?>
			</div>  
		</div>   

		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'distance_from_eco_sensitive')->textInput(['maxlength' => true])->label('Distance from Eco Sensitive'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'distance_from_highway')->textInput(['maxlength' => true])->label('Distance from Highway'); ?>
			</div>  
		</div>   

		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'premise_area_sqmtr')->textInput(['maxlength' => true])->label('Premise Area-SqMtr (Plantaion & Open)'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'industrial_estate_in_notified_area')->dropdownList([
							'In Industrial Estate' => 'In Industrial Estate', 
							'In Notified Area' => 'In Notified Area',
							'In SIDC, I/A' => 'In SIDC, I/A',
							'Not in Any of these' => 'Not in Any of these', 
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
							)->label('Does it fall in? In Industrial Estate In Notified Area In SIDC, I/A Not in Any of these'); ?>
			</div>  
		</div>
		<div class="row"> 
			<div class="col-lg-6">
					<?= $form->field($model, 'env_clearance')->checkbox(array(
								'label'=>'', 'labelOptions'=>array('style'=>'padding:5px;'), 
								))->label('Env. Clearance?'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'moef_seiaa')->textInput(['maxlength' => true])->label('MOEF SEIAA N.A ECC'); ?>
			</div>  
		</div>   


		<h3>CTE/CCA</h3>
		<div class="row"> 
			<div class="col-lg-6">					
					<?= $form->field($model, 'application_date')->widget(DatePicker::classname(), [
                                    'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                    'startDate'=>'01-01-1800',
                                    'endDate'=>'01-01-2100',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    
                                ])->label('Application Date'); ?>
			</div> 
			<div class="col-lg-6">  

					<?php 
					
					$items = ArrayHelper::map(PcbSector::find()->all(), 'sector', 'sector');
					echo $form->field($model, 'sector_of_the_Industry')->dropDownList($items, ['prompt' => 'Select', 'class' => 'form-control']);
					?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
			 
					<?= $form->field($model, 'air_water_hazardous')->checkbox(array(
								'label'=>'',
								'labelOptions'=>array('style'=>'padding:5px;'), 
								))
								->label('Air/Water/Hazardous'); ?> 
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'view_pdfs_files')->textInput(['maxlength' => true])->label('View PDFs Files'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'cte_on_east')->textInput(['maxlength' => true])->label('On East'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'cte_on_west')->textInput(['maxlength' => true])->label('On North'); ?>
			</div>  
		</div> 

		
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'cte_on_north')->textInput(['maxlength' => true])->label('On West'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'cte_on_south')->textInput(['maxlength' => true])->label('On South'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'noc_cce_fees')->textInput(['maxlength' => true])->label('NOC-CCE Fees'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'purpose_of_this_application')->textInput(['maxlength' => true])->label('Explain the PURPOSE of this Application (100 to 1000 Chrs)'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'any_relevant_information_to_be_mentioned')->textInput(['maxlength' => true])->label('Any relevant information to be mentioned in the A/W/H/NOC Form'); ?>
			</div> 
		</div> 


		<h3>Water - ETPs</h3>
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_ultimate_final_body')->textInput(['maxlength' => true])->label('Ultimate Final Body'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_discharge_point')->textInput(['maxlength' => true])->label('Discharge Point'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_disposal_mode')->dropdownList([
							'Common E.T.P' => 'Common E.T.P',
							'Deep Well' => 'Deep Well',
							'Disposal in River' => 'Disposal in River',
							'Irrigation' => 'Irrigation',
							'Not Specified' => 'Not Specified',
							'On Land / Plantation' => 'On Land / Plantation',
							'Open SIDC Surface Drain' => 'Open SIDC Surface Drain',
							'Public Sewer' => 'Public Sewer',
							'ReCycling' => 'ReCycling',
							'Septic Tank' => 'Septic Tank',
							'Soak Pit' => 'Soak Pit',
							'Storm Water Drain' => 'Storm Water Drain',    
							'Underground Drainage System' => 'Underground Drainage System',    
							'Zero Discharge' => 'Zero Discharge'
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
							)->label('Disposal Mode (IND)'); ?>
			</div>  
		</div>  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_for_domestic')->dropdownList([
							'Common E.T.P' => 'Common E.T.P',
							'Deep Well' => 'Deep Well',
							'Disposal in River' => 'Disposal in River',
							'Irrigation' => 'Irrigation',
							'Not Specified' => 'Not Specified',
							'On Land / Plantation' => 'On Land / Plantation',
							'Open SIDC Surface Drain' => 'Open SIDC Surface Drain',
							'Public Sewer' => 'Public Sewer',
							'ReCycling' => 'ReCycling',
							'Septic Tank' => 'Septic Tank',
							'Soak Pit' => 'Soak Pit',
							'Storm Water Drain' => 'Storm Water Drain',    
							'Underground Drainage System' => 'Underground Drainage System',    
							'Zero Discharge' => 'Zero Discharge'
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
							)->label('For Domestic'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_disposal_details')->textInput(['maxlength' => true])->label('Disposal Details'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_fresh_wc_klpd')->textInput(['maxlength' => true])->label('Fresh WC Klpd [IND/DOM]'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_wwg_klpd')->textInput(['maxlength' => true])->label('WWG Klpd [IND/DOM]'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_tube_wells')->textInput(['maxlength' => true])->label('Tube wells/Boilers'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_bore_wells')->textInput(['maxlength' => true])->label('Bore wells/D.G Sets'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_capacity_hp')->textInput(['maxlength' => true])->label('Capacity/HP'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_cetp_member')->dropdownList([
							'NOT a CETP Member' => 'NOT a CETP Member',
							'Govindpura - Bhopal (BPL)' => 'Govindpura - Bhopal (BPL)',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('CETP Member'); ?>
			</div>  
		</div>  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_water_source')->textInput(['maxlength' => true])->label('ETP/STP Chamber'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_etp_stp_chamber')->textInput(['maxlength' => true])->label('Capacity'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_capacity')->textInput(['maxlength' => true])->label('Ultimate Receiving Body'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_units')->textInput(['maxlength' => true])->label('Units'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">   
					<?= $form->field($model, 'water_etps_date_of_commissioning')->widget(DatePicker::classname(), [              'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                    'startDate'=>date('d-m-Y'),
                                    'endDate'=>'01-01-2100',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    
                                ])->label('Date of Commissioning'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'water_etps_remarks')->textInput(['maxlength' => true])->label('Remarks'); ?>
			</div>  
		</div>  


		<h3>WC - Water Consumption/WWG - Waste Water Generation (KLS/DAY)</h3>
		<div class="row"> 
			<div class="col-lg-6">    
					<?= $form->field($model, 'wc_watCd')->dropdownList([
							'Agriculture' => 'Agriculture',
							'Boiler Feed' => 'Boiler Feed',
							'Cooling Water' => 'Cooling Water',
							'D.M Water Plant' => 'D.M Water Plant',
							'Domestic Purpose' => 'Domestic Purpose',
							'Dust Suppression' => 'Dust Suppression',
							'Floor / Utensils Washing' => 'Floor / Utensils Washing',
							'Mine Water Discharge' => 'Mine Water Discharge',
							'Mnfg Process' => 'Mnfg Process',
							'Others' => 'Others', 
							'Plantation / Horticulture' => 'Plantation / Horticulture', 
							'Spray in Mines' => 'Spray in Mines',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('WatCd'); ?>
			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'wc_watSrc')->dropdownList([
							'Agriculture' => 'Agriculture',
							'Boiler Feed' => 'Boiler Feed',
							'Cooling Water' => 'Cooling Water',
							'D.M Water Plant' => 'D.M Water Plant',
							'Domestic Purpose' => 'Domestic Purpose',
							'Dust Suppression' => 'Dust Suppression',
							'Floor / Utensils Washing' => 'Floor / Utensils Washing',
							'Mine Water Discharge' => 'Mine Water Discharge',
							'Mnfg Process' => 'Mnfg Process',
							'Others' => 'Others', 
							'Plantation / Horticulture' => 'Plantation / Horticulture', 
							'Spray in Mines' => 'Spray in Mines',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('WatSrc'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'wc_kls_day')->textInput(['maxlength' => true])->label('WC Kls/Day'); ?>

			</div> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'wc_wwg')->textInput(['maxlength' => true])->label('WWG Kls/Day'); ?>
			</div>  
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'wc_remarks')->textInput(['maxlength' => true])->label('Remarks'); ?>
			</div> 
		</div> 


		<h3>AIR Stack</h3>
		<div class="row"> 
			<div class="col-lg-6">   
					<?= $form->field($model, 'air_stack_emission_type')->dropdownList([
							'Process Stack' => 'Process Stack',
							'Flue gases Stack' => 'Flue gases Stack',
							'Fugitive Emission' => 'Fugitive Emission', 
							'N.A.' => 'N.A.',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('Emission Type'); ?>
			</div>   
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_attached_to')->textInput(['maxlength' => true])->label('Stack Attached To'); ?>
			</div> 
		</div>
		
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_hgt_mtrs')->textInput(['maxlength' => true])->label('Hgt-Mtrs'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_remarks_capacity')->textInput(['maxlength' => true])->label('Remarks/Capacity'); ?>
			</div> 
		</div>  
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_smf')->dropdownList([
							'Yes' => 'Yes',
							'No' => 'No',
							'NA' => 'NA', 
							'INA' => 'INA',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('SMF'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_fuel_used')->dropdownList([
							'Agro Waste' => 'Agro Waste',
							'Charcoal' => 'Charcoal',
							'Coal' => 'Coal', 
							'Coal Gas' => 'Coal Gas',
							'Coke' => 'Coke',
							'Crude Oil' => 'Crude Oil',
							'Diesel' => 'Diesel',
							'Electricity' => 'Electricity',
							'F.G' => 'F.G',
							'fo' => 'fo',
							'Furnace Oil' => 'Furnace Oil',
							'H.S.D' => 'H.S.D',
							'Husk' => 'Husk',
							'L.N. Gas' => 'L.N. Gas',
							'L.P.G' => 'L.P.G',  
							'ldo' => 'ldo',  
							'Lean Gas' => 'Lean Gas',  
							'Lignite' => 'Lignite',  
							'Natural Gas' => 'Natural Gas',  
							'Neptha' => 'Neptha',   
							'Not Used/N.A' => 'Not Used/N.A',   
							'Petroleum Cock' => 'Petroleum Cock',   
							'Solid Fuel' => 'Solid Fuel',   
							'Solid Waste' => 'Solid Waste',    
							'Wood' => 'Wood',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('Fuel Used(e.g ldo,coal,wood)'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">
					<?= $form->field($model, 'air_stack_apc')->checkbox(array(
								'label'=>'',
								'labelOptions'=>array('style'=>'padding:5px;'), 
								))
								->label('APC'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_diameter')->textInput(['maxlength' => true])->label('Diameter(cm)'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_cons_hour_unit')->textInput(['maxlength' => true])->label('Cons/Hour & Unit'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'air_stack_air_pollution_control_measures')->dropdownList([
							'4 Stage Cyclone Separator' => '4 Stage Cyclone Separator',
							'Dust Suppressor' => 'Dust Suppressor',
							'Low Nox Burner' => 'Low Nox Burner', 
							'Scrubber' => 'Scrubber',
							'accoustic enclosure' => 'accoustic enclosure',
							'E.S.P' => 'E.S.P',  
							'Muffler' => 'Muffler',
							'Teema Cyclone Seperator' => 'Teema Cyclone Seperator',
							'Air Preheater' => 'Air Preheater',
							'Gravity Settling Chamber' => 'Gravity Settling Chamber',
							'Multi Cyclone' => 'Multi Cyclone',
							'Ventilated Working Shed' => 'Ventilated Working Shed',
							'Bag Filter' => 'Bag Filter',
							'Green Belt' => 'Green Belt', 
							'Natural Draft' => 'Natural Draft', 
							'Water Deep Tank' => 'Water Deep Tank', 
							'Cyclone' => 'Cyclone', 
							'Heater/Furnace-Low Sulphur Fuel' => 'Heater/Furnace-Low Sulphur Fuel', 
							'Not Applicable' => 'Not Applicable', 
							'Water Sprinkler' => 'Water Sprinkler', 
							'Dumper' => 'Dumper', 
							'Hood Cover' => 'Hood Cover', 
							'Not provided' => 'Not provided', 
							'Wind Breaking Wall' => 'Wind Breaking Wall', 
							'Dust Collector' => 'Dust Collector', 
							'INC-convert SO2+Taila gas' => 'INC-convert SO2+Taila gas', 
							'Screen Cover' => 'Screen Cover',  
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('Air Pollution Control Measures'); ?>
			</div> 
		</div> 

		<h3>Hazardous Waste QTY</h3>
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'hazardous_waste_category')->textInput(['maxlength' => true])->label('Category'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'hazardous_waste_name')->textInput(['maxlength' => true])->label('Waste Name'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'hazardous_waste_qty_yr')->textInput(['maxlength' => true])->label('Qty/Year'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'hazardous_waste_unit')->textInput(['maxlength' => true])->label('Unit'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
			
					<?= $form->field($model, 'hazardous_waste_apc')->checkbox(array(
								'label'=>'',
								'labelOptions'=>array('style'=>'padding:5px;'), 
								))
								->label('APC'); ?> 
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'hazardous_waste_management_of_hazardous_waste_disposal')->textInput(['maxlength' => true])->label('Management of Hazardous Waste Disposal'); ?>
			</div> 
		</div> 

		<h3>Raw Material </h3>
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'raw_material_product_name')->textInput(['maxlength' => true])->label('Product Name'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'raw_material_unit')->dropdownList([
							'Hectare' => 'Hectare',
							'Kilo Grams' => 'Kilo Grams',
							'Kilo Lts' => 'Kilo Lts',
							'Kilo Watt Hr' => 'Kilo Watt Hr',
							'Lakh Meters' => 'Lakh Meters',
							'Litres' => 'Litres',
							'MegaWatt Hour' => 'MegaWatt Hour',
							'Meter Cube' => 'Meter Cube',
							'Meter Square' => 'Meter Square',
							'Meters' => 'Meters', 
							'Metric Tonne' => 'Metric Tonne', 
							'Million' => 'Million', 
							'Not Specified' => 'Not Specified', 
							'Number Of' => 'Number Of', 
							'S.Cubic Meter' => 'S.Cubic Meter',
							], 
							['prompt' => 'Select', 'class' => 'form-control'] 
					)->label('Unit'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'raw_material_cte_quantity')->textInput(['maxlength' => true])->label('CTE Qty'); ?>
			</div>  
			<div class="col-lg-6">  
					<?= $form->field($model, 'raw_material_applied_quantity')->textInput(['maxlength' => true])->label('Applied Quantity'); ?>
			</div> 
		</div> 
		<div class="row"> 
			<div class="col-lg-6">  
					<?= $form->field($model, 'raw_material_remarks')->textInput(['maxlength' => true])->label('Remarks'); ?>
			</div>  
			<div class="col-lg-6">  
			
					<?= $form->field($model, 'raw_material_apc')->checkbox(array(
								'label'=>'',
								'labelOptions'=>array('style'=>'padding:5px;'), 
								))
								->label('APC'); ?>
			</div> 
		</div>  

	</div>
	</div>   
		<div class="form-group">
			<?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
</div>
<?php
if($disabled) {
	$this->registerJs(
	'$(document).ready(function(){
		$("input").attr("disabled", true);
		$("select").attr("disabled", true);
		$("textarea").attr("disabled", true);
		$("#investorprojects-other_sector").prop("disabled", true);
		$(".form-group .btn").parent().html("");
	});
	', View::POS_READY, 'my-button-handler2');
}
?>