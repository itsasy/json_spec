<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticlesCollection extends ResourceCollection
{
    public $collects = ArticleResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
