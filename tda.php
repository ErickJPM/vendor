<?php 
//Creamos la coneccion con mongoDb atlas
	require_once __DIR__ . '/vendor/autoload.php';
	$mongo = new  MongoDB\Client("mongodb+srv://root:root@cluster0.dzh7l.mongodb.net/Estudiantes?retryWrites=true&w=majority");
	$collection = ($mongo)->Estudiantes->Estudiantes;
    $action = $_POST["action"];

    if("SELECT_TABLE" == $action){
        $database_data = array(); 
        $cursor = $collection->find();
        if($cursor!=null){
            foreach ($cursor as $document){
                $database_data[]=$document;
            }
            echo json_encode($database_data );
        }else{
            echo "error";
        }
    }
    if("SELECT_TABLE_E" == $action){
        $password = $_POST["password"];
        $correo = $_POST["correo"];
        $database_data = array(); 
        $cursor = $collection->find(["password"=>$password,"correo"=>$correo]);
        if($cursor!=null){
            foreach ($cursor as $document){
                $database_data[]=$document;
            }
            echo json_encode($database_data );
        }else{
            echo "error";
        }
    }
    if("INSERT_DATA" == $action){
        $_id = $_POST["_id"];
        $password = $_POST["password"];
        $correo = $_POST["correo"];
        $insertOneResult = $collection->insertOne([
            "_id"=>$_id,
            "password"=>$password,
            "correo"=>$correo,
        ]);
        echo "success";            
        return;
    }
    if("DELETE_DATA" == $action){
        $_id = $_POST["_id"];
        $deleteResult = $collection->deleteOne(["_id" => $_id]);
        echo "success";            
        return;
    }
    if("UPDATE_DATA" == $action){
        $_id = $_POST["_id"];
        $password = $_POST["password"];
        $correo = $_POST["correo"];
        $collection->updateOne(
            ["_id" => $_id], 
            ['$set' =>
                [
                "password"=>$password,
                "correo"=>$correo,
                ]
            ]
        );
        echo "success";            
        return;
    }
?>