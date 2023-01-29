<?php

namespace App\Http\Resources;

class PageWithHitsResource extends ProjectResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'page_id' => $this->id,
            'path' => $this->path,
            'hits' => $this->countHits(),
            'server_time' => $this->getServerTime()->format($this->dateFormat),
            'first_visit' => $this->firstHit()->format($this->dateFormat),
            'last_visit' => $this->lastHit()->format($this->dateFormat),
        ];
    }

    /**
     * Create a new Page resource by Hit collection.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $resource
     * @return null|\App\Http\Resources\PageWithHitsResource
     */
    public static function constructByHitCollection(\Illuminate\Database\Eloquent\Collection $hits) {
        try {
            $page = $hits->firstOrFail()->page;
        } catch (\Throwable $th) {
            return null;
        }
        $page->pageHits = $hits;
        return new PageWithHitsResource($page);
    }
}
