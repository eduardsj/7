<?php
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testNotValidIdInputValue():void
    {
        $this->expectException(InvalidArgumentException->class);
        Product->getPropertiesForProduct('sssss');
    }
}

?>