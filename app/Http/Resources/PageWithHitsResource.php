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
     * Get number of Hits.
     */
    public function countHits()
    {
        return count($this->pageHits);
    }

    /**
     * Get first Hit.
     */
    public function firstHit()
    {
        return $this->pageHits->min('visited_at');
    }

    /**
     * Get first Hit.
     */
    public function lastHit()
    {
        return $this->pageHits->max('visited_at');
    }

}
