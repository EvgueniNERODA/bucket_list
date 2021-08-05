<?php
namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render("personne/liste.html.twig", ['wishes'=>$wishes]);
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail():Response
    {
        return $this->render("personne/detail.html.twig");
    }

    /**
     * @Route("/ajouter", name="ajouter")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function ajouter(EntityManagerInterface $em):Response
    {   
        //autre méthode (vider les paramètres de ajouter ())
        //$em = $this->getDoctrine()->getManager();
        $date = new DateTime();
        $wish = new Wish;
        //on hydrate
        $wish->setTitle('wish 2');
        $wish->setDescription('avor deux tesla');
        $wish->setAuthor('Ev');
        $wish->setIsPublished('1');
        $wish->setDateCreated($date);
        //on persiste
        $em->persist($wish);
        //flush
        $em->flush();
        //return $this->json($wish);
        return $this->redirectToRoute('home');
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