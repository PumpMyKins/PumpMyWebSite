<?php

namespace App;

use ReflectionClass;
use ReflectionMethod;

class PMK_Permissions
{
    public static function can($role, $ability)
    {
        return in_array($ability, self::apiPermissions($role));
    }

    public static function apiPermissions($role = 'Joueur')
    {
        $permissions = [];

        $reflection = new ReflectionClass('App\PMK_Permissions');
        foreach ($reflection->getMethods(ReflectionMethod::IS_STATIC) as $method) {
            $method = $method->name;
            if (preg_match('/.*ApiPermission/', $method)) {
                $permissions = array_merge($permissions, self::$method($role));
            }
        }

        ksort($permissions);

        return $permissions;
    }

    public static function apiPermissionByGroups($role = 'Joueur')
    {
        $permissions = [];

        $reflection = new ReflectionClass('App\PMK_Permissions');
        foreach ($reflection->getMethods(ReflectionMethod::IS_STATIC) as $method) {
            $method = $method->name;
            if (preg_match('/.*ApiPermission/', $method)) {
                $groupName = substr($method, 0, -14);
                $permissions[$groupName] = self::$method($role);
            }
        }

        return $permissions;
    }

    public static function userApiPermissions($role = 'Joueur')
    {
        switch ($role) {
            case 'Administration':
                return [
                    'user.get',
                    'user.get.discord',
                    'user.admin.get',
                    'user.admin.get.discord',
                    'user.admin.create',
                    'user.admin.update',
                    'user.admin.delete',
                ];
            case 'Moderation':
            case 'Joueur':
            default:
                return [
                    'user.get',
                    'user.get.discord',
                ];
        }
    }

    public static function newsApiPermissions($role = 'Joueur')
    {
        switch ($role) {
            case 'Administration':
                return [
                    'news.get',
                    'news.create',
                    'news.update',
                    'news.delete',
                    'news.admin.get',
                    'news.admin.update',
                    'news.admin.delete',
                ];
            case 'Moderation':
            case 'Joueur':
            default:
                return [
                    'news.get',
                    'news.create',
                    'news.update',
                    'news.delete',
                ];
        }
    }
}
