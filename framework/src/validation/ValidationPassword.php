<?php

namespace Framework\Src\Validation;

class ValidationPassword
{
    public static function validatePassword($data): bool
    {
        $currentPassword = $data['password'];

        if (!preg_match_all("\^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,100}$", $currentPassword)) {
            $alert = 'Пароль должен состоять из минимум из 6 символов: только латинские буквы и цифры';
            require_once 'resources/views/alert.php';
        }

        return true;

    }
}