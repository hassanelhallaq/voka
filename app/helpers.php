<?php



function openJSONFileCustom($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

function saveJSONFileCustom($code, $data)
{
    $filePath = base_path('resources/lang/' . $code . '.json');
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonString);
}
function datatable_paginate($builder)
{
    $draw = request()->get('draw');
    $start = request()->get("start", 0);
    $length = request()->get("length", 10); // Rows display per page

    $page = ($start / $length) + 1;

    $columns = request()->get('columns');
    $sortDir = request()->input('order.0.dir');
    $sortColumnIndex = request()->input('order.0.column');

    $sortColumnName = request()->input("columns.{$sortColumnIndex}.data");
    if (!empty($sortColumnName)) {
        $builder = $builder->OrderBy($sortColumnName, $sortDir);
    } else {
        $builder = $builder->latest();
    }
    $data = $builder->paginate($length, ['*'], 'page', $page);

    return array(
        "draw" => intval($draw),
        "recordsTotal" => $data->total(),
        "recordsFiltered" => $data->total(),
        "aaData" => $data->items()
    );
}






if (!function_exists('preloadCss')) {
    /**
     * Preload CSS file
     *
     * @return bool
     */
    function preloadCss($url)
    {
        return '<link rel="preload" href="' . $url . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" type="text/css"><noscript><link rel="stylesheet" href="' . $url . '"></noscript>';
    }
}
