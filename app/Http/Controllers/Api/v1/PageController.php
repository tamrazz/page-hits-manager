<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KodePandai\ApiResponse\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Resources\PageResource;
use App\Http\Resources\PageCollection;
use App\Http\Filters\PageFilter;
use App\Http\Resources\PageHitCollection;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new PageFilter($request->toArray());
        $result_collection = new PageCollection(Page::filter($filter)->get());
        $result_count = $result_collection->count();
        return ($result_count)
            ? ApiResponse::success($result_collection)
                        ->statusCode(Response::HTTP_OK)
                        ->message(sprintf('Found %d records', count($result_collection)))
            : ApiResponse::success()->statusCode(Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ApiResponse::error()
                            ->statusCode(Response::HTTP_METHOD_NOT_ALLOWED)
                            ->message('This method is not available now.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOr($id, fn() => null);
        return (isset($page))
            ? ApiResponse::success(new PageResource($page))
                        ->statusCode(Response::HTTP_OK)
                        ->message('Found page #' . $page->id)
            : ApiResponse::error()
                        ->statusCode(Response::HTTP_NOT_FOUND)
                        ->message('Page not found.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ApiResponse::error()
                            ->statusCode(Response::HTTP_METHOD_NOT_ALLOWED)
                            ->message('This method is not available now.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ApiResponse::error()
                            ->statusCode(Response::HTTP_METHOD_NOT_ALLOWED)
                            ->message('This method is not available now.');
    }

    /**
     * Display Hits of specified Page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getHits(Request $request, $id)
    {
        // dd($request->ip_address);
        $hits = new PageHitCollection(Page::find($id)->pageHits);
        return $hits;
    }
}
