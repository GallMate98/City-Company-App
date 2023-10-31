<?php

namespace App\Controller;

// ...
use App\Entity\Company;
use App\Entity\DateView;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use DateTime;


class MyDateViewController extends AbstractController
{
    #[Route('/mydate', name: 'mydate')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $company = new Company();
  
        $company->setNumeFirme("Artorias");
        $company->setAdresa("aba nr34");
        $company->setCategorie("D");
        $company->setLogo("htt");
        $company->setVizualizare(3);

        $mydate = new DateView(); 
        $date = new DateTime('2023-06-17');
       

        $mydate = new DateView();
        $mydate->setDateforview($date);

        $mydate->setData($company);

        

        $entityManager->persist($company);
        $entityManager->persist($mydate);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$mydate->getId()
            .' and new category with id: '.$company->getId()
        );
    }
}