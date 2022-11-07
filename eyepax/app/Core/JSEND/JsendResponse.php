<?php

namespace App\Core\JSEND;

class JsendResponse
{
    public const SUCCESS = "success";
    public const FAIL = "fail";
    public const ERROR = "error";
    public const DATA = "data";
    public const STATUS = "status";
    public const STANDARD_MESSAGE = "Something went wrong.";

    public static function success(array $data): array
    {
        return [
            self::STATUS => self::SUCCESS,
            self::DATA => $data
        ];
    }

    public static function fail(array $data): array
    {
        return [
            self::STATUS => self::FAIL,
            self::DATA => $data
        ];
    }

    public static function error(string $message = self::STANDARD_MESSAGE, array $data = []): array
    {
        return [
            self::STATUS => self::ERROR,
            'message' => $message,
            self::DATA => $data
        ];
    }

}
