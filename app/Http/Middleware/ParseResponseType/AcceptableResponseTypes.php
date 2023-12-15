<?php 

namespace App\Http\Middleware\ParseResponseType;

/**
* Essa enum representa os possíveis tipos de respostas suportados pela aplicação
*/
enum AcceptableResponseTypes: string {
    case TEXT = 'text/html; charset=UTF-8';
    case XML = 'application/xml';
    case JSON = 'application/json';
}