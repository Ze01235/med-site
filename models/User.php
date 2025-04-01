<?php
namespace app\models;

use yii\web\IdentityInterface;
use app\services\ApiService;

class User implements IdentityInterface
{
    private static $users = [];
    public $id;
    public $username;
    public $authKey;
    public $accessToken;
    private $_sessionId;

    public static function findIdentity($id) { /* ... */ }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $apiService = new ApiService();
        try {
            $sessionId = $apiService->getSession($token);
            $user = new static();
            $user->id = 1; // или другой идентификатор
            $user->_sessionId = $sessionId;
            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getId() { return $this->id; }
    public function getAuthKey() { return $this->authKey; }
    public function validateAuthKey($authKey) { return $this->authKey === $authKey; }

    public function getSessionId()
    {
        return $this->_sessionId;
    }

    public static function findByUsername($username)
    {
        // Здесь можно добавить проверку пользователей в БД
        return isset(self::$users[$username]) ? new static(self::$users[$username]) : null;
    }

    public function validatePassword($password)
    {
        // Здесь должна быть проверка пароля
        return true; // Временно, пока нет БД пользователей
    }
}