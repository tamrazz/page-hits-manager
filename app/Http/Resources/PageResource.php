<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class PageResource extends JsonResource
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
            'created_at' => $this->created_at->format(Config::get('pagehits.default_date_format')),
            'updated_at' => $this->updated_at->format(Config::get('pagehits.default_date_format')),
        ];
    }
}
