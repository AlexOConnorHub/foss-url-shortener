<?php
namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class ShortenedFixture extends ActiveFixture {
    public $modelClass = 'app\models\Shortened';
    public $dataFile = '@app/tests/fixtures/_data/shortened.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
    ];
}