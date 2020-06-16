<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class GrafanaController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return "Ok";
    }

    /**
     * @return array
     */
    public function search()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return response()->json(['version' => Config::get('version.value')]);
    }

    /**
     * @return mixed
     */
    public function annotations(Request $request)
    {
        $json       = $request->json();
        $annotation = $json->get('annotation');
        $range      = $json->get('range');

        return $this->getRangeValues($range, 'PT' . $annotation['query'] . 'H');
    }

    private function getRangeValues($range, $int)
    {
        $tz   = new \DateTimeZone('Europe/Madrid');
        $from = \DateTimeImmutable::createFromFormat("Y-m-d\TH:i:s.uP", $range['from'], $tz);
        $to   = \DateTimeImmutable::createFromFormat("Y-m-d\TH:i:s.uP", $range['to'], $tz);

        $annotation = [
            'name'       => $int,
            'enabled'    => true,
            'datasource' => "xproject datasource",
            'showLine'   => true,
        ];

        $interval = new \DateInterval($int);
        $period   = new \DatePeriod($from, $interval, $to->add($interval));

        $annotations = [];
        foreach ($period as $date) {
            $annotations[] = ['annotation' => $annotation, "title" => "H " . $date->format('H'), "time" => strtotime($date->format('Y-m-d H:i:sP')) * 1000, 'text' => "teeeext"];
        }

        return $annotations;
    }
}
