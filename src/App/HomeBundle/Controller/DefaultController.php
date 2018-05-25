<?php

namespace App\HomeBundle\Controller;

use App\DataBundle\Entity\Customer;
use App\DataBundle\Entity\Order;
use App\DataBundle\Entity\Orders;
use App\DataBundle\Entity\Pio;
use App\DataBundle\Entity\Product;
use App\DataBundle\Entity\User;
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
    public function showAction(){
        $user= null;
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }
        return $this->render('HomeBundle:Default:show.html.twig',array(
            'user' => $user
        ));
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
    public function removecartAction(Request $request){
        $id = $request->get('id');
        $cart = $_SESSION['cart'];
        /*$foundIndex = -1;
        for($i = 0;$i < count($cart);$i++){
            if($cart[$i][0]->getId() == $id){
                $foundIndex = $i;
                break;
            }
        }*/
        unset($cart[$id]);
        $cart = array_values($cart);
//        print_r($cart);
            $_SESSION['cart'] = $cart;

        return new Response('true');
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
        $pio = $this->getDoctrine()->getRepository(Pio::class)->findBy(array(
            'product' => $product
        ));
        return $this->render('HomeBundle:Default:single.html.twig',array(
            'pro' => $product,
            'rp' => $rp,
            'pio' => $pio
        ));
    }
    public function cartAction(Request $request){
        if ($request->getMethod() == "POST"){
            $cart = $_SESSION['cart'];
            for ($i = 0;$i<count($cart);$i++){
                $cart[$i][1] = $request->get('qua'.$i);
            }
            $_SESSION['cart'] = $cart;
            return $this->redirect($this->generateUrl('home_homepage_cart'));
        }
        $cart = $_SESSION['cart'];
        return $this->render('HomeBundle:Default:cart.html.twig',array(
            'cart' => $cart
        ));
    }
    public function checkoutAction(Request $request){

        $user = null;
        $customer = null;
        $cart = $_SESSION['cart'];
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('DataBundle:Customer')->findOneBy(array('user'=> $user));
            if($request->getMethod() == "POST"){
                $saddress = $request->get('saddress'). ", ".$request->get('city').", ".$request->get('coutnry').", ".$request->get('zip');
                $customer->SetSaddress($saddress);
                $em->flush();
                $order = new Orders();
                $order->setPayment($request->get('payment_method'));
                $order->setCvv($request->get('cvv'));
                $order->setCard($request->get('card'));
                $order->setExp($request->get('exp'));
                $order->setCustomer($customer);
                $order->setStatus(0);
                $price = 0;
                foreach($cart as $item){
                    $price += ($item[0]->getPrice() * $item[1]);
                }
                $order->setPrice($price);
                $em->persist($order);
                $em->flush();
                $order->setOrderid('Order'.$order->getId().'786');
                $em->flush();
                foreach ($cart as $item){
                    $pio = new Pio();
                    $pio->setQuantity($item[1]);
                    $pio->setOrders($order);
                    $pio->setProduct($this->getDoctrine()->getRepository('DataBundle:Product')->find($item[0]->getId()));
                    $em->persist($pio);
                    $em->flush();
                }
                $_SESSION['cart'] = array();
                return $this->redirect($this->generateUrl('home_homepage_thanks',array('oid'=>$order->getId())));
            }
        }

        return $this->render('HomeBundle:Default:checkout.html.twig',array('cart' => $cart,'user' => $user,'customer' => $customer));
    }
    public function ThanksAction($oid){
        $order = $this->getDoctrine()->getRepository('DataBundle:Orders')->find($oid);
        return $this->render('HomeBundle:Default:thanks.html.twig',array('order' => $order));
    }
    public function trackingAction(Request $request){
        if ($request->getMethod() == "POST"){
            $order = $this->getDoctrine()->getRepository(Orders::class)->findOneBy(array(
                'orderid' => $request->get('id')
            ));
            if($order != null){
                if ($order->getCustomer()->getUser()->getEmail() == $request->get('email')){
                    return $this->render('HomeBundle:Default:tracking.html.twig',array(
                        'order' => $order
                    ));
                }else{
                    return $this->render('HomeBundle:Default:tracking.html.twig',array(
                        'err' => "Please put the correct combination of Order No and Email"
                    ));
                }
            }else{
                return $this->render('HomeBundle:Default:tracking.html.twig',array(
                    'err' => "Please put the correct combination of Order No and Email"
                ));
            }

        }
        return $this->render('HomeBundle:Default:tracking.html.twig');
    }


    public function customerAction(){
        if (isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $em = $this->getDoctrine();
            $customer = $em->getRepository('DataBundle:Customer')->findOneBy(array('user'=> $user));
            $orders = $this->getDoctrine()->getRepository('DataBundle:Orders')->findBy(array('customer'=> $customer));
            return $this->render('HomeBundle:Default:customer.html.twig',array('order' => $orders));
        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
    public function detailsAction($oid){
        $pio = $this->getDoctrine()->getRepository('DataBundle:Pio')->findBy(array(
            'orders' => $oid
        ));
        return $this->render('HomeBundle:Default:details.html.twig',array('pio' => $pio));
    }
    public function reviewAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $ord = $em->getRepository(Orders::class)->find($request->get('id'));
        $ord->setReview($request->get('review'));
        $em->flush();
        return $this->redirect($this->generateUrl('home_homepage_customer'));
    }


    public function loginAction(Request $request){
        if ($request->getMethod() == "POST"){
            $user = $request->get('user');
            $pass = $request->get('pass');
            $u = $this->getDoctrine()->getRepository('DataBundle:User')->findOneBy(array(
                'email' => $user,
                'password' => $pass
            ));
            if ($u != null){
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['user'] = $u;
                if ($u->getRole() == "Admin"){
                    return $this->redirect($this->generateUrl('admin_homepage'));
                }else{
                    return $this->redirect($this->generateUrl('home_homepage_customer'));

                }
            }
        }
        return $this->render('HomeBundle:Default:login.html.twig');
    }
    public function registerAction(Request $request){
        if ($request->getMethod() == "POST"){
            $user = new User();
            $user->setEmail($request->get('email'));
            $user->setPassword($request->get('pass'));
            $user->setRole("Customer");
            $cust = new Customer();
            $cust->setCity($request->get('city'));
            $cust->setCountry($request->get('country'));
            $cust->setAddress($request->get('address'));
            $cust->setCompany($request->get('company'));
            $cust->setPhone($request->get('phone'));
            $cust->setFirstname($request->get('fname'));
            $cust->setLastname($request->get('lname'));
            $cust->setZip($request->get('zip'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $cust->setUser($user);
            $em->persist($cust);
            $em->flush();
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['user'] = $user;
            $referer = $request->get('ref');
            if ($referer != ""){
                return $this->redirect($referer);
            }else{
                return $this->redirect($this->generateUrl('home_homepage_register'));
            }
        }
        $referer = $request->headers->get('referer');
//        return new Response($referer);
        return $this->render('HomeBundle:Default:register.html.twig',array('ref' => $referer));
    }
    public function logoutAction(){
        session_destroy();
        return $this->redirect($this->generateUrl('home_homepage'));
    }

}
