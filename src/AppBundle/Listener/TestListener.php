<?php
namespace AppBundle\Listener;

use AppBundle\Entity\Visit;

class TestListener{
    protected $doctrine;
    
    public function __construct($doctrine){
        $this->doctrine=$doctrine;
    }
    
    public function yo($event){
        if($event->isMasterRequest()){
            $request=$event->getRequest();
            
            $em=$this->doctrine->getManager();
            $visit=new Visit();

            $visit->setIp($request->getClientIp());
            $visit->setUrl($request->getRequestUri());
            $visit->setDate(new \Datetime());

            $em->persist($visit);
            $em->flush();
        }
    }
}