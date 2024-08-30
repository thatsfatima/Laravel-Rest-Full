<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\RestResponseTrait;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\StoreUpdateArticleRequest;
use App\Http\Requests\StoreUpdateArticleStockRequest;

class ArticleController extends Controller
{
    use RestResponseTrait;

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->validated());

        return response()->json([
            'status' => $this->successStatus()
        ,   'article' => $article
        ], 201);
    }

    public function showAll()
    {
        $article = Article::All();
        return response()->json($article, 200);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article, 200);
    }

    public function update(StoreUpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->validated());

        return response()->json([
            'status' => $this->successStatus(),
            'article' => $article
        ], 200);
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['status' => $this->successStatus(), 'message' => 'Article deleted successfully'], 204);
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();

        return response()->json(['status' => $this->successStatus(), 'article' => $article], 200);
    }

    public function updateStock(StoreUpdateArticleStockRequest $request)
    {
        // dd($request);
        $articles = $request->input('article');
        $updatedArticles = [];
        $notFoundArticles = [];

        foreach ($articles as $item) {
            $article = Article::find($item['id']);

            if ($article) {
                $article->quantity += $item['quantite'];
                $article->save();
                $updatedArticles[] = $article;
            } else {
                $notFoundArticles[] = [
                    // 'article' => Article::withTrashed()->find($item['id']),
                    'id' => $item['id'],
                    'quantite' => $item['quantite']
                ];
            }
        }

        $response = [
            'status' => $this->successStatus(),
            'message' => 'Stock quantities updated successfully.',
            'updated_articles' => $updatedArticles,
            'not_found_articles' => $notFoundArticles,
        ];

        return response()->json($response, 200);
    }
}
