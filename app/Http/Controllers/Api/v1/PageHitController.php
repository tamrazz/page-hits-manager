<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KodePandai\ApiResponse\ApiResponse;
use App\Http\Requests\PageHit\PageHitAddRequest;
use App\Http\Controllers\Controller;
use App\Models\PageHit;
use App\Models\Page;
use App\Http\Resources\PageWithHitsResource;
use App\Http\Resources\PageHitResource;
use App\Http\Resources\PageHitCollection;

class PageHitController extends Controller
{
    /**
     * Add hit for secified page.
     *
     * @param   App\Http\Requests\PageHit\PageHitAddRequest  $request
     * @param   int  $id
     * @return  \Illuminate\Http\Response
     */
    public function add(PageHitAddRequest $request, $id = 0)
    {
        $page = Page::findOr($id, fn() => isset($request->path)
            ? Page::firstWhere('path', $request->path)
            : null
        );
        if (empty($page)) {
            return ApiResponse::error()
                ->statusCode(Response::HTTP_NOT_FOUND)
                ->message('Page with specified parameters not found.');
        }

        $data = ['page_id' => $page->id] + $request->validated();
        $page_hit = new PageHitResource(PageHit::create($data));

        return ApiResponse::success($page_hit)
            ->statusCode(Response::HTTP_CREATED)
            ->message('Hit registered on the page #' . $page->id);
    }

    /**
     * Get hits for secified page.
     *
     * @param   int  $id
     * @return  \Illuminate\Http\Response
     */
    public function getHits($id = 0)
    {
        $page = Page::findOr($id, fn() => null);
        if (empty($page)) {
            return ApiResponse::error()
                ->statusCode(Response::HTTP_NOT_FOUND)
                ->message('Page with specified parameters not found.');
        }

        $page_with_hits = new PageWithHitsResource($page);

        return ApiResponse::success($page_with_hits)
            ->statusCode(Response::HTTP_OK)
            ->message('Returned hits for page #' . $page->id);
    }

    /**
     * Return list of Pages with Hits.
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



}