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

    //sets properties to assigned input types
        function setClientName($new_client_name)
        {
            $this->client_name = (string) $new_client_name;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function getClientId()
        {
            return $this->client_id;
        }
    }
 ?>
