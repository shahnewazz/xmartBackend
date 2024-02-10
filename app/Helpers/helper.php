<?php


function send_msg($msg, $status, $code){
    $res = [
        'status' => $status,
        'message' => $msg,
    ];
    
    return response()->json($res, $code);
}