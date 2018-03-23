<?php

namespace AppBundle\Controller\Management;

use AppBundle\Entity\AuditLog;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Business;
use AppBundle\Entity\Education;
use AppBundle\Entity\License;
use AppBundle\Entity\Merchandise;
use AppBundle\Entity\Organization;
use AppBundle\Entity\Person;
use AppBundle\Entity\Profile;
use AppBundle\Entity\ProfileStats;
use AppBundle\Form\BrandForm;
use AppBundle\Form\BusinessForm;
use AppBundle\Form\EducationForm;
use AppBundle\Form\LicenseForm;
use AppBundle\Form\MerchandiseForm;
use AppBundle\Form\OrganizationForm;
use AppBundle\Form\PersonForm;
use AppBundle\Form\ProfileForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 *
 */
class SnitchController extends Controller
{
    /**
     * @Route("/",name="admin-dashboard")
     */
    public function adminDashboard(Request $request){
        $em = $this->getDoctrine()->getManager();

        $personLogs = $em->getRepository("AppBundle:AuditLog")
            ->findBy([
                'recordType'=>"Person"],
                [
                'createdAt'=>'desc'
            ]);
        $organizationLogs = $em->getRepository("AppBundle:AuditLog")
            ->findBy([
                'recordType'=>"Organization"],
                [
                    'createdAt'=>'desc'
            ]);
        $profileLogs = $em->getRepository("AppBundle:AuditLog")
            ->findBy([
                'recordType'=>"Profile"],
                [
                    'createdAt'=>'desc'
            ]);
        $userLogs = $em->getRepository("AppBundle:AuditLog")
            ->findBy([
                'recordType'=>"User"],
                [
                    'createdAt'=>'desc'
            ]);
        $stats = $em->getRepository("AppBundle:ProfileStats")
            ->findBy(
                [],
                [
                'hits'=>'Desc'
            ],
                5
            );

        return $this->render('admin/dashboard.htm.twig',[
            'personLogs'=>$personLogs,
            'organizationLogs'=>$organizationLogs,
            'profileLogs'=>$profileLogs,
            'userLogs'=>$userLogs,
            'stats'=>$stats
        ]);
    }

    /**
     * @Route("/person/new.cpp",name="new-person")
     */
    public function newPersonAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $person = new Person();
        $person->setCreatedBy($user);
        $person->setCountry("KE");

        $form = $this->createForm(PersonForm::class,$person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $firstName = $form['firstName']->getData();
            $lastName = $form['lastName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Person");
            $log->setLog($firstName. " ". $lastName. " created by ".$user->getFullName());

            $stats = new ProfileStats();
            $stats->setPerson($person);
            $stats->setHits(0);

            $em->persist($person);
            $em->persist($log);
            $em->persist($stats);

            $em->flush();

            return $this->redirectToRoute("persons_list");
        }


        return $this->render('admin/person/new.htm.twig',[
            'personForm'=>$form ->createView()
        ]);
    }
    /**
     * @Route("/person/{id}/new.cpp",name="new-profile")
     */
    public function newProfileAction(Request $request,Person $person){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $profile = new Profile();
        $profile->setCreatedBy($user);
        $profile->setPerson($person);

        $form = $this->createForm(ProfileForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $profile = $form->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Profile");
            $log->setLog("A new Profile for: ".$person->getFullNames()." created by ".$user->getFullName());

            $em->persist($profile);

            $em->flush();

            return $this->redirectToRoute("persons_list");
        }


        return $this->render('admin/profile/new.htm.twig',[
            'profileForm'=>$form ->createView(),
            'person'=>$person
        ]);
    }
    /**
     * @Route("/person/{id}/newEducation.cpp",name="new-education")
     */
    public function newEducationAction(Request $request,Person $person){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $education = new Education();
        $education->setCreatedBy($user);
        $education->setWhoseEducation($person);

        $form = $this->createForm(EducationForm::class,$education);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $profile = $form->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Education");
            $log->setLog("A new Education for: ".$person->getFullNames()." created by ".$user->getFullName());

            $em->persist($profile);

            $em->flush();

            return $this->redirectToRoute("persons_list");
        }


        return $this->render('admin/education/new.htm.twig',[
            'profileForm'=>$form ->createView(),
            'person'=>$person
        ]);
    }

    /**
     * @Route("/persons",name="persons_list")
     */
    public function listPersons(Request $request){
        $persons = $this->getDoctrine()->getRepository("AppBundle:Person")
            ->findAll();

        return $this->render("admin/person/list.htm.twig",[
            'persons'=> $persons
        ]);
    }
    /**
     * @Route("/view/{id}/edit",name="edit-person")
     */
    public function viewProfileAction(Request $request,Person $person){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PersonForm::class,$person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Person");
            $log->setLog($person->getFullNames() ." updated by".$user->getFullName());

            $em->persist($log);
            $em->persist($person);

            $em->flush();

            return $this->redirectToRoute("persons_list");
        }


        return $this->render('admin/person/edit.htm.twig',[
            'personForm'=>$form ->createView(),
            'person'=>$person
        ]);
    }

    /**
     * @Route("/merchandise/new.cpp",name="new-merchandise")
     */
    public function newMerchandiseAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $merchandise = new Merchandise();
        $merchandise->setCreatedBy($user);

        $form = $this->createForm(MerchandiseForm::class,$merchandise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $serialNumber = $form['serialNumber']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Merchandise");
            $log->setLog($serialNumber ." created by ".$user->getFullName());

            $em->persist($person);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("merchandise_list");
        }


        return $this->render('admin/merchandise/new.htm.twig',[
            'merchandiseForm'=>$form ->createView()
        ]);
    }
    /**
     * @Route("/merchandise",name="merchandise_list")
     */
    public function listMerchandise(Request $request){
        $merchanise = $this->getDoctrine()->getRepository("AppBundle:Merchandise")
            ->findAll();

        return $this->render("admin/merchandise/list.htm.twig",[
            'merchandise'=> $merchanise
        ]);
    }
    /**
     * @Route("/merchandise/{id}/edit.cpp",name="edit-merchandise")
     */
    public function editMerchandiseAction(Request $request,Merchandise $merchandise){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(MerchandiseForm::class,$merchandise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $serialNumber = $form['serialNumber']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Merchandise");
            $log->setLog($merchandise->getSerialNumber() ." update by ".$user->getFullName());

            $em->persist($person);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("merchandise_list");
        }


        return $this->render('admin/merchandise/new.htm.twig',[
            'merchandiseForm'=>$form ->createView()
        ]);
    }
    /**
     * @Route("/business/new.cpp",name="new-business")
     */
    public function newBusinessAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $business = new Business();
        $business->setCreatedBy($user);
        $business->setCountry("KE");

        $form = $this->createForm(BusinessForm::class,$business);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $businessName = $form['businessName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Business");
            $log->setLog($businessName.  " created by ".$user->getFullName());

            $em->persist($person);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("business_list");
        }


        return $this->render('admin/business/new.htm.twig',[
            'businessForm'=>$form ->createView()
        ]);
    }
    /**
     * @Route("/business/{id}/new.cpp",name="new-license")
     */
    public function newLicenseAction(Request $request,Business $business){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $license = new License();
        $license->setCreatedBy($user);
        $license->setBusiness($business);

        $form = $this->createForm(LicenseForm::class,$license);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $profile = $form->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("License");
            $log->setLog("A new License for: ".$business->getBusinessName()." created by ".$user->getFullName());

            $em->persist($profile);

            $em->flush();

            return $this->redirectToRoute("business_list");
        }


        return $this->render('admin/license/new.htm.twig',[
            'licenseForm'=>$form ->createView(),
            'business'=>$business
        ]);
    }
    /**
     * @Route("/business/{id}/edit.cpp",name="edit-business")
     */
    public function editBusinessAction(Request $request,Business $business){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(BusinessForm::class,$business);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $businessName = $form['businessName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Business");
            $log->setLog($businessName.  " Updated by ".$user->getFullName());

            $em->persist($person);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("business_list");
        }


        return $this->render('admin/business/edit.htm.twig',[
            'businessForm'=>$form ->createView(),
            'business'=>$business
        ]);
    }
    /**
     * @Route("/business",name="business_list")
     */
    public function listBusinesses(Request $request){
        $businesses = $this->getDoctrine()->getRepository("AppBundle:Business")
            ->findAll();

        return $this->render("admin/business/list.htm.twig",[
            'businesses'=> $businesses
        ]);
    }

    /**
     * @Route("/organization/new.cpp",name="new-organization")
     */
    public function newOrganizationAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $org = new Organization();
        $org->setCreatedBy($user);

        $form = $this->createForm(OrganizationForm::class,$org);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $organization = $form->getData();
            $name = $form['organizationName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Organization");
            $log->setLog($name." created by ".$user->getFullName());

            $em->persist($organization);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("organizations_list");
        }


        return $this->render('admin/organization/new.htm.twig',[
            'organizationForm'=>$form ->createView()
        ]);
    }

    /**
     * @Route("/organizations",name="organizations_list")
     */
    public function listOrganizations(Request $request){
        $orgs = $this->getDoctrine()->getRepository("AppBundle:Organization")
            ->findAll();

        return $this->render("admin/organization/list.htm.twig",[
            'organizations'=> $orgs
        ]);
    }
    /**
     * @Route("/organization/{id}/edit.cpp",name="edit-organization")
     */
    public function editOrganizationAction(Request $request,Organization $org){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(OrganizationForm::class,$org);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $organization = $form->getData();
            $name = $form['organizationName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Organization");
            $log->setLog($name." updated by ".$user->getFullName());

            $em->persist($organization);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("organizations_list");
        }


        return $this->render('admin/organization/update.htm.twig',[
            'organizationForm'=>$form ->createView(),
            'org'=>$org
        ]);
    }
    /**
     * @Route("/brands/new.cpp",name="new-brand")
     */
    public function newBrandAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $org = new Brand();
        $org->setCreatedBy($user);

        $form = $this->createForm(BrandForm::class,$org);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $organization = $form->getData();
            $name = $form['organizationName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Brand");
            $log->setLog($name." created by ".$user->getFullName());

            $em->persist($organization);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("brands_list");
        }


        return $this->render('admin/brand/new.htm.twig',[
            'organizationForm'=>$form ->createView()
        ]);
    }

    /**
     * @Route("/brands",name="brands_list")
     */
    public function listBrands(Request $request){
        $orgs = $this->getDoctrine()->getRepository("AppBundle:Brand")
            ->findAll();

        return $this->render("admin/brand/list.htm.twig",[
            'organizations'=> $orgs
        ]);
    }
    /**
     * @Route("/brands/{id}/edit.cpp",name="edit-brand")
     */
    public function editBrandAction(Request $request,Brand $org){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(OrganizationForm::class,$org);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $organization = $form->getData();
            $name = $form['organizationName']->getData();

            $log = new AuditLog();
            $log->setCreatedAt(new \DateTime());
            $log->setRecordType("Brand");
            $log->setLog($name." updated by ".$user->getFullName());

            $em->persist($organization);
            $em->persist($log);

            $em->flush();

            return $this->redirectToRoute("brands_list");
        }


        return $this->render('admin/brand/update.htm.twig',[
            'organizationForm'=>$form ->createView(),
            'org'=>$org
        ]);
    }

}
