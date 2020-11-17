<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserDiscord as UserDiscordResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    use \App\Actions\Fortify\PasswordValidationRules;

    public function match(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                return $this->getUsers($request);
            case 'PATCH':
                return $this->patchUser($request);
            case 'DELETE':
                return $this->deleteUser($request);
            default:
                return response(['error' => "Bad Request"], 400);
        }
    }

    public function getUser(Request $request) {
    	if (($request->user()->tokenCan('user.getany') and isset($request->id)) or (isset($request->id) and $request->id == $request->user()->id and $request->user()->tokenCan('user.get'))) {
            $user = User::find($request->id);
            if (is_null($user)) {
                return response(['error' => "Not Found"], 404);
            } else {
                return new UserResource($user);
            }
        } else if (($request->user()->tokenCan('user.get') or $request->user()->tokenCan('user.getany')) and !isset($request->id)) {
            return new UserResource($request->user());
        }
        return response(['error' => "Forbidden"], 403);
    }

    public function getDiscord(Request $request) {
        if (!isset($request->id)) {
            return response(['error' => "Bad Request"], 400);
        }
        if ($request->user()->tokenCan('user.discord')) {
            if ($request->user()->id != $request->id and !$request->user()->tokenCan('user.getany')) {
                return response(['error' => "Forbidden"], 403);
            }
            $user = User::find($request->id);
            if (is_null($user)) {
                return response(['error' => "Not Found"], 404);
            } else {
                return new UserDiscordResource($user);
            }
        }
        return response(['error' => "Forbidden"], 403);
    }

    public function getUsers(Request $request)
    {
        if ($request->user()->tokenCan('users.get')) {
            if (isset($request->id)) {
                $ids = explode(':', trim(htmlspecialchars($request->id)));
                $users = User::find($ids);
            } else {
                $users = User::all();
            }

            return UserResource::collection($users);
        }
        return response(['error' => "Forbidden"], 403);
    }

    public function create(Request $request)
    {
        if ($request->user()->tokenCan('users.create')) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', new Password],
                'discord' => ['numeric', 'unique:users', 'nullable'],
                'discord_nickname' => ['string', 'unique:users', 'nullable'],
            ]);

            if ($validator->fails()) {
                return response($validator->errors(), 400);
            } else {
                $user = User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'discord' => isset($input['discord']) ? $input['discord'] : null,
                    'discord_nickname' => isset($input['discord_nickname']) ? $input['discord_nickname'] : null,
                ]);

                return new UserResource($user);
            }
        }
        return response(['error' => "Forbidden"], 403);
    }

    public function patchUser(Request $request)
    {
        if ($request->user()->tokenCan('users.update')) {
            if (isset($request->id) and ! is_null(User::find($request->id)) and count($request->all()) > 0) {
                $input = $request->all();
                $validator = Validator::make($input, [
                    'name' => ['nullable', 'string', 'max:255'],
                    'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['nullable', 'string', new Password],
                    'discord' => ['numeric', 'unique:users', 'nullable'],
                    'discord_nickname' => ['string', 'unique:users', 'nullable'],
                ]);
                $user = User::find($request->id);
                if ($validator->fails()) {
                    return $validator->errors();
                }
                if (isset($input['name'])) {
                    $user->name = $input['name'];
                }
                if (isset($input['email'])) {
                    $user->email = $input['email'];
                }
                if (isset($input['password'])) {
                    $user->password = Hash::make($input['password']);
                }
                if (isset($input['discord'])) {
                    $user->discord = $input['discord'];
                }
                if (isset($input['discord_nickname'])) {
                    $user->discord_nickname = $input['discord_nickname'];
                }
                $user->save();

                return new UserResource($user);
            } else {
                return response(['error' => "Bad Request", 'reasons' => "User not found"], 400);
            }
        }
        return response(['error' => "Forbidden"], 403);
    }

    public function deleteUser(Request $request)
    {
        if ($request->user()->tokenCan('users.delete')) {
            $user = User::find($request->id);
            if (is_null($user)) {
                return response(['error' => "Bad Request"], 400);
            }
            $user->delete();
            return response(['success' => "OK"], 200);
        }
        return response(['error' => "Forbidden"], 403);
    }
}
