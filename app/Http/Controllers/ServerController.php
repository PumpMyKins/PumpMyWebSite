<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServer;
use App\Http\Requests\UpdateServer;
use App\Http\Requests\SearchServerRequest;
use Carbon\Carbon;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::open()->paginate(20);
        $future_server = Server::notYetOpen()->paginate(20);
        return view('basicPage.server.index', compact('servers', 'future_server'));
    }

    public function indexWithResearch(SearchServerRequest $request)
    {

        if($request->open) {
            $servers = Server::open()->paginate(20);
        }
        if($request->development) {
            $future_server = Server::notYetOpen()->paginate(20);
        }
        if($request->close) {
            $old_server = Server::close()->paginate(20);
        }
        return view('basicPage.server.index', compact('servers', 'future_server', 'old_server' ));

    }

    public function create()
    {
        $server = new Server;
        return view('basicPage.server.create', ['server' => $server]);

    }
    public function store(StoreServer $request) {

    $data = $request->only('name', 'short_description', 'ip','description','open_date');
    $data['slug'] = str_slug($data['name']);
    if($request->hasFile('image')) {

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/server');
        $image->move($destinationPath, $name);
        $data['image'] = $name;
    }
    $server = Server::create($data);
    return redirect()->route('edit_server', ['id' => $server->id]);

    }

    public function edit(Server $server){

        return view('basicPage.server.edit', compact('server'));
    }

    public function update(Server $server, UpdateServer $request) {

        $data = $request->only('name', 'short_description', 'ip','description','open_date');
        if($request->hasFile('image')) {

            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/server');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        $data['slug'] = str_slug($data['name']);
        $server->fill($data)->save();
        return redirect()->route('list_server');

    }

    public function show($id){

        $server = Server::find($id);
        if($server == null){
            return abort(404);
        }
        return view('basicPage.server.show', compact('server'));
    }

    public function delete($id)
    {
        $server = Server::find($id);
        if($server == null){
            return abort(404);
        }
        $server->forceDelete();
        return view('basicPage.server.index');
    }

    public function forceopen($id)
    {
        $server = Server::find($id);
        if($server == null){
            return abort(404);
        }
        $server->open_date = Carbon::now();
        $server->save();
        return back();
    }

    public function close($id)
    {
        $server = Server::find($id);
        if($server == null){
            return abort(404);
        }
        $server->close = true;
        $server->save();
        return back();
    }

    public function reopen($id)
    {
        $server = Server::find($id);
        if($server == null){
            return abort(404);
        }
        $server->close = false;
        $server->save();
        return back();
    }
}
