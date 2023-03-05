<?php

namespace tests\unit\models;

class ShortenedTest extends \Codeception\Test\Unit {
    public function _fixtures() {
        return [
            'Shortened' => [
                'class' => \app\tests\fixtures\ShortenedFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/shortened.php',
            ],
        ];
    }

    public function testRedirect() {
    }
}
