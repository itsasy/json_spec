<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => 'articles',
            'id' => (string) $this->resource->id,
            'atributes' => [
                'title' => $this->resource->title,
                'slug' => $this->resource->slug,
                'content' => $this->resource->content,
            ],
            'links' => [
                'self' => route('article.show', $this->resource->id)
            ]
        ];
    }
}
