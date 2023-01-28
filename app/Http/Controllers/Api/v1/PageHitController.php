<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
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
        return new PageHitCollection(PageHit::all());
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
            return 'error';
        }
        $data = ['page_id' => $page->id] + $request->validated();
        $page_hit = new PageHitResource(PageHit::create($data));

        return  $page_hit;
    }

}