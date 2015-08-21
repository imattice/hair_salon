<?php
    class Stylist
    {
        private $stylist_name;
        private $stylist_id;

    //Stylist constructor
        function __construct($stylist_name, $stylist_id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->stylist_id = $stylist_id;
        }

    //getters and setters
        function setStylistName($new_stylist_name)
        {
            $this->name = (string) $new_stylist_name;
        }

        function getStylistName()
        {
            return $this->stylist_name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

    //save function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO t_stylists (name) VALUES ('{$this->getStylistName()}');");
            $this->stylist_id = $GLOBALS['DB']->lastInsertId();
        }

    //get all stylists function
        static function getAll()
        {
            $db_stylists = $GLOBALS['DB']->query("SELECT * FROM t_stylists;");
            $stylists = array();
            foreach ($db_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $stylist_id = $stylist['id'];
                $new_stylist = new Stylist($stylist_name, $stylist_id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;

        }

    //delete all stylists
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM t_stylists;");
        }

    }
 ?>
