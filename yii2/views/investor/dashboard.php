<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset; 
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

use yii\web\View;
 
$this->title = 'Dashboard'; 
$this->params['breadcrumbs'][] = $this->title; 
?>
<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus { background: #fff;
}

.product-box {
    padding: 0;
    border: 1px solid #e7eaec;
    box-shadow: inset 0 0 0 #ccc, 0 5px 0 0 #ccc, 0 10px 5px #ccc;
    border-radius: 5px;
}
</style>

<?php

if(count(Yii::$app->session->getAllFlashes())) {
	foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
		echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
	}
}

?>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				&nbsp;<br>&nbsp;<br>
				&nbsp;<br>
				<div class="col-lg-6">
					<a href="return: <?= Url::to(['project/add']) ?>" class="btn btn-primary" id="start-new-business">Start a new Bussiness/Investment</a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div class="col-lg-6">
				 <a href="<?= Url::to(['project/existing']) ?>" class="btn btn-primary">Add Existing Bussiness/Investment</a>
				</div>
				&nbsp;<br>&nbsp;<br>&nbsp;<br>
			</div>
			<div class="row">
				<div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!-- <span class="label label-success pull-right">Incomplete</span> -->
                        <h5>Services</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=$incomplete;?></h1>
                        <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                        <small>Incomplete</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!-- <span class="label label-info pull-right">Annual</span> -->
                        <h5>Services</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">0</h1>
                        <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                        <small>Pending with you </small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!-- <span class="label label-info pull-right">Annual</span> -->
                        <h5>Services</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">0</h1>
                        <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                        <small>Approved</small>
                    </div>
                </div>
            </div> 


</div>
</div>

<div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">Data has changed</span>
                        <h5>User activity</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>236 321.80</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>46.11%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>432.021</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>643 321.10</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>92.43%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>564.554</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>436 547.20</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>150.23%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>124.990</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
 

 

<?php 
if(isset($investor_projects)) { 
  if(count($investor_projects)) {
    foreach ($investor_projects as $project): 
	
	 if($project->type == 'new') {  
		 $status = ($project->department_approval ? 'Approved' : 'Pending');
	 }
	 else {
		 $status = 'Approved';	
	 }

	 if($project->type == 'new') {

		 $link = ($project->department_approval ? '<a href="' . Url::to(['wizard/prestablish', 'id' => $project->id]) . '">Pre Establishment Service Wizard</a> | <a href="' . Url::to(['wizard/pre-operational', 'id' => $project->id]) . '">Pre-Operational Service Wizard</a>' : 'Pending');
	 }
	 else {
	    $link = 'Approved';	
    }
?>




<?php
$pre_est_service_table = '';
if(isset($investorProjectDetail)) {
	if(count($investorProjectDetail)) {
		$i = 1;
		foreach ($investorProjectDetail as $service): 
			if($service->type == '' || $service->type == 'pre-establish') {

				if($service->project_id == $project->id) {
					$service_id = $service->service_id;	

					$disabled = '';
					$checked = '';
					$img = '';
					if($service->status) {
						$disabled = 'disabled';
						$checked = 'checked'; 
					}
					
					$preview = '';
					if($service->completed) { 
						$img = '<img src="images/apply.png" style="width:20px;"/> &nbsp;&nbsp;';
						$img = '<a href="' . Url::to(['investor/services', 'project_id' => $project->id, 'serviceid' => $service_id, 'action' => 'view']) . '">Draft</a>';
						
						//$preview = ' <a href="' . Url::to(['investor/services', 'project_id' => $project->id, 'serviceid' => $service_id, 'action' => 'view']) . '">Preview</a>';
					}
					else {
						
						//$img = '<a href="' . Url::to(['investor/services', 'project_id' => $project->id]) . '" class="btn btn-primary">Apply Services</a>';
					}
					?>
				<?php 
					$service_name = '';	
					if(isset($services[$service_id]['name'])) { $service_name =  $services[$service_id]['name']; } 

					$pre_est_service_table .= '<div class="row"  style="padding:10px 0px;"> 
						<div class="col-lg-1 col">'.$i.'</div> 
						<div class="col-lg-7 col">'.$service_name.'</div>  
						<div class="col-lg-2 col"> 
							 <input type="checkbox" name="services[]" value="'.$service_id.'" '.$disabled.' '.$checked.'/> 
							&nbsp;&nbsp;'.$img.'
						</div> 
						<div class="col-lg-1 col"> 
							' . $preview . '
						</div>
				   </div>';  
					$i++; 
				}
		}
		endforeach; 
	}
} 
$servicelist = '';
if($pre_est_service_table ) { 
		$servicelist = 
		'
		<form method="post">
		 <input type="hidden" name="project" value="'.$project->id.'"/> 
		 <input type="hidden" name="type" value="service"/> 
		<div style="" class=""> 
		 
			<div class="row">&nbsp;<br></div>
			<div><strong>List of Services to apply:</strong> </div>
			<div class="row"> 
				<div class="col-lg-1 col"><strong>#</strong> </div>
				<div class="col-lg-7 col"><strong>Service Name</strong> </div> 
				<div class="col-lg-2 col text-center"><strong>Applied</strong> </div> 
				<div class="col-lg-1 col text-center"><strong>Preview</strong> </div> 
			</div>
			 '. $pre_est_service_table .'

			 <div class="row"> 
				<div class="col-lg-1 col"></div>
				<div class="col-lg-7 col">&nbsp;<br><a href="' . Url::to(['caf/cafservices', 'projectId' => $project->id]) . '">Preview</a></div> 
				<div class="col-lg-2 col"><input type="submit" value="Apply"class="btn btn-primary"/></div>
			</div>
			<p>&nbsp;<br>&nbsp;<br></p>  
		</div>

             <input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'" />
		</form>
		'; 
}

////----------------------------------------------------------------------------------

$pre_oper_service_table = '';
if(isset($investorProjectDetail)) {
	if(count($investorProjectDetail)) {
		$i = 1;
		foreach ($investorProjectDetail as $service): 
			if($service->type == 'pre-operational') {

				if($service->project_id == $project->id) {
					$service_id = $service->service_id;	

					$disabled = '';
					$checked = '';
					$img = '';
					if($service->status) {
						$disabled = 'disabled';
						$checked = 'checked'; 
					}
					
					$preview = '';
					if($service->completed) { 
						$img = '<img src="images/apply.png" style="width:20px;"/> &nbsp;&nbsp;';
						$img = '<a href="' . Url::to(['investor/services', 'project_id' => $project->id, 'serviceid' => $service_id, 'action' => 'view']) . '">Draft</a>';
						
						//$preview = ' <a href="' . Url::to(['investor/services', 'project_id' => $project->id, 'serviceid' => $service_id, 'action' => 'view']) . '">Preview</a>';
					}
					else {
						
						//$img = '<a href="' . Url::to(['investor/services', 'project_id' => $project->id]) . '" class="btn btn-primary">Apply Services</a>';
					}
					?>
				<?php 
					$service_name = '';	
					if(isset($services[$service_id]['name'])) { $service_name =  $services[$service_id]['name']; } 

					$pre_oper_service_table .= '<div class="row"  style="padding:10px 0px;"> 
						<div class="col-lg-1 col">'.$i.'</div> 
						<div class="col-lg-7 col">'.$service_name.'</div>  
						<div class="col-lg-2 col"> 
							 <input type="checkbox" name="services[]" value="'.$service_id.'" '.$disabled.' '.$checked.'/> 
							&nbsp;&nbsp;'.$img.'
						</div> 
						<div class="col-lg-1 col"> 
							' . $preview . '
						</div>
				   </div>';  
					$i++; 
				}
		}
		endforeach; 
	}
} 
$pre_operational_servicelist = '';
if($pre_oper_service_table) { 
		$pre_operational_servicelist = '<form method="post">
		 <input type="hidden" name="project" value="'.$project->id.'"/> 
		 <input type="hidden" name="type" value="preoperational-service"/> 
		<div>
			<div class="row">&nbsp;<br></div>
			<div><strong>List of Services to apply:</strong> </div>
			<div class="row"> 
				<div class="col-lg-1 col"><strong>#</strong> </div>
				<div class="col-lg-7 col"><strong>Service Name</strong> </div> 
				<div class="col-lg-2 col text-center"><strong>Applied</strong> </div> 
				<div class="col-lg-1 col text-center"><strong>Preview</strong> </div> 
			</div>
			 '. $pre_oper_service_table .'
			 <div class="row"> 
				<div class="col-lg-1 col"></div>
				<div class="col-lg-7 col">&nbsp;<br><a href="' . Url::to(['caf/cafservices', 'projectId' => $project->id]) . '">Preview</a></div> 
				<div class="col-lg-2 col"><input type="submit" value="Apply"class="btn btn-primary"/></div>
			</div>
			<p>&nbsp;<br>&nbsp;<br></p>
		</div>
             <input type="hidden" name="_csrf" value="' . Yii::$app->request->getCsrfToken() . '" />
		</form>'; 
}


$next_step = '';
if($status != 'Pending') {
	$next_step = '&nbsp;<br>&nbsp;<br><div class="row">
							<div class="col-lg-12">
							<h3 data-toggle="collapse" data-target="#demo'.$project->id.'" style="cursor:pointer;">Do you have land ?</h3> 
							</div> 
						</div> 

						<div id="demo'.$project->id.'" class="collapse in	box-content">

							<fieldset style="border:1px solid #c0c0c0;padding:20px;">
							  <legend style="width:auto;margin:0px;border-bottom:0px;">Pre Establishment Services:</legend> 
								<div class="row">
									<div class="col-lg-12"><a href="' . Url::to(['wizard/prestablish', 'id' => $project->id]) . '">Apply Through Wizard</a> OR <a href="' . Url::to(['caf/services-manual', 'projectId' => $project->id, 'type' => 'pre-establishment']) . '">Apply Manually</a></div>
								</div>';

		if($servicelist) {
		 $next_step .=  '<div class="row">
									<div class="col-lg-12">Application Number : 0000'.$project->id.'&nbsp;&nbsp;<a href="' . Url::to(['caf/index', 'projectId' => $project->id]) . '"><img src="images/view.png" style="width:20px;"/></a></div>
								</div>
								<div class="row">
									<div class="col-lg-12">Services</div>
								</div>
								<div class="row">
									<div class="col-lg-12">'.$servicelist.'</div>
								</div>';
		}

		 $next_step .=  '</fieldset>	
						</div>';



		if($pre_est_service_table) {
			$next_step .= '<div id="demo" class="collapse in">
							<fieldset style="border:1px solid #c0c0c0;padding:20px;">
							  <legend style="width:auto;margin:0px;border-bottom:0px;">Pre Operational Services:</legend> 
								<div class="row">
									<div class="col-lg-12"><a href="' . Url::to(['wizard/pre-operational', 'id' => $project->id]) . '">Apply Through Wizard</a> OR <a href="' . Url::to(['caf/services-manual', 'projectId' => $project->id, 'type' => 'pre-operational']) . '">Apply Manually</a></div>
								</div>';

			if($pre_operational_servicelist) {
				 $next_step .=  '<div class="row">
										<div class="col-lg-12">Application Number : 0000'.$project->id.'&nbsp;&nbsp;<a href="' . Url::to(['caf/index', 'projectId' => $project->id]) . '"><img src="images/view.png" style="width:20px;"/></a></div>
									</div>
									<div class="row">
										<div class="col-lg-12">Services</div>
									</div>
									<div class="row">
										<div class="col-lg-12">' . $pre_operational_servicelist . '</div>
									</div>';
			}

			 $next_step .=  '</fieldset>	
							</div>';
		}
}


$items[] =array(
            'label' => $project->project,
            'content' => '
						<div class="ibox-content">
						<div class="row">
							<div class="col-lg-2">Project Name: </div>
							<div class="col-lg-10">' . $project->project . '<a href="'.Url::to(['project/view', 'projectId' => $project->id]).'"/>&nbsp;&nbsp;<img src="images/view.png" style="width:20px;"/></a></div>
						</div>
						<div class="row">
							<div class="col-lg-2">Project Id: </div>
							<div class="col-lg-10"> ' . $project->id . '</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Details: </div>
							<div class="col-lg-10"> '.$project->project_details.'</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Sector: </div>
							<div class="col-lg-10"> '.$project->sector.' </div>
						</div><!-- 
						<div class="row">
							<div class="col-lg-2">New/Existing: </div>
							<div class="col-lg-10"> '.$project->type.' project </div>
						</div> -->
						<div class="row">
							<div class="col-lg-2">Status: </div>
							<div class="col-lg-10"> '.$status.'</div> 
						</div> 
						' . $next_step . '</div>',
            'active' => false, 
			'options' => ['id' => $project->id],
        );

	endforeach; 

	echo Tabs::widget([
		'items' => $items 
	]);

  } 
}
?>
&nbsp;<br>
&nbsp;<br>

        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                            <br>
                                            All sales: 162,862
                                        </span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>

                        <div class="m-t-sm">

                            <div class="row">
                                <div class="col-md-8">
                                    <div>
                                        <canvas id="lineChart" height="165" width="436" style="width: 436px; height: 165px;"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 48%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                                Update on 16.07.2015
                            </small>
                            <small>
                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                            </small>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>

        <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Projects </h5> 
        </div>
        <div class="ibox-content"> 
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Project </th>
                        <th>Name </th>
                        <th>Sector</th>
                        <th>District </th>
                        <th>Completed </th>
                        <th>Task</th>
                        <th>Commencement Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

			<?php		
			
if(isset($investor_projects)) {
	if(count($investor_projects)) {
		$i = 1;
		foreach ($investor_projects as $project) {   ?>

				  <tr>
                        <td><?= $i?></td>
                        <td><a href="<?= Url::to(['project/view', 'projectId' => $project->id]) ?>"><?= $project->project; ?></a></td>
                        <td><?= $project->investor_name; ?></td>
                        <td><?= $project->sector; ?></td>
                        <td><?= $project->district; ?></td>
                        <td><span class="pie" style="display: none;">0.52/1.561</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 14.933563796318165 11.990700825968545 Z" fill="#1ab394"></path><path d="M 8 8 L 14.933563796318165 11.990700825968545 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td>20%</td>
                        <td><?= $project->commencement_date; ?></td>
                        <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                    </tr>
			<?php
			$i++;
		}
	}
}


					?> 
                    </tbody>
                </table>
            </div>

        </div>
        </div>
        </div>

        </div>


        </div>

<?php


 
$this->registerCssFile(
    '//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css',
    [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()], 
], 'css-style-services');


$this->registerJsFile(
    '//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


 
$this->registerJs(
' 
 $("#start-new-business").on("click", function () {
 			$.confirm({
					title: "Do You Have Land?",
					content: "Its you must have land before proceeding to project approvals",
					 icon: "fa fa-question-circle",
					 animation: "scale",
					 closeAnimation: "scale",
                     opacity: 0.5,
                     buttons: {
                                "confirm": {
                                    text: "Yes, Proceed",
                                    btnClass: "btn-blue",
                                    action: function () {
                                        $.confirm({
                                            title: "This maybe critical",
                                            content: "You have to fill the land details too.",
                                            icon: "fa fa-warning",
                                            animation: "scale",
                                            closeAnimation: "zoom",
                                            buttons: {
                                                confirm: {
                                                    text: "Yes, sure!",
                                                    btnClass: "btn-orange",
                                                    action: function () { 
														window.location.href = "index.php?r=project/add"
                                                    }
                                                },
                                                NO: function () {
                                                    $.alert("you clicked on <strong>cancel</strong>");
                                                }
                                            }
                                        });
                                    }
                                },
                                No: function () {
                                    $.alert("Please apply for land from AKVN land");
                                }, 
                            }
				});

		});
', View::POS_READY, 'my-button-handler');

?>