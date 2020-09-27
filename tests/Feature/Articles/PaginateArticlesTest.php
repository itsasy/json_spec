<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginateArticlesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_paginated_article()
    {
        $this->withoutExceptionHandling();

        $articles = factory(Article::class)->times(10)->create();

        //Las páginas contendrán 2 elementos y de eso me traerá a la 3era [4,5];
        $url = route('article.index', ['page[size]' => 2, 'page[number]' => 3]);

        $response = $this->get($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($articles[0]->title)
            ->assertDontSee($articles[1]->title)

            ->assertDontSee($articles[2]->title)
            ->assertDontSee($articles[3]->title)

            ->assertSee($articles[4]->title)
            ->assertSee($articles[5]->title)

            ->assertDontSee($articles[6]->title)
            ->assertDontSee($articles[7]->title)

            ->assertDontSee($articles[8]->title)
            ->assertDontSee($articles[9]->title);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);
        $response->assertJsonFragment([
            'first' => route('article.index', ['page[size]' => 2, 'page[number]' => 1]),
            'last' => route('article.index', ['page[size]' => 2, 'page[number]' => 5]),
            'prev' => route('article.index', ['page[size]' => 2, 'page[number]' => 2]),
            'next' => route('article.index', ['page[size]' => 2, 'page[number]' => 4]),
        ]);
    }
}
