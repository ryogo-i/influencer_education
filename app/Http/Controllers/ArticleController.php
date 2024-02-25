<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Suppoort\Facades\DB;
use App\Models\Article;

class ArticleController extends Controller
{
// ユーザー側の操作
    /**
     * Display the specified resource.
     *
     * @return view
     */
    public function userShow($id) 
    {
        $article = Article::find($id);

        return view('user.article', compact('article'));
    }


// 管理者側の操作

    /**
     * Display the specified resource.
     *
     * @return vieq
     */
    // お知らせ一覧
    public function articleList()
    {
        $articles = Article::all();

        return view('admin.article', ['articles' => $articles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return view
     */
    // お知らせ変更画面表示
    public function editArticle($id)
    {
        $article = Article::find($id);

        return view('admin.article_edit', ['article' => $article]);
    }

    // お知らせ　削除処理
    public function articleDelete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('article.list')->with('success', 'お知らせを削除しました。');
    }

    // お知らせを更新
    public function updateArticle(Request $request)
    {
        // バリデーション
        $request->validate([
            'posted_date' => 'required | date:Y-m-d',
            'title' => 'required | max:255',
            'article_contents' => 'required',
        ]);

        // お知らせのデータを受け取る
        $inputs = $request->all();

        // お知らせを更新する
        DB::transaction(function()use($inputs) {
            $article = Article::find($inputs['id']);
            $article->fill([
                'posted_date' => $inputs['posted_date'],
                'title' => $inputs['title'],
                'article_contents' =>$inputs['article_contents'],
            ]);  
            $article->save();
        });
        
        return redirect()->route('article.list')
            ->with('success','お知らせを更新しました。');
    }

    // お知らせ新規作成作成画面
    public function createArticle()
    {
        return view('admin.article_create');
    }
    // お知らせ新規作成
    public function storeArticle(Request $request)
    {
       
        // バリデーション
        $request->validate([
            'posted_date' => 'required | date',
            'title' => 'required | max:255',
            'article_contents' => 'required',
        ]);

        // お知らせのデータを受け取る
        $inputs = $request->all();
        // お知らせを登録する
        DB::transaction(function() use($inputs) {
           Article::create($inputs); 
        });
        
        return redirect()->route('article.list')
            ->with('success','新規お知らせを登録しました。');
    }
}
