<?php
    class Client
    {
        private $client_name;
        private $phone;
        private $stylist_id;
        private $client_id;

        function __construct ($client_name, $phone, $stylist_id, $client_id = null)
        {
            $this->client_name = $client_name;
            $this->phone = $phone;
            $this->stylist_id = $stylist_id;
            $this->client_id = $client_id;
        }
    }
 ?>
