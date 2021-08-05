<?php
namespace App\Controller;

use App\Entity\Wish;
use App\Form\AddWishType;
use App\Repository\WishRepository;


use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    
    /**
     * @Route("/list", name="list")
     */
    public function list(WishRepository $repo):Response
    {
        //$route = new Route

        $wishes = $repo->findAll();

        return $this->render("back/liste.html.twig", ['wishes'=>$wishes]);
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail():Response
    {
        return $this->render("back/detail.html.twig");
    }

    /**
     * @Route("/ajouter", name="ajouter")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function ajouter(EntityManagerInterface $em, Request $request):Response
    {
        //on crée une entity vide
        $wish = new Wish();
        //on crée le fomrulaire (type de formulaire + entity)
        $formWish = $this->createForm(AddWishType::class, $wish);
        // associer le formulaire avec les données envoyées
        // hydrater $personne
        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid())
        {

            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('list');
        }

        return $this->render('/front/ajouter.html.twig',['formWish'=>$formWish->createView()]);
        /**
         * //autre méthode (vider les paramètres de ajouter ())
         * //$em = $this->getDoctrine()->getManager();
         * $date = new DateTime();
         * $wish = new Wish;
         *
         * //on hydrate
         * $wish->setTitle('wish 2');
         * $wish->setDescription('avor deux tesla');
         * $wish->setAuthor('Ev');
         * $wish->setIsPublished('1');
         * $wish->setDateCreated($date);
         * //on persiste
         * $em->persist($wish);
         * //flush
         * $em->flush();
         * //return $this->json($wish);
         * return $this->redirectToRoute('home');
         */
    }

   /**
     * @Route("/enlever/{id}", name="enlever")
     */
    public function enlever(Wish $wish, EntityManagerInterface $em):Response
    {   
       
        //autre méthode (vider les paramètres de ajouter ())
        //$em = $this->getDoctrine()->getManager();
        $em->remove($wish);
        $em->flush();
        //return $this->json($wish);
        return $this->redirectToRoute('home');
    }
}