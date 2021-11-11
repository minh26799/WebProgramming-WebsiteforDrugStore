<?php

class RegisterController {


        public function view() {

            $result = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/WebProgramming-WebsiteforDrugStore/views/register.php', false);
            return $result;
        }

}
?>