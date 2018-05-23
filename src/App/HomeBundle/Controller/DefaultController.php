<?php

namespace App\HomeBundle\Controller;

use App\DataBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
        }
    }
    public function cartdisplayAction(){
        $cart = $_SESSION['cart'];
        return $this->render('HomeBundle:Default:cartdisplay.html.twig',array('cart' => $cart));
    }
    public function addtocartAction(Request $request){
        $id = $request->get('id');
        $qua = $request->get('qua');
        $pro = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if ($pro->getQuantity() > $qua){
            $cart = $_SESSION['cart'];
            $foundIndex = -1;
            for($i = 0;$i < count($cart);$i++){
                if($cart[$i][0]->getId() == $id){
                    $foundIndex = $i;
                    break;
                }
            }
            if ($foundIndex == -1){
                array_push($cart,array($pro,$qua));
            }else{
                $cart[$foundIndex][1] += $qua;
            }
            $_SESSION['cart'] = $cart;
            return new Response("Added");
        }else{
            return new Response("Quantity");
        }

    }




    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('HomeBundle:Default:index.html.twig',array(
            'pro' => $products
        ));
    }
    public function tspAction(){
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy(array(
            'bs' => 1
        ));
//        shuffle($products);
        return $this->render('HomeBundle:Default:tsp.html.twig',array(
            'pro' => $products
        ));
    }
    public function allAction(){
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('HomeBundle:Default:all.html.twig',array(
            'pro' => $products
        ));
    }
    public function kartomAction(){
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy(array(
            'kartom' => 1
        ));
        return $this->render('HomeBundle:Default:kartom.html.twig',array(
            'pro' => $products
        ));
    }
    public function wsAction(){
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy(array(
            'ws' => 1
        ));
        return $this->render('HomeBundle:Default:ws.html.twig',array(
            'pro' => $products
        ));
    }
    public function singleAction($id,$name){
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        $rp = $this->getDoctrine()->getRepository(Product::class)->findBy(array(
            'sub' => $product->getSub()
        ),array(),3);
        return $this->render('HomeBundle:Default:single.html.twig',array(
            'pro' => $product,
            'rp' => $rp
        ));
    }
}
