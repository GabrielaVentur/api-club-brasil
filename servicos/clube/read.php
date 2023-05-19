<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json*');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers');

include('function.php');

$method = $_SERVER['REQUEST_METHOD'];

if($method=='GET'){
    $clube_list = obterTodosClubes();
    echo $clube_list;
}
else{
    $data=[
        'status' => 405,
        'message' => $method. 'Metodo não permitido',
    ];
    header('HTTP/1.0 405 Methodo nao permitido');
    echo json_encode($data);
}
?>