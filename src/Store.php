<?php
    class Store
    {

        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }
        function getName()
        {
            return $this->name;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO store (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM store;");
            $stores = array();
            foreach($returned_stores as $store){
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM store;");
            $GLOBALS['DB']->exec("DELETE FROM brand_store;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store){
                $store_id = $store->getId();
                if($store_id == $search_id) {
                $found_store = $store;
                }
            }
            return $found_store;
        }

        function addBrand($brand)
        {

            $GLOBALS['DB']->exec("INSERT INTO brand_store (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
        }
        function getBrand()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brand.* FROM store JOIN brand_store ON ( store.id = brand_store.store_id) JOIN brand ON (brand.id = brand_store.brand_id) WHERE brand.id={$this->getId()};");

            $brands = array();
            foreach($returned_brands as $brand){
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE store SET name ='{$new_name}' WHERE id={$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM store WHERE id={$this->getId()}");
        }
    }
 ?>
