<?php

class LoginController {


        public function view() {

            $result = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/WebProgramming-WebsiteforDrugStore/views/login.php', false);
            return $result;
        }

}
?>