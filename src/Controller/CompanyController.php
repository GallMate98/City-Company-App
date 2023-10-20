<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Form\CompanyType;
use App\Helpers\PaginationHelper;


class CompanyController extends AbstractController {
   #[Route('/add', name:'add_company')]
   public function addCompany(Request $request, EntityManagerInterface $entityManager,) {
        $company = new Company();
        $company->setVizualizare(0);
        $title="Add new Company";

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
            'title' => $title,
        ]);
    }

    #[Route('/company/{id}', name:'get_company')]
    public function getCompany(CompanyRepository $companyRepository, int $id, EntityManagerInterface $entityManager) {
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
    public function getAllCompany(CompanyRepository $companyRepository, Request $request, PaginationHelper $totalPage) {
        $currentPage = $request->query->get('page');

        if($currentPage == null) {
            $currentPage = 1;
        }

        $pageSize = 4;
        $companies = $companyRepository->getCompanies($currentPage, $pageSize );
        $companyCount = $companyRepository->countTotalRows();
        $totalPages = $totalPage->getPageCount($pageSize,$companyCount);

        if (empty($companies)) {
            throw $this->createNotFoundException('Company table is empty.');
        }

        if($currentPage > $totalPages) {
            throw $this->createNotFoundException("Page doesn't exist.");
        }

        $route = 'get_all_company';  

        return $this->render('company/allcompany.html.twig', [
            'companies' => $companies,
            'currentPage' => $currentPage,
            'totalPages' =>  $totalPages,
            'route' => $route,
            'size' => $pageSize,
            'visualization' => false
        ]);
    }

    #[Route('/edit/{id}', name:'edit_company')]
    public function editCompany(EntityManagerInterface $entityManager, CompanyRepository $companyRepository, int $id, Request $request) {
        $title = "Update company";
        $company = $companyRepository->find($id);

        if(!$company) {
            throw $this->createNotFoundException (
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
            'title' => $title,
        ]);
    }
    
    #[Route('/top-view', name:'top_company')]
    public function topCompany(CompanyRepository $companyRepository, Request $request, PaginationHelper $totalPage, PaginationHelper $topPage) {
        $topCompanies = $companyRepository->findTopVizualizare();
        $currentPage = $request->query->get('page',1);
        
        if (empty($topCompanies)) {
            throw $this->createNotFoundException('Company table is empty.');
        }

        $pageSize = 3;
        $topCompaniesPage = $topPage->paginationForTop($topCompanies,$currentPage, $pageSize);
        $total = count($topCompanies);
        
        $totalPages = $totalPage->getPageCount($pageSize,$total);
       
        $route = 'top_company';
        
        return $this->render('company/topcompany.html.twig', [
            'companies' => $topCompaniesPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'route' => $route,
            'size' => $pageSize,
            'visualization' => true
        ]);
    }

    #[Route('/delete/{id}', name:'delete_company')]
    public function deleteCompany(EntityManagerInterface $entityManager, CompanyRepository $companyRepository, int $id) {
       $company = $companyRepository->find($id);

       if(!$company) {
            throw $this->createNotFoundException(
            'Contact with id: '.$id. 'was not found.'
        );
       }

        $entityManager->remove($company);
        $entityManager->flush();

        return $this->redirectToRoute('get_all_company');
    }
}
