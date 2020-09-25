<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AssetRepository;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(AssetRepository  $assetRepository)
    {
        $assets = $assetRepository->findBy([], ['id' => 'DESC']);

        return $this->render('list/index.html.twig', [
            'assets' => $assets,
        ]);
    }
}