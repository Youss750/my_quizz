<?php
namespace QuizBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QuizBundle\Entity\Question;
use QuizBundle\Entity\Reponse;
use QuizBundle\Entity\Categorie;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Query;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class QuizzController extends Controller
{
    /**
     * @Route("/quizz/{id}")
     */
    public function indexAction($id)
    {   
        $questions = $this->getDoctrine()->getRepository(Question::class);
        $qb = $questions->createQueryBuilder('q');
        $qb
        ->select('r','q')
        ->innerJoin("QuizBundle:Reponse",'r',"WITH","r.idQuestion = q.id")
        ->where("q.idCategorie = $id");
        $query = $qb->getQuery();
        $em = $query->getResult();
        $question = [];
        $arr = [];
        $reponse = [];
        $arr['question'] = "";
        $arr["reponse"] = [];
        $arr["id"] = [];
        foreach ($em as $key => $value) {
            if (get_class($value) == "QuizBundle\Entity\Question"){
                if ($key != 0) {
                    array_push($question, $arr);
                    $arr = [];
                    $arr['question'] = "";
                    $arr["reponse"] = [];
                    $arr["id"] = [];
                }
                $arr["question"] = $value->getQuestion();
                $arr["id"] = $value->getId();
            }
            else{
                if ($key > 0) {
                    $list = array("text" => $value->getReponse(), "id" => $value->getId());
                    array_push($arr["reponse"], $list);
                }
            }   
        }
        return $this->render('QuizBundle:quizz:harry.html.twig', array(
            "question" => $question));
    }
    public function resultAction($id)
    {   
        $questions = $this->getDoctrine()->getRepository(Question::class);
        $qb = $questions->createQueryBuilder('q');
        $qb->select('r','q')
        ->innerJoin("QuizBundle:Reponse",'r',"WITH","r.idQuestion = q.id")
        ->where("q.idCategorie = $id");
        $query = $qb->getQuery();
        $em = $query->getResult();
        $questions = [];
        $reponse = [];
        $question = [];
        $form = [];
        $results = $_POST;
        foreach ($em as $key => $value) {
            if($key % 4 == 0){
                if(!empty($question))
                    array_push($form, $question);
                $question["content"] = $value->getQuestion();
                $question["reponses"] = [];
                $question["id_result"] = "vide";
                if(isset($results[$value->getId()]))
                    $question["id_result"] = $results[$value->getId()];
            }
            else {
                $reponse = array("text" => $value->getReponse(), "id" => $value->getId(), "valid" => $value->getReponseExpected());
                array_push($question["reponses"], $reponse);
            }
        }
        return $this->render('QuizBundle:quizz:result.html.twig', array("form" => $form));
    }
}