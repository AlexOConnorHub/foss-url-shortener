<?php
namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use app\models\Visit;
use Yii;

class VisitJob extends BaseObject implements JobInterface {
    public $shortened_id;
    public $visit_id;
    private $url = 'https://api.iplocation.net?ip=';
    
    public function execute($queue) {
        $visit = Visit::findOne(['id' => $this->visit_id]);
        if ($visit === null) {
            return;
        }
        $response = file_get_contents($this->url . $visit->ip);
        $response = json_decode($response);
        $visit->country_code = $response->country_code2;
        $visit->isp = $response->isp;
        $visit->save();
    }
}