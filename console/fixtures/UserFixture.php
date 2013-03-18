<?php

class UserFixture {

    public function load(){
        /* add demo users */
        $demoUser = new User();
        $demoUser->username = "demo";
        $demoUser->email = "demo@web-kmv.ru";
        $demoUser->password = "web-kmv-key1";
        $demoUser->save();

        $adminUser = new User();
        $adminUser->username = "admin";
        $adminUser->email = "admin@web-kmv.ru";
        $adminUser->password = "web-kmv-key2";
        $adminUser->save();
    }

}
