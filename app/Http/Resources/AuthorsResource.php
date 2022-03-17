<?php

namespace App\Http\Resources;
use App\Http\Resources\BooksResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorsResource extends JsonResource
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
            'name' => $this->name,
            'country' => $this->country,
            'comment' => $this->comment,
            'books'=>BooksResource::collection($this->books)
        ];
    }
}
