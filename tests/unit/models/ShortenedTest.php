<?php

namespace tests\unit\models;

use app\models\Shortened;
use app\models\Visit;

class ShortenedTest extends \Codeception\Test\Unit {
    public function _fixtures() {
        return [
            'Shortened' => [
                'class' => \app\tests\fixtures\ShortenedFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/shortened.php',
            ],
            'Visit' => [
                'class' => \app\tests\fixtures\VisitFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/visit.php',
            ],
            'User' => [
                'class' => \app\tests\fixtures\UserFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/user.php',
            ],
        ];
    }

    public function testVisitCount() {
        $shortened = Shortened::findOne(1);
        $this->assertEquals(1, $shortened->id);
        $this->assertEquals(2, count($shortened->visits));

        $shortened = Shortened::findOne(2);
        $visits = $shortened->getVisits()->all();
        $count = count($visits);
        $this->assertEquals(1, $count);
    }

    public function testUser() {
        $shortened = Shortened::findOne(1);
        $this->assertEquals(1, $shortened->user->id);
        $this->assertEquals("admin", $shortened->user->username);
    }

    public function testUrl() {
        $shortened = Shortened::findOne(1);
        $this->assertEquals("http://example1.com", $shortened->redirect_url);

        $this->assertContains("r", explode('/', $shortened->url));
        $this->assertContains($shortened->redirect_uuid, explode('/', $shortened->url));
    }
}
