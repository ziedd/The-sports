<?php
namespace AppBundle\Manager;


use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class  Teams
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * teams constructor.
     */

    public function __construct()
    {
        $this->client = new Client(
            ['base_uri' => 'https://www.thesportsdb.com/']
        );

    }

    /**
     * @return string
     */
    public function showTeams()
    {
        $city = 'English'; // TODO: $city = $request->query->get('city');
        $response = $this->client->request('GET',
            'api/v1/json/1/search_all_teams.php?l=' . $city . '%20Premier%20League');
        $data = $response->getBody()->getContents();
        $data = (array)json_decode($data);
        if (!key_exists('teams', $data)) {
            throw new NotFoundHttpException('teams_not_exist');
        }
        return $data;
    }

    /**
     * @return string
     */
    public function showPlayerDetails()
    {

        $team = 'Arsenal'; // TODO: $team = $request->query->get('team');
        $response = $this->client->request('GET', 'api/v1/json/1/searchplayers.php?t=' . $team);
        $data = $response->getBody()->getContents();
        $data = (array)json_decode($data);
        if (!key_exists('player', $data)) {
            throw new NotFoundHttpException('player_not_exist');
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public static function postShowLeagues()
    {
        $client = new Client(['base_uri' => 'https://www.thesportsdb.com/']);
        $response = $client->request('GET', 'api/v1/json/1/all_leagues.php');
        $data = $response->getBody()->getContents();
        $data = (array)json_decode($data);
        $leagues = $data["leagues"];
        foreach ($leagues as $league => $val) {
            $val = (array)json_encode($val, true);
            foreach ($val as $leg) {
                $leg = explode(",", $leg);
                return (array)$leg[3];
            }
       
        }

    }

}