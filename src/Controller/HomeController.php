<?php

namespace App\Controller;

use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request): Response
    {


        $formulaire =$this->createForm(PersonneType::class);
        $formulaire->handleRequest($request);

        if($formulaire->isSubmitted()){

            $data = $formulaire->getData();
            $nom = $data['nomPersonne'];
            $time=date_create_from_format('m-d-Y','01-13-2022');
            $age =(array) date_diff($time, $data['agePersonne']) ;
            $date = date_format($data['agePersonne'], 'd-m-Y');
            


            return $this->render('home/success.html.twig',[
                
                'nom' => $nom,
                'age' => $age,
                'date' => $date,


            ]);

        }
        else{ 
        return $this->renderForm('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'formAfficher' => $formulaire,

        ]);
     }
    }
}
