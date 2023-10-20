<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
class MockController extends AbstractController {
    #[Route('/add-all', name:'add_all_companies')]
    public function addAllCompany(EntityManagerInterface $entityManager) {
        $companyData = [
            [
                'name' => 'Company A',
                'adresa' => 'Company A is known for its products.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-a.png',
            ],
            [
                'name' => 'Company B',
                'adresa' => 'Company B provides quality services.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-b.png',
            ],
            [
                'name' => 'Company C',
                'adresa' => 'Company C specializes in technology solutions.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-c.png',
            ],

            [
                'name' => 'Company D',
                'adresa' => 'Company D is a global leader in its industry.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-d.png',
            ],
            [
                'name' => 'Company E',
                'adresa' => 'Company E offers cutting-edge technology services.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-e.png',
            ],
            [
                'name' => 'Company F',
                'adresa' => 'Company F is a trusted name in the market.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-f.png',
            ],
            [
                'name' => 'Company G',
                'adresa' => 'Company G delivers innovative solutions.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-g.png',
            ],
            [
                'name' => 'Company H',
                'adresa' => 'Company H is dedicated to customer satisfaction.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-h.png',
            ],
            [
                'name' => 'Company I',
                'adresa' => 'Company I focuses on environmental sustainability.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-i.png',
            ],
            [
                'name' => 'Company J',
                'adresa' => 'Company J is an industry innovator.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-j.png',
            ],
            [
                'name' => 'Company K',
                'adresa' => 'Company K offers top-notch services.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-k.png',
            ],
            [
                'name' => 'Company L',
                'adresa' => 'Company L is known for its exceptional quality.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-l.png',
            ],
            [
                'name' => 'Company M',
                'adresa' => 'Company M provides outstanding products.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-m.png',
            ],
            [
                'name' => 'Company N',
                'adresa' => 'Company N is a trusted partner.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-n.png',
            ],
            [
                'name' => 'Company O',
                'adresa' => 'Company O is dedicated to innovation.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-o.png',
            ],
            [
                'name' => 'Company P',
                'adresa' => 'Company P focuses on sustainable solutions.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-p.png',
            ],
            [
                'name' => 'Company Q',
                'adresa' => 'Company Q is a global leader in its industry.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-q.png',
            ],
            [
                'name' => 'Company R',
                'adresa' => 'Company R offers cutting-edge technology services.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-r.png',
            ],
            [
                'name' => 'Company S',
                'adresa' => 'Company S is a trusted name in the market.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-s.png',
            ],
            [
                'name' => 'Company T',
                'adresa' => 'Company T delivers innovative solutions.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-t.png',
            ],
            [
                'name' => 'Company U',
                'adresa' => 'Company U is dedicated to customer satisfaction.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-u.png',
            ],
            [
                'name' => 'Company V',
                'adresa' => 'Company V focuses on environmental sustainability.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-v.png',
            ],
            [
                'name' => 'Company W',
                'adresa' => 'Company W is an industry innovator.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-w.png',
            ],
            [
                'name' => 'Company X',
                'adresa' => 'Company X offers top-notch services.',
                'category' => 'Category Z',
                'logo' => 'http://example.com/logo-x.png',
            ],
            [
                'name' => 'Company Y',
                'adresa' => 'Company Y is known for its exceptional quality.',
                'category' => 'Category X',
                'logo' => 'http://example.com/logo-y.png',
            ],
            [
                'name' => 'Company Z',
                'adresa' => 'Company Z provides outstanding products.',
                'category' => 'Category Y',
                'logo' => 'http://example.com/logo-z.png',
            ],
        ];
        
        foreach($companyData as $companydata) { 
            $company = new Company();
            $company->setVizualizare(0);

            $company->setNumeFirme($companydata['name']);
            $company->setAdresa($companydata['adresa']);
            $company->setCategorie($companydata['category']);
            $company->setLogo($companydata['logo']);

            $entityManager->persist($company);
        }

        $entityManager->flush();

        return $this->redirectToRoute('get_all_company');
    }
  
    #[Route('/delete-all', name:'delete_all_companies')]
    public function deleteAllCompany(EntityManagerInterface $entityManager, CompanyRepository $companyRepository, ) {
        $companies = $companyRepository->findAll();

        if(!$companies) {
                throw $this->createNotFoundException(
                'Table is empty'
            );
        }

        foreach ($companies as $company) {
            $entityManager->remove($company);
        }

        $entityManager->flush();

        return new Response('Succesfuly deleted');
    } 
}
