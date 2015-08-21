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
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

//clears test database at the beginning of each test run
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

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

        function test_save()
        {
            //Arrange
            $stylist_name = "Sue";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $stylist_name = "Sue";
            $stylist_name2 = "Mike";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Sue";
            $stylist_name2 = "Mike";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $stylist_name = "Sue";
            $stylist_name2 = "Mike";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getStylistId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $stylist_name = "Sue";
            $stylist_id = null;
            $test_stylist = new Stylist($stylist_name, $stylist_id);
            $test_stylist->save();

            $new_stylist = "Susan";

            //Act
            $test_stylist->update($new_stylist);

            //Assert
            $this->assertEquals("Susan", $test_stylist->getName());
        }
    }

?>
