<?php

namespace App\AdminBundle\Controller;

use App\DataBundle\Entity\Main;
use App\DataBundle\Entity\Product;
use App\DataBundle\Entity\Sub;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = "Abuzar";
        return $this->render('AdminBundle:Default:index.html.twig', array('name' => $name));
    }
    public function productAction(){
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
    public function addproductAction(Request $request){
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
    public function deleteproductAction($id){
        $em = $this->getDoctrine()->getManager();
        $pro = $em->getRepository('DataBundle:Product')->find($id);
        $em->remove($pro);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_homepage_product'));

    }
    public function editproductAction(Request $request,$id){
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
    public function categoryAction(Request $request){
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
    public function editcatAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('DataBundle:Main')->find($id);
        $cat->setName($request->get('name'));
        $em->flush();
        return $this->redirect($this->generateUrl('admin_homepage_category'));

    }
    public function deletecatAction($id){
        $em = $this->getDoctrine()->getManager();
        $main = $em->getRepository('DataBundle:Main')->find($id);
        $em->remove($main);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_homepage_category'));

    }

    public function subAction(Request $r){
        if($r->getMethod() == "POST"){

        }
        $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $r->get('id')));
        return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $r->get('id')));
    }
    public function addsubAction(Request $request){
        $sub = new Sub();
        $sub->setName($request->get('name'));
        $sub->setMain($this->getDoctrine()->getRepository('DataBundle:Main')->find($request->get('id')));
        $em = $this->getDoctrine()->getManager();
        $em->persist($sub);
        $em->flush();
        $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $request->get('id')));
        return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $request->get('id')));
    }
    public function editsubAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $sub = $em->getRepository('DataBundle:Sub')->find($request->get('id'));
        $sub->setName($request->get('name'));
        $main = $sub->getMain()->getId();
        $em->flush();
        $sub = $this->getDoctrine()->getRepository('DataBundle:Sub')->findBy(array('main' => $main));
        return $this->render('AdminBundle:Default:sub.html.twig',array('sub' => $sub,'main' => $main));
    }
    public function deletesubAction(Request $request){
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
}
