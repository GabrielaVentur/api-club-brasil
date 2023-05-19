<?php
require '../../inc/dbcon.php';

function error400($message){
    $data=[
        'status' => 400,
        'message' => $message,
    ];
    header('HTTP/1.0 400 Error no request');
    return json_encode($data);
}

function consumirRecurso($inputData){
    global $conn;

    $clubeId = mysqli_real_escape_string($conn, $inputData['clube_id']);
    $recursoId =  mysqli_real_escape_string($conn, $inputData['recurso_id']);
    $valorConsumo =  mysqli_real_escape_string($conn, $inputData['valor_consumo']);
    

    if(empty(trim($clubeId))){
        return error400('O clube_id é obrigatorio');
    }
    if(empty(trim($recursoId))){
        return error400('O recurso_id é obrigatorio');
    }
    if(empty(trim($valorConsumo))){
        return error400('O valor_consumo é obrigatorio');
    }

    $clubeId = intval($clubeId);
    $recursoId = intval($recursoId);
    $valorConsumo = str_replace(",",".",$valorConsumo);
    $valorConsumo = floatval($valorConsumo);
    
    $clube = getDadosClube($clubeId);
    $recurso = getDadosRecurso($recursoId);


    if($valorConsumo >  $clube['saldo_disponivel']){
        $data=[
            "message" => "O saldo disponível do clube é insuficiente."
        ];
        header('HTTP/1.0 400 não pode consumir o recurso');
        return json_encode($data);
    }
    else{
        $valorAnteriorClube =  $clube['saldo_disponivel'];
        $valorAtualClube =  $clube['saldo_disponivel'] - $valorConsumo;
        $atualizoClube = atualizarSaldoClube($clubeId, $valorAtualClube);

        $valorAtualRecurso = $recurso['saldo_disponivel'] - $valorConsumo;
        $atualizoRecurso = atualizarSaldoRecurso($recursoId, $valorAtualRecurso);

        if($atualizoClube && $atualizoRecurso){
            $data=[
                "clube" =>  $clube['clube'],
                "saldo_anterior" => $valorAnteriorClube,
                "saldo_atual" => $valorAtualClube 
            ];
            header('HTTP/1.0 200 Consumo OK');
            return json_encode($data);
        }
    }
}

function atualizarSaldoClube($clubeId, $novoSaldo){
    global $conn;

    $query = "UPDATE clube SET saldo_disponivel = $novoSaldo where id = '$clubeId'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        return true;
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

function atualizarSaldoRecurso($recursoId, $novoSaldo){
    global $conn;

    $query = "UPDATE recurso SET saldo_disponivel = $novoSaldo where id = '$recursoId'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        return true;
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

function getDadosClube($clubeId){
    global $conn;
    $query = "SELECT *FROM clube where id = '$clubeId'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $res = mysqli_fetch_assoc($query_run);
        return $res;       
    }
}

function getDadosRecurso($recursoId){
    global $conn;
    $query = "SELECT *FROM recurso where id = '$recursoId'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $res = mysqli_fetch_assoc($query_run);
        return $res;       
    }
}