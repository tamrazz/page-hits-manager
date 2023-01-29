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
            'first_visit' => $this->firstHit()->format($this->dateFormat),
            'last_visit' => $this->lastHit()->format($this->dateFormat),
        ];
    }
}
