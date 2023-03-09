<?php
namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class VisitFixture extends ActiveFixture {
    public $modelClass = 'app\models\Visit';
    public $dataFile = '@app/tests/fixtures/_data/visit.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\ShortenedFixture',
    ];
}