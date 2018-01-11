<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var integer
     */
    private $idQuestion;

    /**
     * @var string
     */
    private $reponse;

    /**
     * @var boolean
     */
    private $reponseExpected;


    /**
     * Set idQuestion
     *
     * @param integer $idQuestion
     *
     * @return Reponse
     */
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    /**
     * Get idQuestion
     *
     * @return integer
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set reponseExpected
     *
     * @param boolean $reponseExpected
     *
     * @return Reponse
     */
    public function setReponseExpected($reponseExpected)
    {
        $this->reponseExpected = $reponseExpected;

        return $this;
    }

    /**
     * Get reponseExpected
     *
     * @return boolean
     */
    public function getReponseExpected()
    {
        return $this->reponseExpected;
    }
}
