<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TeamsController
 * @package AppBundle\Controller
 */
class TeamsController extends Controller
{
    /**
     * @Route("/teams/list",name="teams_list")
     */
    public function showTeamsAction()
    {
        $service = $this->get("app.manager.teams");
        $list = $service->showTeams();
        return new JsonResponse($list);
    }

    /**
     * @Route("/league/list",name="league_list")
     */
    public function showAction()
    {
        $service = $this->get("app.manager.teams");
        $data = $service->showTeams();
        $teams = $data['teams'];

        foreach ($teams as $team => $val) {
            $team = (array)$val;
            $strTeam = $team['strTeam'];
            $strTeamBadge = $team['strTeamBadge'];
            $strLeague = $team['strLeague'];
        }
        return $this->render('teams/teams.html.twig', [
            'strTeam' => $strTeam,
            'strTeamBadge' => $strTeamBadge,
            'strLeague' => $strLeague
        ]);

    }
}
