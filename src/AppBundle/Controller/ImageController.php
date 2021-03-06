<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Image;
use AppBundle\Form\ImageType as FormImage;

class ImageController extends Controller{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request){
        $image=new Image();

        $imageForm=$this->createForm(new FormImage(), $image);
        
        $imageForm->handleRequest($request);
        
        if($imageForm->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($image);
            
            $em->flush();
            
            $this->get('image_resizer')->generateImages($image);
        }
        
        $params=[
            'imageForm'=>$imageForm->createView(),
        ];
        
        return $this->render('image/create.html.twig', $params);
    }
    
    /**
     * @Route("/translate", name="translate")
     */
    public function tradPage(){
        $customEvent=new \AppBundle\Event\CustomEvent("boum");
        $this->get('event_dispatcher')->dispatch("custom.test_event", $customEvent);
        
        return $this->render('default/index.html.twig'); 
    }
}