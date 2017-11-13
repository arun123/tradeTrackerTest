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

    public function testparseDocumentAttribute()
    {
        $client = static::createClient();

        $productParser = $this->container->get(ProductParser::class);
        $document = $productParser->loadXML('http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=1');
        $products = $productParser->parseDocument($document);

        $this->assertCount(1, $products);

        $this->assertAttributeNotEmpty('name', $products[0]); 
        $this->assertAttributeNotEmpty('description', $products[0]); 
        $this->assertAttributeNotEmpty('imageURL', $products[0]);
        $this->assertAttributeNotEmpty('productURL', $products[0]);  
        $this->assertAttributeNotEmpty('price', $products[0]); 
        $this->assertAttributeNotEmpty('currency', $products[0]); 

    }

}
