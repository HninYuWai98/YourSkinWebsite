<?php

namespace App\Services;

use Illuminate\Http\Request;

class CommonService
{
    protected int $offset = 0;

    protected int $limit = 50;

    //    public function input(Request $request, array $fillable): array
    //    {
    //        return array_filter($request->only($fillable), fn($value) => $value != null);
    //    }


    public function params(Request $request, array $only = [], array $options = []): array
    {
        $requestParams = $request->all();

        $search = $request->get('search');
        $params = array_merge($requestParams, [
            'search' => $search ?? null,
            'limit'  => !empty($request->get('limit')) ? (int) $request->get('limit') : $this->limit,
            'offset' => !empty($request->get('offset')) ? (int) $request->get('offset') : $this->offset,
        ]);

        if ($request->limit) {
            $params = array_merge($params, ['limit' => $request->limit ?? $this->limit]);
        }

        if ($request->offset) {
            $params = array_merge($params, ['offset' => $request->offset ?? $this->offset]);
        }

        if (!empty($only)) {
            $params = collect($params)->only($only)->toArray();
        }

        if (!empty($options)) {
            $params = array_merge($params, $options);
        }

        return $params;
    }

    public function idsConcat(string $ids)
    {
        $idsArray = explode(",", $ids);
        if (count($idsArray) > 0) {
            $extractIds = [];
            foreach ($idsArray as $item) {
                if (str_contains($item, '...')) {
                    $arrays = explode("...", $item);
                    if (strlen($arrays[0]) == strlen($arrays[1])) {
                        $startPrefix = substr($arrays[0], 0, -6);
                        $startNumber = (int)substr($arrays[0], -6);
                        $endNumber = (int)substr($arrays[1], -6);
                        preg_match('/^0+/', substr($arrays[0], -6), $matches);
                        $startZeros = isset($matches[0]) ? $matches[0] : '';
                        $range = abs($startNumber - $endNumber);
                        $equalTypeIds = [];
                        for ($i = 0; $i < $range + 1; $i++) {
                            $sumNumber = $startNumber + $i;
                            $formattedNumber = ($startZeros != '') ? str_pad($sumNumber, 6, '0', STR_PAD_LEFT) : $sumNumber;
                            array_push($equalTypeIds, $startPrefix . $formattedNumber);
                        }
                        $extractIds = array_merge($extractIds, $equalTypeIds);
                    } else {
                        $range = abs($arrays[0] - $arrays[1]);
                        $equalTypeIds = [];
                        for ($i = 0; $i < $range + 1; $i++) {
                            $sumNumber = $arrays[0] + $i;
                            array_push($equalTypeIds, $sumNumber);
                        }
                        $extractIds = array_merge($extractIds, $equalTypeIds);
                    }
                } elseif (is_numeric($item)) {
                    $extractIds[] = (int)$item;
                } else {
                    $extractIds[] = $item;
                }
            }
        }
        return array_unique($extractIds);
    }

    function prependKey(string $keyword,$OriginArray): array
    {

        $modifiedArray = [];

            // Loop through each key-value pair in the item
            foreach ($OriginArray as $key => $value) {
                // Prepend the keyword to the key
                $modifiedArray[$keyword . $key] = $value;
            }

        return $modifiedArray;
    }
}
