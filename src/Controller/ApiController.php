<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;


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
    public function add_routes($klein)
    {
        foreach($this->routes as $uri => $function) {
            $method = null;
            if(stristr($uri, ":")) {
                $parts = preg_split("/:/", $uri, 2);
                $method = $parts[0];
                $uri = $parts[1];
            }
            $complete = $this->prefix . $uri;
            if($method != null) {
                $klein->respond($method, $complete, [$this, $function]);
            } else {
                $klein->respond($complete, [$this, $function]);
            }
        }
    }

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
                    $appliance = AppliancesQuery::create()->limit(1)->findById($request->sid);
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