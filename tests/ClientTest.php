<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        function test_getClientName()
        {

        //Arrange
        $client_name = "Ike";
        $phone = "1234567890";
        $stylist_id = 1;
        $client_id = null;
        $test_client = new Client($client_name, $phone, $stylist_id, $client_id);

        //Act
        $result = $test_client->getClientName();

        //Assert
        $this->assertEquals($client_name, $result);
        }

        function test_getPhone()
        {

        //Arrange
        $client_name = "Ike";
        $phone = "1234567890";
        $stylist_id = 1;
        $client_id = null;
        $test_client = new Client($client_name, $phone, $stylist_id, $client_id);

        //Act
        $result = $test_client->getPhone();

        //Assert
        $this->assertEquals($phone, $result);
        }



    }






    ?>
