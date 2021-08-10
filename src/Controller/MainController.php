<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/main")
 */
class MainController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home(CategoryRepository $repo):Response
    {

        //$categs = $repo->findAll();
        $categs = $repo->findByPublished();
        //$route = new Route
        return $this->render("main/home.html.twig", compact('categs'));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact():Response
    {
        return $this->render("wish/contact.html.twig");
    }

    /**
     * @Route("/about", name="about")
     */
    public function about():Response
    {
        return $this->render("main/about.html.twig");
    }
}