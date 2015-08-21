<?php
    /**
    *@backupGlobals disabled
    *@backupStatic Attributes disabled
    */

    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $db = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function test_getStylistName()
        {
            //Arrange
            $stylist_name = "Sue";
            $test_stylist = new Stylist($stylist_name);

            //Act
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function test_getStylistId()
        {
            //Arrange
            $stylist_name = "Sue";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_name, $stylist_id);

            //Act
            $result = $test_stylist->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }

?>
