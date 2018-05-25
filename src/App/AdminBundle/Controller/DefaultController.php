<?php

namespace App\AdminBundle\Controller;

use App\DataBundle\Entity\Main;
use App\DataBundle\Entity\Orders;
use App\DataBundle\Entity\Product;
use App\DataBundle\Entity\Sub;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $loggedin = false;
    private $user = null;
    public function __construct()
    {
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
            if($this->user->getRole() == "Admin"){
                $this->loggedin = true;
            }
        }
    }
    public function ordersAction(){
        if($this->loggedin){
            $orders = $this->getDoctrine()->getRepository('DataBundle:Orders')->findAll();
            return $this->render('AdminBundle:Default:orders.html.twig',array(
                'order' => $orders
            ));
        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
    public function statusAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $ord = $em->getRepository(Orders::class)->find($request->get('id'));
        if ($ord->getStatus() == 1){
            $ord->setStatus(0);
        }else{
            $ord->setStatus(1);
        }
        $em->flush();
        return new Response("true");
    }


    public function indexAction()
    {
        if($this->loggedin){
            $name = "Abuzar";
            return $this->render('AdminBundle:Default:index.html.twig', array('name' => $name));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
     }
    public function productAction(){
        if($this->loggedin){
            $products = $this->getDoctrine()->getRepository('DataBundle:Product')->findAll();
            $products = array_reverse($products);
            $cat = $this->getDoctrine()->getRepository('DataBundle:Main')->findAll();
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findAll();
            return $this->render('AdminBundle:Default:product.html.twig',
                array(
                    'pro' => $products,
                    'cat' => $cat,
                    'sub' => $sub
                ));
        }
        return $this->redirect($this->generateUrl('home_homepage_login'));



    }
    public function addproductAction(Request $request){
        if($this->loggedin){
            if($request->getMethod() == "POST"){
                $pro = new Product();
                $pro->setName($request->get('name'));
                $pro->setDetails($request->get('details'));
                $pro->setPrice($request->get('price'));
                if($request->get('bs') == "on"){
                    $pro->setBs(1);
                }if($request->get('ws') == "on"){
                    $pro->setWs(1);
                }if($request->get('kr') == "on"){
                    $pro->setKartom(1);
                }
                $pro->setSub($this->getDoctrine()->getRepository('DataBundle:Sub')->find($request->get('sub')));
                // image
                $info = pathinfo($_FILES['image']['name']);
                $ext = $info['extension'];
                $date = date('mdYhisms', time());
                $newname = $date . '.' . $ext;
                $target = 'bundles/product/'.$newname;
                move_uploaded_file( $_FILES['image']['tmp_name'], "./".$target);
                $pro->setImage($target);
                $pro->setQuantity($request->get('quantity'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($pro);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_homepage_product'));
            }
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findAll();
            return $this->render('AdminBundle:Default:addproduct.html.twig',array('sub' => $sub));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
    }
    public function deleteproductAction($id){
        if($this->loggedin){
            $em = $this->getDoctrine()->getManager();
            $pro = $em->getRepository('DataBundle:Product')->find($id);
            $em->remove($pro);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_homepage_product'));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
    public function editproductAction(Request $request,$id){
        if($this->loggedin){
            if($request->getMethod() == "POST"){
                $em = $this->getDoctrine()->getManager();
                $pro = $em->getRepository('DataBundle:Product')->find($id);
                $pro->setName($request->get('name'));
                $pro->setDetails($request->get('details'));
                $pro->setPrice($request->get('price'));
                if($request->get('bs') == "on"){
                    $pro->setBs(1);
                }else{
                    $pro->setBs(0);
                }
                if($request->get('ws') == "on"){
                    $pro->setWs(1);
                }else{
                    $pro->setWs(0);
                }
                if($request->get('kr') == "on"){
                    $pro->setKartom(1);
                }else{
                    $pro->setKartom(0);
                }
                $pro->setSub($this->getDoctrine()->getRepository('DataBundle:Sub')->find($request->get('sub')));
                // image
                if($_FILES['image']['name'] != null){
                    $info = pathinfo($_FILES['image']['name']);
                    $ext = $info['extension'];
                    $date = date('mdYhisms', time());
                    $newname = $date . '.' . $ext;
                    $target = 'bundles/product/'.$newname;
                    move_uploaded_file( $_FILES['image']['tmp_name'], "./".$target);
                    $pro->setImage($target);
                }
                $pro->setQuantity($request->get('quantity'));
                $em->flush();
                return $this->redirect($this->generateUrl('admin_homepage_product'));

            }
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findAll();
            $pro = $this->getDoctrine()->getRepository('DataBundle:Product')->find($id);
            return $this->render('AdminBundle:Default:editproduct.html.twig',array('sub' => $sub,'pro' => $pro));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
        }
    public function categoryAction(Request $request){
        if($this->loggedin){
            if($request->getMethod() == "POST"){
                $main = new Main();
                $main->setName($request->get('name'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($main);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_homepage_category'));

            }
            $cat = $this->getDoctrine()->getRepository('DataBundle:Main')->findAll();
            return $this->render('AdminBundle:Default:category.html.twig',array('main' => $cat));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
        }
    public function editcatAction(Request $request,$id){
        if($this->loggedin){
            $em = $this->getDoctrine()->getManager();
            $cat = $em->getRepository('DataBundle:Main')->find($id);
            $cat->setName($request->get('name'));
            $em->flush();
            return $this->redirect($this->generateUrl('admin_homepage_category'));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
    public function deletecatAction($id){
        if($this->loggedin){
            $em = $this->getDoctrine()->getManager();
            $main = $em->getRepository('DataBundle:Main')->find($id);
            $em->remove($main);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_homepage_category'));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
    public function subAction(Request $r){
        if($this->loggedin){
            if($r->getMethod() == "POST"){

            }
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $r->get('id')));
            return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $r->get('id')));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
      }
    public function addsubAction(Request $request){
        if($this->loggedin){
            $sub = new Sub();
            $sub->setName($request->get('name'));
            $sub->setMain($this->getDoctrine()->getRepository('DataBundle:Main')->find($request->get('id')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($sub);
            $em->flush();
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $request->get('id')));
            return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $request->get('id')));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
        }
    public function editsubAction(Request $request){
        if($this->loggedin){
            $em = $this->getDoctrine()->getManager();
            $sub = $em->getRepository('DataBundle:Sub')->find($request->get('id'));
            $sub->setName($request->get('name'));
            $main = $sub->getMain()->getId();
            $em->flush();
            $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $main));
            return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $main));

        }
        return $this->redirect($this->generateUrl('home_homepage_login'));
        }
    public function deletesubAction(Request $request){
        if($this->loggedin){
            $em = $this->getDoctrine()->getManager();
            $sub = $em->getRepository('DataBundle:Sub')->find($request->get('id'));
            $pro = $this->getDoctrine()->getRepository('DataBundle:Product')->findBy(array('sub'=>$sub));
            if(count($pro) == 0){
                $main = $sub->getMain()->getId();
                $em->remove($sub);
                $em->flush();
                $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $main));
                return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $main));

            }
            return new Response("false");
        }
        return $this->redirect($this->generateUrl('home_homepage_login'));

    }
}
