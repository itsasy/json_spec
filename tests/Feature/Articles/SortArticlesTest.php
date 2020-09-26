<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SortArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_article_by_title_asc()
    {
        factory(Article::class)->create(['title' => 'C title']);
        factory(Article::class)->create(['title' => 'B title']);
        factory(Article::class)->create(['title' => 'A title']);

        $url = route('article.index', ['sort' => 'title']);

        $response = $this->get($url);

        $response->assertSeeInOrder([
            'A title',
            'B title',
            'C title'
        ]);
    }

    /** @test */
    public function it_can_sort_article_by_title_desc()
    {
        factory(Article::class)->create(['title' => 'B title']);
        factory(Article::class)->create(['title' => 'C title']);
        factory(Article::class)->create(['title' => 'A title']);

        $url = route('article.index', ['sort' => '-title']);

        $response = $this->get($url);

        $response->assertSeeInOrder([
            'C title',
            'B title',
            'A title'
        ]);
    }

    /** @test */
    public function it_can_sort_article_by_title_and_content_asc()
    {
        factory(Article::class)->create([
            'title' => 'C title',
            'content' => 'B content'
        ]);
        factory(Article::class)->create([
            'title' => 'A title',
            'content' => 'C content'
        ]);
        factory(Article::class)->create([
            'title' => 'B title',
            'content' => 'D content'
        ]);

       /*  \DB::listen(function($db){
            dump($db->sql);
        }); */

        $url = route('article.index') . '?sort=title,content';

        $response = $this->get($url);

        $response->assertSeeInOrder([
            'A title',
            'B title',
            'C title'
        ]);
    }

     /** @test */
     public function it_can_sort_article_by_title_and_content_desc()
     {
         factory(Article::class)->create([
             'title' => 'C title',
             'content' => 'B content'
         ]);
         factory(Article::class)->create([
             'title' => 'A title',
             'content' => 'C content'
         ]);
         factory(Article::class)->create([
             'title' => 'B title',
             'content' => 'D content'
         ]);


         $url = route('article.index') . '?sort=-content,title';

         $response = $this->get($url);

         $response->assertSeeInOrder([
             'D content',
             'C content',
             'B content'
         ]);
     }

      /** @test */
     public function it_cannot_sort_article_by_unknow_fields(){
         factory(Article::class)->times(3)->create();

         $url = route('article.index'). '?sort=unknow';

         $response = $this->get($url);

         $response->assertStatus(400);
     }
}
