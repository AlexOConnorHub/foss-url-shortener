<?php

namespace tests\unit\models;

class VisitTest extends \Codeception\Test\Unit {
    public function _fixtures() {
        return [
            'Visit' => [
                'class' => \app\tests\fixtures\VisitFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/visit.php',
            ],
        ];
    }

    public function testWhoVisit() {
    }
}
