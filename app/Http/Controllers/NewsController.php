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
        if ($request->user()->tokenCan('news.getany')) {
            if (isset($request->id) and ! strpos($request->id, ':') and ! is_null(News::find($request->id))) {
                return new NewsResource(News::find($request->id));
            } elseif (isset($request->id) and strpos($request->id, ':')) {
                $ids = explode(':', trim(htmlspecialchars($request->id)));
                $news = News::find($ids);

                return NewsResource::collection($news);
            } elseif (! isset($request->id)) {
                return NewsResource::collection(News::all());
            } else {
                return response(['error' => 'Bad Request'], 400);
            }
        } elseif ($request->user()->tokenCan('news.get')) {
            if (isset($request->id)) {
                $news = News::find($request->id);
                if (is_null($news) or ! $news->published) {
                    return response(['error' => 'Not found'], 404);
                } else {
                    return new NewsResource($news);
                }
            } else {
                return response(['error' => 'Bad request'], 400);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function patchNews(Request $request)
    {
        if ($request->user()->tokenCan('news.update')) {
            if (isset($request->id) and ! is_null(News::find($request->id))) {
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
        if ($request->user()->tokenCan('news.delete')) {
            if (isset($request->id)) {
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
