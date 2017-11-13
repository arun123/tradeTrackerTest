<?php
namespace AppBundle\Service;

class ProductParser
{
    public function loadXML($file)
    {
        $reader = new \XMLReader(); 
        $reader->open($file);
        return $reader;
    }

    public function parseDocument($document) 
    {
        $products = array();
        while($document->read())
        {
            if('product' === $document->name && $document->nodeType === \XMLReader::ELEMENT )
            {
                $product = new \stdClass;
                while($document->read())
                {
                    if('product' === $document->name && $document->nodeType === \XMLReader::END_ELEMENT) // fetch all the tags until the end of product tag
                    {
                        array_push($products, $product);
                        unset($product);
                        break;
                    }
                    switch($document->nodeType) // we can create rules here for different type of tags
                    {
                        case \XMLReader::ELEMENT:
                            if ($document->name == 'price') {
                                $property = 'currency';
                                $product->{$property} =$document->getAttribute('currency');;
                            }
                            $property = $document->name;
                            $product->{$property} = '';
                            break;
                        case \XMLReader::TEXT:

                            if(isset($property)) {
                                if( null !== $property  ){
                                    $product->{$property} = $document->value;
                                    $property = null;
                                }
                            } 
                            break;
                        case \XMLReader::CDATA:

                            if(isset($property)) {
                                if( null !== $property  ){
                                    $product->{$property} = $document->value;
                                    $property = null;
                                }
                            } 
                            break;
                    }
                }
            }
        }
        $document->close();

        return $products;
    }

}