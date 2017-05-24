<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;

use Illuminate\Database\Capsule\Manager as Capsule;

use Klein\Request;
use Klein\Response;
use Me\Exceptions\NotAuthedException;
use Me\Services\AuthService;

class ApiController extends Controller
{
    protected $prefix = "/api/";
    protected $routes = [
        "GET:version" => "show_version",
        "GET:status" => "get_status"
    ];

    public function show_version() {
        return json_encode(['version'=>'0.0.1']);
    }

    /**
     * @param $request Request
     * @param $response Response
     * @return string Response
     */
    public function get_status($request, $response) {
        try {
            return AuthService::authenticate(function ($request, $response) {
                if (isset($request->aid)) {
                    $appliance = Capsule::table("appliances");
                    if(!empty($appliance)) {
                        return json_encode(['error'=>null, $request->sid => $appliance[0]->getLastping()]);
                    } else {
                        $response->code(404);
                        return json_encode(['error' => 'appliance not found']);
                    }
                } else {
                    $response->code(400);
                    return json_encode(['error' => 'missing parameter sid']);
                }
            }, [$request, $response]);
        } catch(NotAuthedException $e) {
            return json_encode(['error'=>'authentication required']);
        }
    }

    public function put_appliance($request, $response) {
        //
    }
}