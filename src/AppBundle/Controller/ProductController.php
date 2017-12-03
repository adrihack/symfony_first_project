<?php
/**
 * Created by PhpStorm.
 * User: adri
 * Date: 23/10/17
 * Time: 11:52
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\ProductType;
use function PHPSTORM_META\type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Tests\Compiler\C;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * @Route("/create_product", name="create_product")
     */
    public function addProduct(Request $request){
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $prodToSave = $form->getData();
           // dump($prodToSave);
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodToSave);
            $em->flush();
        }

            return $this->render('AppBundle:products:product_add.html.twig', [
                'form' => $form->createView()
            ]);
            }





    // L'underscore du format est une formalité de symfony
    /**
     * @Route ("/product/list.{_format}",
     *          name="show_product_list",
     *          requirements={"_format":    "html|json"},
     *          defaults={"_format": "html"}
     *)
     */
    public function show_product_list(Request $request){

        $form = $this->createFormBuilder()
            ->add('search', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $search =null;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search = $form->getData()['search'];
        }

        $colonne = $request->query->get("colonne");
        $order = $request->query->get("order");

        if (!$colonne){
            $colonne= "title";
        }

        if (!$order){
            $order = "asc";
        }
        if ($order == "asc"){
            $tri = "desc";
        }
        else{
            $tri = "asc";
        }

        $AllProducts = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAllAsArray($colonne, $order, $search);  //méthode que l'on a créée dans ProductRepository.php
        if($request->getRequestFormat() === 'json')
            return new JsonResponse($AllProducts);
        return $this->render('AppBundle:products:product_list.html.twig', [
            'form'=>$form->createView(),
            'products'=>$AllProducts,
            'tri' => $tri]);

    }




    /**
     * @Route("/product/{id}", name="show_product")
     */
    public function showProduct($id) {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product') //On cherche notre produit.
            ->find($id); // On demande de trouver le produit par rapport à son ID
        return $this-> render('AppBundle:products:product.html.twig', [  // permet d'avoir dans notre vue on va pouvoir accéer aux caractéristiques du produit.
            'product'=>$product
        ]);
    }



}