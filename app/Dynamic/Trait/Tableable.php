<?php

namespace App\Dynamic\Trait;

use App\Dynamic\Resource\Table;

trait Tableable
{
    use Resourceable;
    public static function tableable()
    {
        self::defining();
        return new Table(
            model: self::modelable(),
            route_store: self::$route_store,
            route_create: self::$route_create,
            route_edit: self::$route_edit,
            route_update: self::$route_update,
            route_view: self::$route_view,
            route_view_any: self::$route_view_any,
            route_delete: self::$route_delete,
            route_delete_any: self::$route_delete_any,
            route_relation: self::$route_relation,

            web_view: self::$web_view,
            web_view_any: self::$web_view_any,
            web_create: self::$web_create,
            web_update: self::$web_update,
            api_create: self::$api_create,
            api_update: self::$api_update,
            api_delete: self::$api_delete,
            api_delete_any: self::$api_delete_any,
        );
    }
}
