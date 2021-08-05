<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home():Response
    {
        //$route = new Route
        return $this->render("back/home.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact():Response
    {
        return $this->render("back/contact.html.twig");
    }

    /**
     * @Route("/about-us-toto", name="about")
     */
    public function about():Response
    {
        return $this->render("back/about.html.twig");
    }
}