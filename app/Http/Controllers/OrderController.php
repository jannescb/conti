<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController
{
    public function __invoke(Request $request)
    {
        $classes = collect($request->all())
            ->groupBy('class');

        foreach ($classes  as $className => $orderables) {
            $i = 1;
            foreach ($orderables as $orderable) {
                $model = new $className;
                $model = $model->find($orderable['id']);
                if (is_null($model)) {
                    $model = new $className;
                    $model->type = $orderable['type'];
                    $model->parent_id = $orderable['parent_id'];
                    $model->parent_type = $orderable['parent_type'];
                }
                $model->order_column = $i;
                $model->save();

                foreach ($orderable['attributes'] as $attribute) {
                    $model->attributes()->updateOrCreate([
                        'key'  => $attribute['key'],
                        'type' => $attribute['type'],
                    ], [
                        'value' => $attribute['value'],
                    ]);
                }

                $i++;
            }
        }
    }
}
