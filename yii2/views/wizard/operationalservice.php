<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Pre-Operational Service Wizard';
$this->params['breadcrumbs'][] = $this->title;
 
?> 

<style>
.form-horizontal .control-label { 
    text-align: left;
}
div.required label.control-label:after {
    content: " *";
    color: red;
}

.form-horizontal .form-group.radio-grp{
    padding-right: 15px;
    float: left;
    margin: 0px;
} 
.radio-grp label{
 margin:0px;padding:0px;

 padding: 0px 10px;margin:0px;float: left;width: 100%;display: block;
}
.form-horizontal .form-group.radio-grp:last-child{margin-bottom: 20px;}
.form-horizontal .form-group.radio-grp:first-child{margin-left: -15px;}

/*---radio style--*/

label.btn span {
  font-size: 1.5em ;
}

label input[type="radio"] ~ i.fa.fa-circle-o{
    color: #c8c8c8;    display: inline;
}
label input[type="radio"] ~ i.fa.fa-dot-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
    color: #7AA3CC;    display: inline;
}
label:hover input[type="radio"] ~ i.fa {
color: #7AA3CC;
}

label input[type="checkbox"] ~ i.fa.fa-square-o{
    color: #c8c8c8;    display: inline;
}
label input[type="checkbox"] ~ i.fa.fa-check-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
    color: #7AA3CC;    display: inline;
}
label:hover input[type="checkbox"] ~ i.fa {
color: #7AA3CC;
}

div[data-toggle="buttons"] label.active{
    color: #7AA3CC;
}

div[data-toggle="buttons"] label {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: normal;
line-height: 2em;
text-align: left;
white-space: nowrap;
vertical-align: top;
cursor: pointer;
background-color: none;
border: 0px solid 
#c8c8c8;
border-radius: 3px;
color: #c8c8c8;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

div[data-toggle="buttons"] label:hover {
color: #7AA3CC;
}

div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
-webkit-box-shadow: none;
box-shadow: none;
}
</style> 
<?php
  
$form = ActiveForm::begin([
				'id' => 'wizardForm',				
					'options' => 
						['class' => 'form-horizontal',  
						'ng-app' => 'myApp', 
						'ng-controller' => 'validateCtrl',  
						'name' => "wizardForm",],
				]);
?> 

<div class="container">
&nbsp;<br>&nbsp;<br>
	<H2><?= Html::encode($this->title) ?></h2>


	<div class="portlet-body">
 
<?php
$sector_ques_id = 1;
// echo $form->errorSummary($model);

$post_names = array();
//itrate question groups
foreach ($questiongroups as $questiongroup): ?>

		<div class="row">
			<div class="col-lg-12"><h3><u><?= $questiongroup[0]->heading ?></u></h3></div>
		</div>
		
 <div class="row hideme required"> 
			<div class="col-lg-6">
				<label for="1" class="control-label">Nature of your business/ industry</label> 
			</div>
			<div class="col-lg-3">
					<div class="form-group"  ng-class="{true: 'error'}[submitted && wizardForm.select_<?= $sector_ques_id ?>.$invalid]"> 
					<select id="<?= $sector_ques_id ?>"  data-validation="required" name="wizardForm[<?= $sector_ques_id ?>]" class="form-control" ng-model="select_<?= $sector_ques_id ?>">
								<option value="" selected="selected">Select</option>
								<option value="1" data-dependentquestions="17">Manufacturing</option>
								<option value="2" data-dependentquestions="17">Agriculture</option> 
								<option value="3" data-dependentquestions="17">Automotive </option> 
								<option value="4" data-dependentquestions="17">Healthcare and Hospitals</option> 
								<option value="5" data-dependentquestions="17">Tourism &amp; Hospitality</option> 
								<option value="6" data-dependentquestions="17">IT and ITeS</option>
								<option value="7" data-dependentquestions="17">Mining and Minerals</option> 
								<option value="8" data-dependentquestions="17">Pharmaceuticals</option> 
								<option value="9" data-dependentquestions="17">New and Renewable Energy</option>
								<option value="10" data-dependentquestions="17">textile</option>
								<option value="310" data-dependentquestions="18,19">Winery / Brewery / Distillery</option>
								<option value="11" data-dependentquestions="17">Real Estate</option>
								<option value="311" data-dependentquestions="18,19">Petrolium Products</option>
								<option value="312" data-dependentquestions="17">Entertainment &amp; Amusement</option>
								<option value="12" data-dependentquestions="17">Others</option>
								<option value="317" data-dependentquestions="17">Energy</option>
								<option value="318" data-dependentquestions="17">Infrastructure</option> 
							</select> 
					</div>
		</div>
		</div>

		<?php 
		$i=0;
		//itrate questions
		foreach ($questions as $question): 
			if($question->grp_id == $questiongroup[0]->id): 
				$i++;
		?>
		<div class="row hideme required"> 
			<div class="col-lg-6">
				<?php //echo $i; ?>
				<label for="<?= $question->id ?>" class="control-label"><?= $question->text ?></label> 
			</div>
			<div class="col-lg-3"> 
			<?php 
				if(trim($question->render_type) == 'Drop Down'):

					$post_names[$question->id] = $question->text;

					$parent_id = '';
					if($question->parent_id):  
						$parent_id = 'data-parentid="' . $question->parent_id . '"';
					endif; 
				?>	
					<div class="form-group"  ng-class="{true: 'error'}[submitted && wizardForm.select_<?= $question->id ?>.$invalid]"> 

					<select id="<?= $question->id ?>"  data-validation="required" name="wizardForm[<?= $question->id ?>]" <?= $parent_id ?> class="form-control" ng-model="select_<?= $question->id ?>">
						<option value="">Select</option>
						<?php
							foreach ($answers as $answer):		
								if($answer->question_id == $question->id):

									$parentansid = '';
									if($answer->parent_ans_id):  
										$parentansid = 'data-parentansid="' . $answer->parent_ans_id . '"';
									endif; 

									$dependentquestions = '';
									if($answer->dependent_questions):  
										$dependentquestions = 'data-dependentquestions="' . $answer->dependent_questions . '"';
									endif;   
							?> 
								<option value="<?= $answer->id ?>" <?= $parentansid ?> <?= $dependentquestions ?>><?= $answer->text ?></option> 
							<?php
								endif;   
							endforeach; 
						?>
					</select> 
					</div>
				<?php 					 
			    endif; 
				//---all radio fields
				if($question->render_type == 'Radio Button'):

					$post_names[$question->id] = $question->text;

					$parent_id = '';
					if($question->parent_id):  
						$parent_id = 'data-parentid="'.$question->parent_id.'"';
					endif; 
					?>
					<div class="form-group">
						<?php
						foreach ($answers as $answer): 
							if($answer->question_id == $question->id):

								$parentansid = '';
								if($answer->parent_ans_id):  
									$parentansid = 'data-parentansid="'.$answer->parent_ans_id.'"';
								endif; 

								$dependentquestions = '';
								if($answer->dependent_questions):  
									$dependentquestions = 'data-dependentquestions="'.$answer->dependent_questions.'"';
								endif;
						?>		  

								<input type="radio"  data-validation="required" id="<?= $question->id.'_'.$answer->id ?>" name="wizardForm[<?= $question->id ?>]" value="<?= $answer->id ?>" <?= $dependentquestions ?>  ng-model="radio_<?= $question->id ?>"  /><label for="<?= $question->id.'_'.$answer->id ?>"> <?= $answer->text ?></label>
							 &nbsp;&nbsp;
 

						<?php 
							endif;
						endforeach; 
						?>    
					</div>
					<?php
			    endif;
				//---all multiselect
				if($question->render_type == 'Multiple Choice'):  
					$post_names[$question->id] = $question->text;

					$parent_id = '';
					if($question->parent_id):  
						$parent_id = 'data-parentId="'.$question->parent_id.'"';
					endif; 
					?>
					<div class="form-group">
						<select id="<?= $question->id ?>" size="6"  name="wizardForm[<?= $question->id ?>][]" <?= $parent_id ?>  multiple="multiple" class="form-control" ng-model="multiple_<?= $question->id ?>"  data-validation="required">
							<?php
							foreach ($answers as $answer):		
								if($answer->question_id == $question->id): 

									$parentansid = '';
									if($answer->parent_ans_id):  
										$parentansid = 'data-parentansid="'.$answer->parent_ans_id.'"';
									endif; 

									$dependentquestions = '';
									if($answer->dependent_questions):  
										$dependentquestions = 'data-dependentquestions="'.$answer->dependent_questions.'"';
									endif;   
							?> 
								<option value="<?= $answer->id ?>" <?= $dependentquestions ?> <?= $parentansid ?>><?= $answer->text ?></option> 
							<?php
								endif;   
							endforeach; 
							 ?>
						</select>  
					</div>
					<?php 
				endif; 
				?> 
		</div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?> 
<?php endforeach; ?>
	<input type="hidden" name="servicew" value='<?php echo serialize($post_names); ?>'/> 

	<div class="row">
		<div class="form-group text-center">
			<div class="col-lg-offset-1 col-lg-11">
				<p>&nbsp;</p>  
				
				<?= Html::submitButton('Submit', [
				'class' => 'btn btn-primary',   
				'ng-click' => 'submitted=true',  
				]) ?> 
			</div>
		</div>
	</div>

	<?php ActiveForm::end() ?> 
	<div id="cascadingCombos" style="display:none"></div> 

</div>
</div>

<?php 

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/wizard.js',['depends' => [\yii\web\JqueryAsset::className()]]); 


$this->registerJsFile(
    Yii::$app->request->baseUrl.'/js/jquery.form-validator.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
 


$this->registerJs(
"$.validate({
  borderColorOnError : '#ff0000',
  addValidClassOnAll : true
});
", View::POS_READY, 'my-button-handler');

?> 

<script>
var app = angular.module('myApp', []); 
app.controller('validateCtrl', function($scope) {}); 

</script>