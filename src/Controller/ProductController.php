<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    public $repository;


    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * INDEX - LISTE DES PRODUITS VIA http://etest.local/public/
     * @Route("/", name="product.index")
     * @return Response
     */
    public function index(): Response
    {
        $products = $this->repository->findAll();
        return $this->render('product/index.html.twig', [
            'product' => $products
        ]);
    }

    /**
     * INDEX - LISTE DES CHAUSSANTS VIA http://etest.local/public/chaussant
     * @Route("/chaussant", name="product.chaussant")
     * @return Response
     */
    public function chaussant():Response
    {
        $products = $this->repository->findByChaussant();
        return $this->render('product/chaussant.html.twig', [
            'product' => $products
        ]);
    }

    /**
     * INDEX - LISTE DES TEXTILES VIA http://etest.local/public/textile
     * @Route("/textile", name="product.textile")
     * @return Response
     */
    public function textile():Response
    {
        $products = $this->repository->findByTextile();
        return $this->render('product/textile.html.twig', [
            'product' => $products
        ]);
    }

    /**
     * SHOW - VISUALISATION DE LA FICHE PRODUIT VIA http://etest.local/public/product/[nom-id]
     * @Route("/product/{slug}-{id}", name="product.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Product $product
     * @param string $slug
     * @return Response
     */
    public function show(Product $product, string $slug): Response
    {
        if($product->getSlug() !== $slug){
            //redirectroute pour eviter les modif durl
            return $this->redirectToRoute('product.show', [
                'id' => $product->getId(),
                'slug'=> $product->getSlug()
            ], 301);
        }
        return $this->render('product/show.html.twig',[
            'product' => $product,
        ]);
    }
}