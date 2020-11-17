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
    public function match(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                return $this->getUser($request);
            case 'PATCH':
                return $this->patchUser($request);
            case 'DELETE':
                return $this->deleteUser($request);
            default:
                return response(['error' => 'Bad Request'], 400);
        }
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        $user_id = $request->id;
        if (($user->tokenCan('user.admin.get') and ! is_null($user_id)) or (!is_null($user_id) and $user_id == $user->id and $user->tokenCan('user.get'))) {
            if (is_null(User::find($user_id))) {
                return response(['error' => 'Not Found'], 404);
            } else {
                return new UserResource(User::find($user_id));
            }
        } elseif (($user->tokenCan('user.get') or $user->tokenCan('user.admin.get')) and is_null($user_id)) {
            return new UserResource($request->user());
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function getDiscord(Request $request)
    {
        $user = $request->user();
        $user_id = $request->id;
        if (is_null($user_id)) {
            return response(['error' => 'Bad Request'], 400);
        }
        if (($user->tokenCan('user.get.discord') and $user_id == $user->id) or $user->tokenCan('user.admin.get.discord')) {
            $requested_user = User::find($user_id);
            if (is_null($requested_user)) {
                return response(['error' => 'Not Found'], 404);
            } else {
                return new UserDiscordResource($requested_user);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function getUsers(Request $request)
    {
        if ($request->user()->tokenCan('user.admin.get')) {
            if (isset($request->ids)) {
                $ids = explode(':', trim(htmlspecialchars($request->ids)));
                $users = User::find($ids);
            } else {
                $users = User::all();
            }

            return UserResource::collection($users);
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function createUser(Request $request)
    {
        if ($request->user()->tokenCan('user.admin.create')) {
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

        return response(['error' => 'Forbidden'], 403);
    }

    public function patchUser(Request $request)
    {
        $user = $request->user();
        $user_id = $request->id;
        if ($user->tokenCan('user.admin.update')) {
            if (isset($user_id) and ! is_null(User::find($user_id)) and count($request->all()) > 1) {
                $input = $request->all();
                $validator = Validator::make($input, [
                    'name' => ['nullable', 'string', 'max:255'],
                    'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['nullable', 'string', new Password],
                    'discord' => ['numeric', 'unique:users', 'nullable'],
                    'discord_nickname' => ['string', 'unique:users', 'nullable'],
                ]);
                $requested_user = User::find($user_id);
                if ($validator->fails()) {
                    return $validator->errors();
                }
                if (isset($input['name'])) {
                    $requested_user->name = $input['name'];
                }
                if (isset($input['email'])) {
                    $requested_user->email = $input['email'];
                }
                if (isset($input['password'])) {
                    $requested_user->password = Hash::make($input['password']);
                }
                if (isset($input['discord'])) {
                    $requested_user->discord = $input['discord'];
                }
                if (isset($input['discord_nickname'])) {
                    $requested_user->discord_nickname = $input['discord_nickname'];
                }
                $requested_user->save();

                return new UserResource($requested_user);
            } else {
                return response(['error' => 'Bad Request'], 400);
            }
        }

        return response(['error' => 'Forbidden'], 403);
    }

    public function deleteUser(Request $request)
    {
        if ($request->user()->tokenCan('user.admin.delete')) {
            $user = User::find($request->id);
            if (is_null($user)) {
                return response(['error' => 'Bad Request'], 400);
            }
            $user->delete();

            return response(['success' => 'OK'], 200);
        }

        return response(['error' => 'Forbidden'], 403);
    }
}
