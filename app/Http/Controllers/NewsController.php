<?php

namespace App\Http\Controllers;

use App\Http\Resources\News as NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function match(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                return $this->getNews($request);
            case 'PATCH':
                return $this->patchNews($request);
            case 'DELETE':
                return $this->deleteNews($request);
            default:
                return response(['error' => 'Bad Request'], 400);
        }
    }

    public function getNews(Request $request)
    {
        $user = $request->user();
        $news_id = $request->id;
        if ($user->tokenCan('news.get') or $user->tokenCan('news.admin.get')) {
            if (!is_null($news_id) and strpos($news_id, ':') === false) {
                $news_builder = News::where('id', $news_id);
                if (! $user->tokenCan('news.admin.get')) {
                    $news_builder->published()->orWhere('user_id', $user->id)->where('id', $news_id);
                }
                return new NewsResource($news_builder->get());
            } elseif (! is_null($news_id) and strpos($news_id, ':') >= 0) {
                $ids = explode(':', trim(htmlspecialchars($news_id)));
                $news_builder = News::whereIn('id', $ids);
                if (! $user->tokenCan('news.admin.get')) {
                    $news_builder->published()->orWhere('user_id', $user->id)->whereIn('id', $ids);
                }
                return NewsResource::collection($news_builder->get());
            } elseif (! isset($request->id)) {
                if ($user->tokenCan('news.admin.get')) {
                    return NewsResource::collection(News::withoutGlobalScopes()->get());
                } else {
                    return NewsResource::collection(News::all());
                }
            } else {
                return response(['error' => 'Bad Request'], 400);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function patchNews(Request $request)
    {
        $user = $request->user();
        $news_id = $request->id;
        if ($user->tokenCan('news.update') and $user->hasNews($news_id) or $user->tokenCan('news.admin.update')) {
            if (! is_null($news_id) and ! is_null(News::find($news_id))) {
                $input = $request->all();
                $validator = Validator::make($input, [
                    'title' => ['string', 'max:255', 'unique:news'],
                    'content' => ['string'],
                    'discordable' => ['boolean'],
                    'published' => ['boolean'],
                ]);
                if ($validator->fails()) {
                    return response(['error' => 'Bad Request', 'details' => $validator->errors()], 400);
                } else {
                    $news = News::find($request->id);
                    foreach ($input as $key => $value) {
                        $news->$key = $value;
                    }
                    $news->save();

                    return new NewsResource($news);
                }
            } else {
                return response(['error' => 'Bad request'], 400);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function deleteNews(Request $request)
    {
        $user = $request->user();
        $news_id = $request->id;
        if (($user->tokenCan('news.delete') and $user->hasNews($news_id)) or $user->tokenCan('news.admin.delete')) {
            if (! is_null($news_id)) {
                $news = News::find($request->id);
                if (is_null($news)) {
                    return response(['error' => 'Not found'], 404);
                } else {
                    $news->delete();

                    return response(['success' => 'OK'], 200);
                }
            } else {
                return response(['error' => 'Bad request'], 400);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function createNews(Request $request)
    {
        if ($request->user()->tokenCan('news.create')) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'title' => ['required', 'string', 'max:255', 'unique:news'],
                'content' => ['required', 'string'],
                'discordable' => ['required', 'boolean'],
                'published' => ['required', 'boolean'],
            ]);
            if ($validator->fails()) {
                return response(['error' => 'Bad Request', 'details' => $validator->errors()], 400);
            } else {
                $news = News::create([
                    'title' => $input['title'],
                    'content' => $input['content'],
                    'discordable' => $input['discordable'],
                    'published' => $input['published'],
                    'user_id' => $request->user()->id,
                ]);

                return new NewsResource($news);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
