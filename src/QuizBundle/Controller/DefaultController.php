<?php

namespace QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QuizBundle\Entity\Question;
use QuizBundle\Entity\Reponse;
use QuizBundle\Entity\Categorie;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {	
    	$questions = $this->getDoctrine()->getRepository(Question::class);
    	$vars = $questions->find(1);
        return $this->render('QuizBundle:Default:index.html.twig', array(
        	"question" => $vars));
    }
}