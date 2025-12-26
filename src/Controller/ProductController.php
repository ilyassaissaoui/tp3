<?php
namespace App\Controller;

use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $quantity = $data['quantity'];
            $color = $data['color'];

            $this->addFlash('success', sprintf(
                'Ajouté %d article(s) en couleur %s au panier !',
                $quantity,
                $color
            ));

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
