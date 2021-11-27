<?php

namespace App\Controller\Pub;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productList = $entityManager->getRepository(Product::class)->findAll();
        dd($productList);

        return $this->render('public/index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/product-add", methods="GET", name="product-add")
     */
    public function productAdd()
    {

        $product = new Product();
        $product->setTitle("Product");
        $product->setDscription("text");
        $product->setPrice(10);
        $product->setQuantity(10);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
