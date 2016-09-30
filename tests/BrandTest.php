<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoe_store_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
      // protected function tearDown()
      //   {
      //     Brand::deleteAll();
      //   }
        function test_getName()
        {
            //Arrange
            $id = null;
            $name = "History";

            $test_Brand = new Brand($name, $id);

            //Act
            $result = $test_Brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }

  ?>
