<?php

class UrlShorteningCest {    
    public function shortenURL(\FunctionalTester $I) {
        $I->amOnRoute('/site');
        $I->see(Yii::$app->params['siteName'], 'h1');
        $I->see("Shorten a URL");

        $I->fillField('Shortened[redirect_url]', 'https://www.google.com');
        $I->click('Submit');

        $I->see("https://www.google.com");

        $I->click('Update redirect location');
        $I->see("Update Shortened");

        $I->fillField('Shortened[redirect_url]', 'https://www.yahoo.com');
        $I->click('Submit');

        $I->see("https://www.yahoo.com");
    }
}