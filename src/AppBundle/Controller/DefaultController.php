<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need


         $age = date('Y') - 1998;
         $tab = [ 1,1,2,4,5,8,12,4];
         return $this->render('AppBundle:default:index.html.twig',
         [   'firstname' => 'AdriTest',
         'age' => $age,
         'notes' => $tab
         ]);
    }


    /**
     * @Route("/prompt/{name}", name="prompt", defaults={"name"=null})
     */
        public function prompt($name){
        return $this->render('AppBundle:default:test.html.twig',[
            'name' => $name,
            'url' => $this->generateUrl('prompt')]);

    }
    /**
     * @Route("/hello/{name}",name="hello")
     */

    public function testAction(Request $request, $name){
        return new Response('<h1> HELLO WORLD'. $name .'</h1>');
    }

    /**
     *
     */
    public function TriPrix(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        return array(
        );
    }




}
