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
                return response('error', 400);
        }
    }

    public function getUser(Request $request)
    {
        if ($request->user()->tokenCan('user.getany') and isset($request->id)) {
            $user = User::find($request->id);
            if (is_null($user)) {
                return json_encode('404 Not Found');
            } else {
                return new UserResource($user);
            }
        } elseif (($request->user()->tokenCan('user.get') or $request->user()->tokenCan('user.getany')) and ! isset($request->id)) {
            return new UserResource($request->user());
        }

        return json_encode('403 Forbidden');
    }

    public function getDiscord(Request $request)
    {
        if (! isset($request->id)) {
            return json_encode('400 Bad Request');
        }
        if ($request->user()->tokenCan('user.discord')) {
            if ($request->user()->id != $request->id and ! $request->user()->tokenCan('user.getany')) {
                return json_encode('403 Forbidden');
            }
            $user = User::find($request->id);
            if (is_null($user)) {
                return json_encode('404 Not Found');
            } else {
                return new UserDiscordResource($user);
            }
        }

        return json_encode('403 Forbidden');
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

        return json_encode('403 Forbidden');
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
                return $validator->errors();
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

        return json_encode('403 Forbidden');
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
                return json_encode('400 Bad Request');
            }
        }

        return json_encode('403 Forbidden');
    }

    public function deleteUser(Request $request)
    {
        if ($request->user()->tokenCan('users.delete')) {
            $user = User::find($request->id);
            if (is_null($user)) {
                return json_encode('400 Bad Request');
            }
            $user->delete();

            return json_encode('200 OK');
        }

        return json_encode('403 Forbidden');
    }
}
