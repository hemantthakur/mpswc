<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';
 
$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/api/services', function (Request $request, Response $response) {
	
	$sql="select json from yii_investor_project_detail";
	try{
		$db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
		$services = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
//echo '<pre>'; print_r($services);
		echo json_encode($services);
	}
	catch(PDOException $e) {
		
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});


//----------------------
$app->get('/api/service/{id}', function (Request $request, Response $response) {

	$id = $request->getAttribute('id');
	$sql="select json from yii_investor_project_detail where id = ".$id;
	try{
		$db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
		$service = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo $service[0]->json;
	}
	catch(PDOException $e) {
		echo '{"error":{"text":'.$e->getMessage().'}';
	}
});


$app->post('/api/service/add', function (Request $request, Response $response) {
	$firstname = $request->getParam('firstname');
	$lastname = $request->getParam('lastname');
		 $sql = "INSERT INTO customers (first_name,last_name,phone,email,address,city,state) VALUES
    (:first_name,:last_name,:phone,:email,:address,:city,:state)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name',  $last_name);
        $stmt->bindParam(':phone',      $phone);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':address',    $address);
        $stmt->bindParam(':city',       $city);
        $stmt->bindParam(':state',      $state);
        $stmt->execute();
        echo '{"notice": {"text": "Customer Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update Customer
$app->put('/api/customer/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $address = $request->getParam('address');
    $city = $request->getParam('city');
    $state = $request->getParam('state');
    $sql = "UPDATE customers SET
				first_name 	= :first_name,
				last_name 	= :last_name,
                phone		= :phone,
                email		= :email,
                address 	= :address,
                city 		= :city,
                state		= :state
			WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name',  $last_name);
        $stmt->bindParam(':phone',      $phone);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':address',    $address);
        $stmt->bindParam(':city',       $city);
        $stmt->bindParam(':state',      $state);
        $stmt->execute();
        echo '{"notice": {"text": "Customer Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//services
//require '../src/routes/services.php';

$app->run();