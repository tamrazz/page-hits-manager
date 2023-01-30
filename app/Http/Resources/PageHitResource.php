<?php

namespace App\Http\Resources;

class PageHitResource extends ProjectResource
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
            'path' => $this->page->path,
            'ip_address' => $this->ip_address,
            'visited_at' => $this->visited_at->format($this->dateFormat),
        ];
    }
}
