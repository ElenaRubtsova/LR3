<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Feedback;
use App\Form\ProductType;
use App\Form\FeedbackType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET", 'POST'})
     */
    public function show(Request $request, Product $product): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $feedback->setProduct($product);

            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/show.html.twig', [
            'feedback_form' => $form->createView(),
            'product' => $product,
        ]);
    }

}
