<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover' => $this->cover_full_path,
            'description' => $this->whenAppended('description', $this->description),
            'price' => $this->price,
            'authors' => AuthorResource::collection($this->whenLoaded('authors', $this->authors)),
            'genres ' => GenreResource::collection($this->whenLoaded('genres', $this->genres)),
        ];
    }
}
