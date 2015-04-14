<?php
namespace AppBundle\Listener;

class CustomListener{
    public function customHandler(\AppBundle\Event\CustomEvent $event){
        dump($event);
    }
}