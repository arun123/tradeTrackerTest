<?php

namespace AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Service\ProductParser;

class ProductParserTest extends WebTestCase
{
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testparseDocument()
    {
        $client = static::createClient();

        $productParser = $this->container->get(ProductParser::class);
        $document = $productParser->loadXML('http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10');
        $products = $productParser->parseDocument($document);

         $this->assertCount(10, $products);
    }



}
