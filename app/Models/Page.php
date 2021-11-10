<?php

namespace App\Models;

use Astrotomic\Fileable\Concerns\HasFiles;
use Astrotomic\Fileable\Contracts\Fileable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Fileable
{
    use HasFactory, HasFiles;

    protected $fillable = [
        'name',
        'content',
        'slug',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    public function getContent()
    {
        $content = $this->content;
        // dd($content);

        foreach ($content as $key => $item) {
            $content[$key] = $this->getNestedRelations($item);
        }

        return $content;
    }

    public function getNestedRelations($item)
    {
        if (! is_array($item)) {
            return $item;
        }
        $content = $item;
        foreach ($content as $key => $item) {
            if (is_array($item) && array_key_exists('relation', $item)) {
                $relation = new $item['relation'];
                $resource = $item['resource'];
                // load model or collection
                if (is_array($item['value'])) {
                    $collection = $relation->whereIn('id', $item['value'])->get();
                    if ($resource) {
                        $content[$key]['value'] = ($resource::collection($collection))->toArray(request());
                    } else {
                        $content[$key]['value'] = $collection;
                    }
                } else {
                    $model = $relation->find($item['value']);
                    if ($resource && $model) {
                        $content[$key]['value'] = (new $resource($model))->toArray(request());
                    } else {
                        $content[$key]['value'] = $model;
                    }
                }

                unset($content[$key]['relation']);
                unset($content[$key]['resource']);

                continue;
            }
            $content[$key] = $this->getNestedRelations($item);
        }

        return $content;
    }
}
