<?php
namespace App\Controller;

use App\Entity\CartItem;
use App\Form\CartItemType;
use App\Service\CartService;
use App\Service\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class AppareilController extends AbstractController
{
    private ProductRepositoryInterface $productRepository;
    private CartService $cartService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CartService $cartService
    ) {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
    }

    #[Route('/appareil', name: 'app_appareil')]
    public function index(Request $request): Response
    {
        $product = $this->productRepository->findProductById(1);
        
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $cartItem = new CartItem();
        $form = $this->createForm(CartItemType::class, $cartItem);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->cartService->addItem($cartItem);
            $this->addFlash('success', 'Product successfully added to cart!');
            
            return $this->redirectToRoute('app_appareil');
        }

        return $this->render('appareil/show.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'cart_count' => count($this->cartService->getCart()),
        ]);
    }

    #[Route('/appareil/add-to-cart', name: 'app_appareil_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request): JsonResponse
    {
        $cartItem = new CartItem();
        $form = $this->createForm(CartItemType::class, $cartItem);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->cartService->addItem($cartItem);
            
            return $this->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'data' => $cartItem->toArray(),
                'cart_summary' => [
                    'total_items' => count($this->cartService->getCart()),
                    'cart_total' => $this->cartService->getCartTotal(),
                ]
            ]);
        }

        // Collect form errors
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $this->json([
            'status' => 'error',
            'errors' => $errors,
        ], 400);
    }

    #[Route('/appareil/cart', name: 'app_appareil_cart')]
    public function viewCart(): Response
    {
        $cart = $this->cartService->getCart();
        
        return $this->render('appareil/cart.html.twig', [
            'cart' => $cart,
            'cart_total' => $this->cartService->getCartTotal(),
        ]);
    }
}
