<?php

namespace App\Helpers;

use App\Models\JobPosition;
use Illuminate\Support\Facades\File;

class Utils
{
    public static function convertToBase64($file)
    {
        $image = "data:" . $file->getMimeType() . ";base64," . base64_encode(file_get_contents($file->path()));

        return $image;
    }

    public static function convertToBase64FromFolder($filePath)
    {
        $image = \file_get_contents($filePath);
        return "data:" . Utils::getMimeType($image) . ";base64" . \base64_encode($image);
    }

    public static function singelUpload($destination, $file)
    {
        $fileName = \rand(10, 100) . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/' . $destination, $fileName);

        return 'uploads/' . $destination . '/' . $fileName;
    }

    public static function multiplelUpload($destination, $files)
    {
        $data = [];
        foreach ($files as $file) {
            $fileName = \rand(10, 100) . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/' . $destination, $fileName);
            \array_push($data, 'uploads/' . $destination . '/' . $fileName);
        }

        return $data;
    }

    public static function getMimeType($content)
    {
        $fh = fopen('php://memory', 'w+b');
        fwrite($fh, $content);
        $mimeType = \mime_content_type($fh);
        fclose($fh);

        return $mimeType;
    }

    public static function removeFile($path)
    {
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public static function jobPositions()
    {
        $query = JobPosition::query();

        if (auth()->user()->jobPosition->name == "Direktur") {
            // $query->where("name", "!=", auth()->user()->jobPosition->name);
            $query->where("parent_id", auth()->user()->job_position_id)->where('name', 'like', '%wakil%');
        }

        if (auth()->user()->jobPosition->name != "Direktur") {
            $query->where("parent_id", auth()->user()->job_position_id);
        }

        return $query->get();
    }

    public static function joinReceived($old, $new)
    {
        return $old == null ? $new : $old . ", " . $new;
    }
}
