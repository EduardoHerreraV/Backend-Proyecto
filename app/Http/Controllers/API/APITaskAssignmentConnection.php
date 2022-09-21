<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class APITaskAssignmentConnection extends Controller
{

  public function getTasksByRFC(Request $request)
  {
    try {
      $p_sessionId = $this->APIlogin();
     //  echo $p_sessionId;
      $json_sessionId = json_decode($p_sessionId);

       //echo "----------------------------------------------------------------------";

      $obj = $this->createRead($request);
      //echo $obj;
      //echo "-------------------------Finalicz OBJ---------------------------------------------";
      $token = $json_sessionId->{'sci_token'};
      // var_dump($token);
      //echo "--------------------------Finaliza Token--------------------------------------------";
      //echo "--------------------------Finaliza Token--------------------------------------------";
      $obj = json_encode($obj);
      $resultado = $this->APIconsultar($token, $obj);
    $resultado=json_decode($resultado);


      return $resultado;

    } catch (\Exception $e) {
      return $e->getMessage();
    }


  }

  public function createRead($request)
  {
    //return $request;

    $search = $request->input('search');


    $arr2 = [
      'search' => $search,
    ];


    $arr2 = json_encode($arr2);

    return $search;


  }

  public function APIlogin()
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://25.53.17.95:8000/api/login',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
    "username": "marcosp",
    "password": "12345678"
    }',
      CURLOPT_HTTPHEADER => array(
        'api-version: 8',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }

  public function APIconsultar($JsessionID, $obj)
  {
    $JsessionID=(string)$JsessionID;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://25.53.17.95:8000/api/get-task-assignments',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $obj,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $JsessionID . '',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}
