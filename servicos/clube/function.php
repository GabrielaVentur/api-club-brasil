<?php
require '../../inc/dbcon.php';

function error404($message){
    $data=[
        'status' => 400,
        'message' => $message,
    ];
    header('HTTP/1.0 400 Error no request');
    return json_encode($data);
}

function cadastrar($inputData){
    global $conn;

    $clube = mysqli_real_escape_string($conn, $inputData['clube']);
    $saldoDisponivel =  mysqli_real_escape_string($conn, $inputData['saldo_disponivel']);
    
    if(empty(trim($clube))){
        return error400('O nome do clube é obrigatorio');
    }
    if(empty(trim($saldoDisponivel))){
        return error400('O saldo é obrigatorio');
    }

    $saldoDisponivel = str_replace(",",".",$saldoDisponivel);
    $saldoDisponivel = floatval($saldoDisponivel );

    $query = "INSERT INTO clube(clube, saldo_disponivel) values ('$clube','$saldoDisponivel')";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run){

        $data=[
            'status' => 200,
            'message' => 'Clube criado',
        ];
        header('HTTP/1.0 200 Lista de clubes');
        return json_encode($data);
    }
    else{
        $data=[
            'status' => 500,
            'message' => 'Error no servidor',
        ];
        header('HTTP/1.0 500 Error no servidor');
        return json_encode($data);
    }
}


function obterTodosClubes(){
    global $conn;
    $query = 'SELECT *FROM clube';
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        if(mysqli_num_rows($query_run)>0){
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data=[
                'status' => 200,
                'message' => 'Lista de clubes',
                'data' => $res
            ];
            header('HTTP/1.0 200 Lista de clubes');
            return json_encode($data);
        }
        else{
            $data=[
                'status' => 404,
                'message' => 'Não existe dados',
            ];
            header('HTTP/1.0 404 Não existe dados');
            return json_encode($data);
        
        } 
    }
    else{
        $data=[
            'status' => 500,
            'message' => 'Error no servidor',
        ];
        header('HTTP/1.0 500 Error no servidor');
        return json_encode($data);
    }
}
?>