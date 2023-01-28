<?php

namespace App\Http\Resources;

class PageResource extends ProjectResource
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
            'id' => $this->id,
            'path' => $this->path,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->format($this->dateFormat),
            'updated_at' => $this->updated_at->format($this->dateFormat),
        ];
    }
}
