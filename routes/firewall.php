<?php

Route::group(['prefix' => '/firewall', 'middleware' => 'fw-block-attacks'], function () {
    Route::get('/', function () {
        $user_ip = Firewall::getIp();

        $blacklist = Firewall::all()->filter(function ($item) {
            return $item->whitelisted == false;
        });

        $whitelist = Firewall::all()->filter(function ($item) {
            return $item->whitelisted == true;
        });

        return $user_ip = Firewall::getIp();
    });
});
