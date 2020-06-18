<?php

namespace NixEnterprise\GrafanaDatasource\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class GrafanaController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(null, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        return response()->json(['version']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function query()
    {
        $version = Config::get('version.value') ? Config::get('version.value') : 'Unknown version';
        $data = [[
            'type' => 'table',
            "columns" => [
                ["text" => "Version", "type" => "string"]
            ],
            "rows" => [
                [$version]
            ]
        ]];

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function annotations()
    {
        return response()->json([]);
    }
}
