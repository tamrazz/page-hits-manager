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
        $date_format = $this->created_at->format(Config::get('project.default_date_format'));

        return [
            'id' => $this->id,
            'path' => $this->path,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $date_format,
            'updated_at' => $date_format,
        ];
    }
}
