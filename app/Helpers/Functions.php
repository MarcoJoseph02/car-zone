<?php

declare(strict_types = 1);

use App\Modules\BaseApp\Enums\S3Enums;
use App\Modules\GarbageMedia\GarbageMedia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use App\Modules\PaymentTransactions\Enums\PaymentEnums;
use Carbon\Carbon;

if (!function_exists('appName')) {
    function appName(): string
    {
        return "";
    }
}
if (!function_exists('unauthorized')) {
    function unauthorized()
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "errors" => [
                        [
                            'status' => 403,
                            'title' => 'unauthorized_action',
                            'detail' => trans('app.Unauthorized action')
                        ]
                    ]

                ],
                403
            )
        );
    }
}
if (!function_exists('formatErrorValidation')) {
    /**
     *  JsonApi Error format Validation
     * @param array $errors
     * @param int $code
     */
    function formatErrorValidation(array $errors, int $code = 422): \Illuminate\Http\JsonResponse
    {
        $errorsArray = [];
        foreach ($errors as $error) {
            if (is_array($error)) {
                $errorsArray[] = [
                    'status' => $error['status'],
                    'title' => snake_case($error['title']),
                    'detail' => $error['detail'],
                ];
            } else {
                $errorsArray[] = [
                    'status' => $errors['status'],
                    'title' => snake_case($errors['title']),
                    'detail' => $errors['detail'],
                ];
                break;
            }
        }
        return response()->json(["errors" => $errorsArray], $code);
    }
}
if (!function_exists('getDynamicLink')) {
    function getDynamicLink($link, $params = [])
    {
        foreach ($params as $key => $value) {
            $link = str_replace('{' . $key . '}', (string)$value, $link);
        }
        return ($link);
    }
}
if (!function_exists("getActiveElementByRoute")) {
    function getActiveElementByRoute($route): string
    {
        return $route == Route::currentRouteName() ? "active" : "";
    }
}

if (!function_exists('getImageSize')) {
    function getImageSize($imagePath)
    {
        if (Storage::exists($imagePath)) {
            return Storage::size($imagePath);
        }
        return 0;
    }
}
if (!function_exists('viewImage')) {
    function viewImage($img, $type, $attributes = null)
    {
        $width = 200;
        if ($attributes) {
            $width = @$attributes['width'];
            $class = @$attributes['class'];
            $id = @$attributes['id'];
        }
        $src = image($img, $type);
        return '<img  width="' . $width . '" src="' . $src . '" class="' . @$class . '" id="' . @$id . '" >';
    }
}
if (!function_exists('viewVideo')) {
    function viewVideo($vid, $attributes = null)
    {
        $width = 200;
        if ($attributes) {
            $width = @$attributes['width'];
        }
        $src = getFileUrl(S3Enums::UPLOADS_PATH . $vid, url("/assets/img/avatar.png"));
        return '<video width="' . $width . '" height="' . $width . '" controls>
                        <source src="' . $src . '" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>';
    }
}
if (!function_exists('viewFile')) {
    function viewFile($file, $folder = 'uploads', $placeholder = null)
    {
        $path = $folder . '/' . $file;
        $path = getFileUrl($path, '');
        return '<i class="fa fa-paperclip"></i> <a href="' . $path . '" target="_blank" >' . $placeholder ?? $file . '</a>';
    }
}
if (!function_exists('image')) {
    function image($img, $type = null, $folder = S3Enums::UPLOADS_PATH)
    {
        $path = $folder;
        if (!empty($type)) {
            $path .= $type . '/';
        }
        $path .= $img;
        return getFileUrl($path, url("/assets/img/avatar.png"));
    }
}
if (!function_exists('randString')) {
    function randString($length = 5)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
}
if (!function_exists('getImageTypes')) {
    function getImageTypes()
    {
        return [
            'jpeg',
            'png',
            'jpg',
            'gif',
            'svg'
        ];
    }
}
if (!function_exists('moveGarbageMediaImage')) {
    function moveGarbageMediaSmallImage($garbageMedia, $imgName)
    {
        if (Storage::exists(S3Enums::GARBAGE_MEDIA_PATH . $garbageMedia->filename)) {
            $imageSizes = [S3Enums::SMALL => 'resize,200x200'];
            foreach ($imageSizes as $key => $value) {
                $value = explode(',', $value);
                $type = $value[0];
                $dimensions = explode('x', $value[1]);
                reSizeImage(
                    S3Enums::GARBAGE_MEDIA_PATH . $garbageMedia->filename,
                    $dimensions[0],
                    $dimensions[1],
                    $garbageMedia->extension,
                    S3Enums::SMALL_PATH . $imgName,
                    $type
                );
            }
        }
    }
}
if (!function_exists('moveGarbageMedia')) {
    function moveGarbageMedia(
        $ids,
        \Illuminate\Database\Eloquent\Relations\HasOneOrMany $relation,
        string $storagePath = null,
        array $columnNamesMap = null,
        $extraColumns = []
    )
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        if (!$columnNamesMap) {
            $columnNamesMap = [
                'source_filename' => 'source_filename',
                'filename' => 'filename',
                'extension' => 'extension',
                'mime_type' => 'mime_type'
            ];
        }
        $garbageMedias = GarbageMedia::find($ids);
        foreach ($garbageMedias as $garbageMedia) {
            if ($storagePath) {
                $fileName = $storagePath . '/' . $garbageMedia->filename;
            } else {
                $fileName = $garbageMedia->filename;
            }

            $data = [
                $columnNamesMap['filename'] => $fileName,
                $columnNamesMap['source_filename'] => $garbageMedia->source_filename,
                $columnNamesMap['extension'] => $garbageMedia->extension,
                $columnNamesMap['mime_type'] => $garbageMedia->mime_type
            ];

            if (isset($extraColumns[$garbageMedia->id])) {
                foreach ($extraColumns[$garbageMedia->id] as $key => $value) {
                    $data[$key] = $value;
                }
            }

            moveImagePath(
                S3Enums::GARBAGE_MEDIA_PATH,
                S3Enums::LARGE_PATH,
                $storagePath,
                $garbageMedia->filename
            );
            $relation->create($data);
        }
        GarbageMedia::whereIn('id', $ids)->delete();
    }
}
if (!function_exists('deleteMedia')) {
    function deleteMedia(
        $ids,
        object $model,
        string $storagePath = null
    )
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $mediaData = $model->whereIn('id', $ids)->get();

        foreach ($mediaData as $media) {
            if (in_array($media->extension, getImageTypes())) {
                if (is_null($storagePath)) {
                    deleteImagePath(S3Enums::LARGE_PATH . $media->filename);
                    deleteImagePath(S3Enums::SMALL_PATH . $media->filename);
                }
                deleteImagePath(S3Enums::LARGE_PATH . $storagePath . '/' . $media->filename);
                deleteImagePath(S3Enums::SMALL_PATH . $storagePath . '/' . $media->filename);
            } else {
                if (is_null($storagePath)) {
                    deleteImagePath(S3Enums::LARGE_PATH . $media->filename);
                }
                deleteImagePath(S3Enums::LARGE_PATH . $storagePath . '/' . $media->filename);
            }
        }
        $model->whereIn('id', $ids)->delete();
    }
}
if (!function_exists('formatFiltersForApi')) {
    function formatFiltersForApi($filters)
    {
        $result = [];
        foreach ($filters as $filter) {
            $filterResult = [];
            if (isset($filter['name'])) {
                $filterResult['name'] = $filter['name'];
            }
            if (isset($filter['type'])) {
                $filterResult['type'] = $filter['type'];
            }
            if (isset($filter['value'])) {
                $filterResult['value'] = $filter['value'];
            } else {
                $filterResult['value'] = null;
            }
            if (isset($filter['data'])) {
                $filterResult['data'] = formatFilter($filter['data']);
            }
            $result[] = $filterResult;
        }

        return $result;
    }
}
if (!function_exists('formatFilter')) {
    function formatFilter($data)
    {
        $arr = [];
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $value) {
                $obj = new \stdClass();
                $obj->key = $key;
                $obj->value = $value;
                $arr[] = $obj;
            }
        }
        return $arr;
    }
}
if (!function_exists('truncateString')) {
    function truncateString($text, $length)
    {
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return ($text);
    }
}
if (!function_exists('buildScopeRoute')) {
    /**
     * build Scope Route
     * @param $route , $param
     * @return string
     */
    function buildScopeRoute($route, array $param = [])
    {
        $params = ['language' => app()->getLocale()];
        if (count($param) > 0) {
            $params = array_merge($params, $param);
        }
        return route($route, $params);
    }
}
if (!function_exists('moveSingleGarbageMedia')) {
    function moveSingleGarbageMedia($id, string $storagePath = null)
    {
        $garbageMedia = GarbageMedia::find($id);
        $fileName = null;
        if ($garbageMedia) {
            if ($storagePath) {
                $fileName = $storagePath . '/' . $garbageMedia->filename;
            } else {
                $fileName = $garbageMedia->filename;
            }
            if (in_array($garbageMedia->extension, getImageTypes())) {
                moveGarbageMediaSmallImage($garbageMedia, $fileName);
            }
            moveImagePath(
                S3Enums::GARBAGE_MEDIA_PATH,
                S3Enums::LARGE_PATH,
                $storagePath,
                $garbageMedia->filename
            );
        }
        if ($garbageMedia) {
            $garbageMedia->delete();
        }
        return $fileName;
    }
}
if (!function_exists('checkLoginGuard')) {
    function checkLoginGuard()
    {
        if (auth('api')->check()) {
            return auth('api');
        } else {
            return auth();
        }
    }
}
if (!function_exists('urlLang')) {
    function urlLang($url, $fromlang, $toLang)
    {
        return str_replace('/' . $fromlang . '/', '/' . $toLang . '/', strtolower($url));
    }
}
if (!function_exists('lang')) {
    function lang()
    {
        return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
    }
}
if (!function_exists('get_percentage')) {
    function get_percentage($element, $total)
    {
        $percent = $element / $total;
        return $percent * 100;
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        $languages = config('laravellocalization.supportedLocales');
        $langs = [];
        foreach ($languages as $key => $value) {
            $langs[$key] = $value['name'];
        }
        return $langs;
    }
}

if (!function_exists('endOfDay')) {
    function endOfDay($day)
    {
        return Carbon::createFromFormat('Y-m-d', $day)
            ->endOfDay()
            ->toDateTimeString();
    }
}

if (!function_exists('startOfDay')) {
    function startOfDay($day)
    {
        return Carbon::createFromFormat('Y-m-d', $day)
            ->startOfDay()
            ->toDateTimeString();
    }
}

if (!function_exists('calculateProductPriceWithoutTaxes')) {
    function calculateProductPriceWithoutTaxes($priceWithTaxes): float|int
    {
        $staticTaxValue = PaymentEnums::TAX;
        /**
         * price with taxes = price without taxes + (taxes * price without taxes)
         * $priceWithTaxes = $unitPriceWithoutTax + (taxes * $unitPriceWithoutTax )
         * $priceWithTaxes = (1+taxes )* $unitPriceWithoutTax
         * $unitPriceWithoutTax = $priceWithTaxes / (1+taxes)
         * $unitPriceWithoutTax = $priceWithTaxes / (1+($staticTaxValue/100))
         **/

        return $priceWithTaxes / (1 + ($staticTaxValue / 100));
    }
}

if (!function_exists('getZIPOutput')) {
    function getZIPOutput($path)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            if (env('S3_BUCKET_PREFIX')) {
                $path = env('S3_BUCKET_PREFIX') . '/' . $path;
            }
            return 's3://' . env('AWS_BUCKET') . '/' . $path;
        } else {
            return storage_path('app/public/' . $path);
        }
    }
}

if (!function_exists('getImageToMake')) {
    function getImageToMake($path)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return getFileUrl($path);
        } else {
            return getFilePath($path);
        }
    }
}

if (!function_exists('buildTranslationKey')) {
    function buildTranslationKey(string $trans_key, array $trans_params = [])
    {
        if (count($trans_params)) {
            $translation = [
                'trans_key' => $trans_key,
                'trans_params' => $trans_params
            ];
        } else {
            $translation = $trans_key;
        }
        return ($translation);
    }
}

if (!function_exists('displayTranslation')) {
    function displayTranslation($key, $lang = null)
    {
        if (is_array($key)) {
            $translation = trans($key['trans_key'], $key['trans_params'], $lang);
        } else {
            $translation = trans($key, [], $lang);
        }
        return ($translation);
    }
}

if (!function_exists('displayTranslation')) {
    function displayTranslation($key, $lang = null)
    {
        if (is_array($key)) {
            $translation = trans($key['trans_key'], $key['trans_params'], $lang);
        } else {
            $translation = trans($key, [], $lang);
        }
        return ($translation);
    }
}
