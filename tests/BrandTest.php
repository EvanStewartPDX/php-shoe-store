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
      protected function tearDown()
        {
          Brand::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $id = null;
            $name = "Keds";

            $test_Brand = new Brand($name, $id);

            //Act
            $result = $test_Brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            $id = null;
            $name = "Keds";

            $test_Brand = new Brand($name, $id);

            //Act
            $result = $test_Brand->getId();

            //Assert
            $this->assertEquals($id, $result);

        }
        function test_save()
        {
            //Arrange
            $name = "Keds";

            $test_Brand = new Brand($name);
            $test_Brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_Brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "Keds";
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $id1 = null;
            $name1 = "Red Wing";
            $test_Brand1 = new Brand($name, $id);
            $test_Brand1->save();
            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_Brand, $test_Brand1], $result);

        }

    }

  ?>
