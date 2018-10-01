<?php

namespace AppBundle\Controller;

use AppBundle\Form\LeagueSearchType;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LeagueController
 * @package AppBundle\Controller
 */
class LeagueController extends Controller
{
    /**
     * @Route("/leagues",name ="homepage")
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(LeagueSearchType::class);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
           // TODO:check the validation with query params in api
            $search = $form['league']->getData();
            return $this->redirectToRoute('league_list');
        }

        return $this->render('leagues/search.html.twig', array('form' => $form->createView()));

    }
}
