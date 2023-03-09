<?php

class BasicPageNavigationCest {
    public function openAboutPage(\FunctionalTester $I) {
        $I->amOnRoute('/site/about');
        $I->see("About", 'h1');
    }

    public function openHomePage(\FunctionalTester $I) {
        $I->amOnRoute('/site');
        $I->see(Yii::$app->params['siteName'], 'h1');
        $I->see("Shorten a URL");
    }
}