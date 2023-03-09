<?php

namespace tests\unit\models;

use app\models\Visit;

class VisitTest extends \Codeception\Test\Unit {
    public function _fixtures() {
        return [
            'Visit' => [
                'class' => \app\tests\fixtures\VisitFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/visit.php',
            ],
        ];
    }

    public function testFieldsFilled() {
        $visit = Visit::findOne(1);
        $this->assertEquals(1, $visit->id);
        $this->assertNull($visit->shortened_id);
        $this->assertNotNull($visit->created_at);
        $this->assertNotNull($visit->accepted_languages);
        $this->assertNotNull($visit->user_agent);
        $this->assertNotNull($visit->ip);
    }
}
