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

    class StoreTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
        {
          Store::deleteAll();
          Brand::deleteAll();

        }

            function test_getName()
        {
            //Arrange
            $name = "Payless";
            $id = null;

            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Payless";
            $id = null;

            $test_store = new Store($name, $id);
            $test_store->save();
            //Act
            $result = Store::getAll();
            //assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Payless";
            $id = null;
            $test_store = new Store($name, $id);
            $test_store->save();
            $name2 = "Foot Locker";
            $id2 = null;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_find()
        {
            $name = "Payless";
            $id = null;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "Foot Locker";
            $id2 = null;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();
            //Act
            $result = Store::find($test_store->getId());
            //assert
            $this->assertEquals($test_store, $result);

        }

        function test_addBrand()
        {
            $id = null;
            $name = "Keds";
            $test_Brand = new Brand($name, $id);
            $test_Brand->save();

            $id1 = null;
            $name1 = "Payless";
            $test_store = new Store($name1, $id1);
            $test_store->save();

            $test_store->addBrand($test_Brand);
            // var_dump($test_store);
            $result = $test_store->getBrand();

            $this->assertEquals([$test_Brand], $result);

        }



    }
?>
