<?php

namespace App\Helpers;

use App\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{
    const LANGUAGE = [
        'vi' => 'Việt Nam',
        'en' => 'English'
    ];

    public static function getConfigValueFromSettingTable($configKey)
    {
        $setting = Setting::where('config_key', $configKey)->first();
        if (!empty($setting)) {
            return $setting->config_value;
        }
        return null;
    }

    public static function storeHelperUpload($request, $fieldName, $folderName)
    {
        // kiểm tra xem có file upload không
        if ($request->hasFile($fieldName)) {
            // dữ liệu tên cột gửi lên
            $file = $request->$fieldName;

            // lấy tên gốc của ảnh để sau tiện tìm ảnh
            $fileNameOrigin = $file->getClientOriginalName();

            // lấy tên upload lên db
            $fileNameDB = Str::random(20) . '.' . $file->getClientOriginalExtension();;

            // lưu file vào thư mục: thêm public ở đầu để lấy được từ public ra
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameDB);

            // dữ liệu được lấy
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }

        // nếu k upload file lên dữ liệu là null
        return null;
    }

    // truyền file: do đọc qua từng foreach dữ liệu them vào, nên đã biết fields nào
    public static function storeHelperUploadMultiple($file, $folderName)
    {
        // lấy tên gốc của ảnh để sau tiện tìm ảnh
        $fileNameOrigin = $file->getClientOriginalName();

        // lấy tên upload lên db
        $fileNameDB = Str::random(20) . '.' . $file->getClientOriginalExtension();;

        // lưu file vào thư mục
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameDB);

        // dữ liệu được lấy
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;
    }
}
