<?php
    class Brand
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
            $GLOBALS['DB']->exec("INSERT INTO brand (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brand;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brand;");
        }
        static function find($search_id)
        {
            $found_brands = null;
            $brands = Brand::getAll();
            foreach($brands as $brand){
                $brand_id = $brand->getId();
                if($brand_id == $search_id){
                    $found_brands = $brand;
                }
            }
            return $found_brands;
        }

        // function addStore()
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO brand_store (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId});");
        // }
        // function getStores()
        // {
        //
        //     $returned_stores = $GLOBALS['DB']->query("SELECT * FROM store WHERE {$this->getId()}";);
        //     $stores = array();
        //     foreach($returned_stores as $store){
        //         $name = $store['name'];
        //         $id = $store['id'];
        //         $new_store = new Store($name, $id);
        //         array_push($returned_stores, $new_store)
        //     }
        //     return $stores;
        // }

    }
 ?>
