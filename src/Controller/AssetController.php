<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Asset;
use App\Form\AssetType;
use Symfony\Component\HttpFoundation\Request;

class AssetController extends AbstractController
{
    /**
     * @Route("/asset/{id}", name="app_asset", requirements={"id"="\d+"})
     */
    public function index(Asset $asset)
    {
        return $this->render('asset/index.html.twig', [
            'controller_name' => 'AssetController',
            'asset' => $asset,
        ]);
    }

    /**
     * @Route("/asset/add", name="add_asset")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function addAsset(Request $request)
   {
        $asset = new Asset();
        $form = $this->createForm(AssetType::class, $asset);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid())
       {
           //$asset->setUser($this->getUser());
           //$asset->setCreated(new \DateTime());
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($asset);
           $entityManager->flush();
           return $this->redirectToRoute("app_asset", ['id' => $asset->getId()]);
       }

       return $this->render('asset/add.html.twig', [
           'questionForm' => $form->createView()
       ]);
   }


}
