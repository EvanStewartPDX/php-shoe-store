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
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
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
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
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

            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
        }
        function getBrand()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN brands_stores ON ( stores.id = brands_stores.store_id) JOIN brands ON (brands.id = brands_stores.brand_id) WHERE stores.id={$this->getId()};");

            $brands = array();
            foreach($returned_brands as $brand){
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function notBrand()
        {
            $allbrands = Brand::getAll();
            $assignedbrands = $this->getBrand();

            $nonBrands = array();
            foreach($allbrands as $brand){
                if(!in_array($brand, $assignedbrands))
                {
                    $name = $brand->getName();
                    $id = $brand->getId();
                    $new_brand = new Brand($name, $id);
                    array_push($nonBrands, $new_brand);
                }
            }
            return $nonBrands;

        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name ='{$new_name}' WHERE id={$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id={$this->getId()}");
        }
    }
 ?>
