<?php
namespace App\Http\Controllers;

use Request;

// use Auth;
// use Authorizer;
use Response;
use App\Exceptions\ValidationException;
use App\Models\News;
use App\Http\Controllers\Controller;
use DB;
use Config;
use Validator;

class NewsController extends Controller {
    private $news;

    public function __construct(News $news) {
    	$this->news = $news;    
    }

    public function getIndex()
    {
        $limit = 2;
        $sortColumn = 'news.id';
        $orderBy = 'DESC';

        $news = $this->news
                ->join('users as u', 'u.id', '=', 'news.creator_id')
                ->orderBy($sortColumn, $orderBy);

        $results = $news->paginate($limit, [
            'news.id', 'title', 'text', 'image_url', 'u.name as username'
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