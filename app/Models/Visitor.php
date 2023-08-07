<?php

namespace App\Models;

// use App\Dynamic\Trait\Formable;
// use App\Dynamic\Trait\Statable;
// use App\Dynamic\Trait\Tableable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasUuids;
    // use Tableable, Formable, Statable;
    // public static function modelable(): Model
    // {
    //     return new self();
    // }
    // public static function defining()
    // {
    //     self::$caption = "visitor";
    //     self::$definitions = [];
    //     self::$fetcher_relation = function ($definition) {
    //         return match ($definition->name) {
    //             default => throw new \Error("unknown name of $definition->name")
    //         };
    //     };
    // }
    public static function visit(string|null $id = null, string $tag = "main")
    {
        $data = null;
        if ($id) {
            $data = self::where('id', $id)->where("tag", $tag)->first();
        } else {
            $data = self::where("tag", $tag)->first();
        }
        if ($data) {
            $data->score += 1;
            $data->save();
        } else {
            $data = self::create([
                'score' => 1,
                'tag' => $tag,
                'device' => "",
                'ip' => "",
            ]);
        }
        return $data;
    }

    protected $fillable = [
        'score',
        'tag',
        'device',
        'ip',
    ];
}
