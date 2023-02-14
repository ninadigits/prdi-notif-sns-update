<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Notification;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;


class HomeController extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        return $this->respond([
            'app' => getenv('app.name'),
            'version' => getenv('app.version'),
            'createdAt' => getenv('app.createdAt'),
        ], 200);
    }

    public function testApi()
    {
        // -----------------------
        // Start Of : Test API GW Get Notif
        // ----------------------
        $url = $_ENV['api.getNotif'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '{}');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result);
        // $cntData = count($data->RESPONSE1);
        // print_r($cntData);
        // die;
        return $this->respondCreated($data);
    }
}
