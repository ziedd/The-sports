<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PlayerController
 * @package AppBundle\Controller
 */
class PlayerController extends Controller
{
    /**
     * @Route("/player/details",name="player_details")
     */
    public function showPlayerAction()
    {
        $service = $this->get("app.manager.teams");
        $data = $service->showPlayerDetails();
        $teams = $data['player'];

        foreach ($teams as $team  ) {
            $team = (array)$team;
           
        }
        return $this->render('player/player.html.twig', [
            'strPlayer' => $team['strPlayer'],
            'strSigning' => $team['strSigning'],
            'strNationality' => $team['strNationality'],
            'dateBorn' => $team['dateBorn'],
            'strPosition' => $team['strPosition'],
            'strWeight' => $team['strWeight'],
            'strThumb' => $team['strThumb']
        ]);

    }
}
