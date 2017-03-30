<?php
namespace App\Http\Controllers;

use Request;

// use Auth;
// use Authorizer;
use Response;
use App\Exceptions\ValidationException;
use App\Models\Game;
use App\Http\Controllers\Controller;
use DB;
use Config;
use Validator;

class GamesController extends Controller {
    private $game;

    public function __construct(Game $game) {
    	$this->game = $game;    
    }

    public function getIndex()
    {
        $limit = 2;
        $sortColumn = 'id';
        $orderBy = 'DESC';

        $game = $this->game
        ->join('game_category as g_c', 'game.id', '=', 'g_c.game_id')
        ->join('category as c', 'c.id', '=', 'g_c.category_id')
        ->join('users as u', 'u.id', '=', 'game.creator_id')
        ->orderBy($sortColumn, $orderBy);

        $results = $game->paginate($limit, [
            'game.id', 'game.name as game_name', 'game.description', 'game.main_picture',
            'c.name as category', 'u.name as username'
        ], 'page');

        if (!$results->total()) {
            return array(
                "rows"=> array(),
                "total" => 0
            );
        }

        return Response::json([
            'rows' => $results->items(),
            'total' => $results->total()
        ]);
    }
}