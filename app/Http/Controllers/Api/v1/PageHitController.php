<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KodePandai\ApiResponse\ApiResponse;
use App\Http\Requests\PageHit\PageHitAddRequest;
use App\Http\Controllers\Controller;
use App\Models\PageHit;
use App\Models\Page;
use App\Http\Resources\PageHitResource;
use App\Http\Resources\PageHitCollection;

class PageHitController extends Controller
{
    /**
     * Return list of Hits of the Page for the entire period.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result_collection = new PageHitCollection(PageHit::all());
        $result_count = $result_collection->count();
        return ($result_count)
            ? ApiResponse::success($result_collection)
                        ->statusCode(Response::HTTP_OK)
                        ->message(sprintf('Found %d records', count($result_collection)))
            : ApiResponse::success()->statusCode(Response::HTTP_NO_CONTENT);
    }

    /**
     * Return list of Hits of the Page for the specified period.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listByPeriod(Request $request)
    {
        // return
    }

    /**
     * Return list of Hits of the Page for the entire period.
     *
     * @param   App\Http\Requests\PageHit\PageHitAddRequest  $request
     * @param   int  $page_id
     * @return  \Illuminate\Http\Response
     */
    public function add(PageHitAddRequest $request, $page_id = 0)
    {
        $page = Page::findOr($page_id, fn() => Page::firstWhere('path', $request->path));
        if (empty($page)) {
            return ApiResponse::error()
                ->statusCode(Response::HTTP_BAD_REQUEST)
                ->message('Page with specified parameters not found.');
        }

        $data = ['page_id' => $page->id] + $request->validated();
        $page_hit = new PageHitResource(PageHit::create($data));

        return ApiResponse::success($page_hit)
            ->statusCode(Response::HTTP_CREATED)
            ->message('Hit registered on the page #' . $page->id);
    }

}