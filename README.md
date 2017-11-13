tradeTrackerTest
================

Symfony3 + AngularJs + Bootstrap4 Implementation [DEMO](http://45.55.183.216/app.php/)

[AngularJs Implementation](https://github.com/arun123/tradeTrackerTest/tree/master/src/AppBundle/Resources/public/js/app)

please run the following command to dump the asset file

php bin/console assets:install --symlink web


Used XMLReader to keep the memory consumption minimum, seperated the Product Parsing to a [service class](https://github.com/arun123/tradeTrackerTest/blob/master/src/AppBundle/Service/ProductParser.php)

[test files](https://github.com/arun123/tradeTrackerTest/tree/master/tests/AppBundle)