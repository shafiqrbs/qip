<?php

namespace App\Modules\Organization\Http\Controllers;
use App\Modules\Configuration\ConfigurationHelper;
use App\Http\Controllers\Controller;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests;

use Exception;
use GuzzleHttp\Psr7\Message;

use DB;
use Illuminate\Http\Request;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class ApiController extends Controller
{

//    public function __construct(Request $request)
//    {
//        ConfigurationHelper::Language();
//        global $access;
//        $requestDBName = $request->header('x-api-key');
//        $requestDBUserName = $request->header('x-api-value');
//        $requestDBPass = $request->header('x-api-secret');
//
//        $key = \config('api.key');
//        $value = \config('api.value');
//        $secret = \config('api.secret');
//
//        dd($key,$value,$secret);
//
//        if (($requestDBName == $key) && ($requestDBUserName == $value) && ($requestDBPass == $secret)){
//            $this->access = 'allow';
//        }else{
//            $this->access= 'Not allow';
//        }
//        echo $access;
//    }
//
    public function getalldata(){
        $raju =  'ok';
        return $raju;
//        return \response(
//            $raju
//        );
    }


}
