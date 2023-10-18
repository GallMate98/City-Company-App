<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Companys;
use App\Repository\CompanyRepository;
use App\Form\CompanyType;
use App\Helpers\TotalPage;


class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_company')]
    public function index(): Response
    {
        return $this->render('company/index.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }

    #[Route('/adaugare', name:'add_company')]
   public function addCompany(Request $request, EntityManagerInterface $entityManager,)
    {
        $company = new Companys();
        $company->setVizualizare(0);

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $newCompany = $form->getData();
 
            $company->setNumeFirme($newCompany->getNumeFirme());
            $company->setAdresa($newCompany->getAdresa());
            $company->setCategorie($newCompany->getCategorie());
            $company->setLogo($newCompany->getLogo());

            $entityManager->persist($company);

            $entityManager->flush();

            return $this->redirectToRoute('get_all_company');
        }

       
        return $this->render('company/new.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/paginacompanie/{id}', name:'get_company')]
    public function getCompany(CompanyRepository $companyRepository, int $id, EntityManagerInterface $entityManager)
    {
       $company = $companyRepository->find($id);

       if(!$company){
       throw $this->createNotFoundException(
            'Contact with id: '.$id. ' was not found.'
        );
       }

       $company->setVizualizare($company->getVizualizare()+1);
       $entityManager->flush();
       

        return $this->render('company/company.html.twig', [
            'company' => $company,
        ]);
    }


    #[Route('/', name:'get_all_company')]
    public function getAllCompany(CompanyRepository $companyRepository, Request $request, TotalPage $totalPage)
    {
        $currentPage = $request->query->get('page',1);
        $pageSize = 2;
        $companies = $companyRepository->pagination($currentPage, $pageSize );
        $total = $companyRepository->countTotalRows();
        $numberPage = $totalPage->allPage($pageSize,$total);
        $url = 'get_all_company';  
        $size = ['size' => $pageSize];
        if (empty($companies)) {
            throw $this->createNotFoundException('Company table is empty.');
        }

    return $this->render('company/allcompany.html.twig', [
        'companies' => $companies,
        'currentPage' => $currentPage,
        'numberPage' => $numberPage,
        'url' => $url,
        'size' => $size
    ]);
    }

    #[Route('/editare/{id}', name:'edit_company')]
    public function editCompany(EntityManagerInterface $entityManager, CompanyRepository $companyRepository, int $id, Request $request)
    {
       $company = $companyRepository->find($id);
       if(!$company){
        throw $this->createNotFoundException(
            'Contact with id: '.$id. 'was not found.'
        );
       }

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $newCompany = $form->getData();
 
            $company->setNumeFirme($newCompany->getNumeFirme());
            $company->setAdresa($newCompany->getAdresa());
            $company->setCategorie($newCompany->getCategorie());
            $company->setLogo($newCompany->getLogo());

            $entityManager->flush();

            return $this->redirectToRoute('get_all_company');
        }

       
        return $this->render('company/new.html.twig', [
            'form' => $form,
        ]);


    }

    #[Route('/delete/{id}', name:'delete_company')]
    public function deleteCompany(EntityManagerInterface $entityManager,CompanyRepository $companyRepository, int $id) {
       $company = $companyRepository->find($id);

       if(!$company) {
            throw $this->createNotFoundException(
            'Contact with id: '.$id. 'was not found.'
        );
       }

        $entityManager->remove($company);
        $entityManager->flush();

        return new Response('Succesfuly deleted');

    }

    #[Route('/topvizualizare', name:'top_company')]
    public function topCompany(CompanyRepository $companyRepository, ) {
        $topCompanies = $companyRepository->findTopVizualizare();
      
        if (empty($topCompanies)) {
            throw $this->createNotFoundException('Company table is empty.');
        }

       return $this->render('company/topcompany.html.twig', [
        'companies' => $topCompanies,
    ]);

    }

}
