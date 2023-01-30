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
use App\Http\Filters\PageHitFilter;
use App\Http\Resources\PageWithHitsCollection;

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
        try {
            $page = Page::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e1) {
            try {
                $page = Page::where('path', $request->path)->firstOrFail();
            } catch (\Throwable $e2) {
                return ApiResponse::error()
                    ->statusCode(Response::HTTP_NOT_FOUND)
                    ->message('Page with specified parameters not found.');
            }
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
    public function getHits($id)
    {
        try {
            $page = Page::findOrFail($id);
        } catch (\Throwable $th) {
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
     * Get hits for secified page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int  $id
     * @return  \Illuminate\Http\Response
     */
    public function getHitsByParams(Request $request, $id)
    {
        $params = array_merge($request->toArray(), ['pageId' => $id]);
        $pages = $this->getPages($params);
        try {
            $page = new PageWithHitsResource($pages->firstOrFail());
        } catch (\Throwable $th) {
            return ApiResponse::error()
                ->statusCode(Response::HTTP_NOT_FOUND)
                ->message('Page with specified parameters not found.');
        }

        return ApiResponse::success($page)
            ->statusCode(Response::HTTP_OK)
            ->message('Returned hits for page #' . $page->id);
    }

    /**
     * Return list of Pages with Hits.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $pages = $this->getPages($request->toArray());
        if ($pages->isEmpty()) {
            return ApiResponse::error()
                ->statusCode(Response::HTTP_NOT_FOUND)
                ->message('No pages found dy specified parameters.');
        }

        $pages = new PageWithHitsCollection($pages);
        return ApiResponse::success($pages)
            ->statusCode(Response::HTTP_OK)
            ->message(sprintf('Returned %d pages with hits', count($pages)));
    }

    /**
     * Get hits for secified page.
     *
     * @param  array  $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getPages(array $params)
    {
        $pages = Page::withWhereHas('pageHits', fn($q) => $q->filter(new PageHitFilter($params)))->get();
        return $pages;
    }

}