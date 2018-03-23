<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Merchandise;
use AppBundle\Entity\Person;
use AppBundle\Form\SerialForm;
use AppBundle\Form\snitchForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/",name="homepage")
     */
    public function indexAction(){
        return $this->render('home.htm.twig');
    }
    /**
     * @Route("/person", name="personpage")
     */

    public function personAction(Request $request)
    {
        $form = $this->createForm(snitchForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $idNumber = $request->request->get('idNumber');
            $person = $em->getRepository("AppBundle:Person")->findOneBy(['idNumber' => $idNumber]);
            if ($person) {
                // return $this->redirectToRoute('new-user',['id'=>$user->getId()]);
                $route = $this->generateUrl('view-profile', ['id' => $person->getId()]);
                return new Response($route, 200);
            } else {
                return new Response(null, 500);
            }
        }

        return $this->render('person.htm.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/merchandise", name="merchandisepage")
     */

    public function merchandiseAction(Request $request)
    {
        $form = $this->createForm(SerialForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $serial = $form['serialNumber']->getData();
            $org = $form['organization']->getData();
            $merchandise = $em->getRepository("AppBundle:Merchandise")->findOneBy(
                [
                    'serialNumber' => $serial,
                    'organization'=>$org
                ]
            );
            if ($merchandise) {
                // return $this->redirectToRoute('new-user',['id'=>$user->getId()]);
                $route = $this->generateUrl('view-merchandise', ['id' => $merchandise->getId()]);
                return new Response($route, 200);
            } else {
                return new Response(null, 500);
            }
        }

        return $this->render('merchandise.htm.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/view/{id}/profile",name="view-profile")
     */
    public function viewProfileAction(Request $request,Person $person){
        $em = $this->getDoctrine()->getManager();
        $stats = $em->getRepository("AppBundle:ProfileStats")
            ->findOneBy([
                'person'=>$person->getId()
            ]);
        $hits = $stats->getHits();
        $hits++;
        $stats->setHits($hits);
        $em->persist($stats);
        $em->flush();

        return $this->render('person/view.htm.twig',[
            'person'=>$person
        ]);
    }
    /**
     * @Route("/view/{id}/product",name="view-merchandise")
     */
    public function viewProductAction(Request $request,Merchandise $merchandise){

        return $this->render('viewMerchandise.htm.twig',[
            'merchandise'=>$merchandise
        ]);
    }
    /**
     * @Route("/business", name="businesspage")
     */

    public function businessAction(Request $request)
    {
        $form = $this->createForm(snitchForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $businessName = $request->request->get('businessName');
            $person = $em->getRepository("AppBundle:Business")->findOneBy(['businessName' => $businessName]);
            if ($person) {
                // return $this->redirectToRoute('new-user',['id'=>$user->getId()]);
                $route = $this->generateUrl('view-profile', ['id' => $person->getId()]);
                return new Response($route, 200);
            } else {
                return new Response(null, 500);
            }
        }

        return $this->render('business.htm.twig',[
            'form' => $form->createView()
        ]);
    }

}
