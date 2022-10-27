<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorsResource;
class BooksResource extends JsonResource
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
            'author_id' => $this->author_id,
            'author_name' => $this->author_name,
            'name' => $this->name,
            'hide' => $this->hide,
            'year' => $this->year,
            'description' => $this->description,
            'img' => $this->img,
            'authors' =>$this->authors,
            'section' =>$this->sections,
        ];
    }
}
