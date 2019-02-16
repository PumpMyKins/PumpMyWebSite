<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNews;
use App\Http\Requests\UpdateNews;
use Auth;
use Gate;


class NewsController extends Controller
{
    public function getForm(){

    	return view('basicPage.news.addnews');
    }

    public function index()
    {
        $news = News::published()->paginate();
        return view('basicPage.news.index', compact('news'));
    }
    public function create() {

        return view('basicPage.news.create');
    }
    public function store(StoreNews $request) {

    $data = $request->only('title', 'content','tag_id');
    $data['slug'] = str_slug($data['title']);
    $data['user_id'] = Auth::user()->id;
    $news = News::create($data);
    return redirect()->route('edit_news', ['id' => $news->id]);

    }
    public function draft() {

        $newsQuery = News::unpublished();
        if(Gate::denies('can_manage_news')) {

            $newsQuery = $newsQuery->where('user_id', Auth::user()->id);
        }
        $news = $newsQuery->paginate();
        return view('basicPage.news.index', compact('news'));
    }

    public function edit(News $news){

        return view('basicPage.news.edit', compact('news'));
    }

    public function update(News $news, UpdateNews $request) {

        $data = $request->only('title', 'content', 'tag_id');
        $data['slug'] = str_slug($data['title']);
        $news->fill($data)->save();
        return back();

    }

    public function publish(News $news) {

        $news->display = true;
        $news->save();
        return back();
    }

    public function show($id){

        $news = News::published()->find($id);
        if($news == null) {
            $news = News::unpublished()->findOrFail($id);
        }
        return view('basicPage.news.show', compact('news'));
    }

    public function delete($id) {

        $news = News::find($id);
        if($news == null) {
            return abort(404);
        }
        $news->forceDelete();

        return view('basicPage.news.index');
    }
}
