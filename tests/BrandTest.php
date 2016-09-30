<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

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
        function test_find()
        {
            //arrange
            $id = null;
            $name = "Keds";
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $id1 = null;
            $name1 = "Red Wing";
            $test_Brand1 = new Brand($name, $id);
            $test_Brand1->save();
            //act
            $result = Brand::find($test_Brand->getId());
            //assert
            $this->assertEquals($test_Brand, $result);
        }
        function test_addStore()
        {
            $id = null;
            $name = "Keds";
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $id1 = null;
            $name1 = "Payless";
            $test_store = new Store($name, $id);
            $test_store->save();

            $test_Brand->addStore($test_store);
            $result = $test_Brand->getStore();
            $this->assertEquals([$test_store], $result);

        }
        function test_getStores()
        {
            $id = null;
            $name = "Keds";
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $id = null;
            $store_name = "payless";
            $test_store = new Store($name, $id);
            $test_store->save();

            $result = $test_Brand->getStores();

            $this->assertEquals($test_store, $result);
        }

    }

  ?>
