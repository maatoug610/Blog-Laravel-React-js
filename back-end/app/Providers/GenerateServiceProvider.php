<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GenerateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('generateString', function() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for($i=0;$i<10;$i++){
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        });
        app()->bind('generateInteger',function(){
            $integer = '0123456789';
            $intg_Length = strlen($integer);
            $randomInteger = '';
            for($i = 0;$i < 2;$i ++){
            $randomInteger = $integer[rand(0,$intg_Length -1)];
            }

            return $randomInteger;
        });
        app()->bind('generateBool',function (){
            $boolean = '01';
            $length_boolean = strlen($boolean);
            $randomBoolean = '';
            for($i=0;$i<2;$i++){
            $randomBoolean = $boolean[rand(0, $length_boolean -1)];
            }

            return $randomBoolean;
        });
        app()->bind('read_number',function ($n){

            return $n+=1;
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
