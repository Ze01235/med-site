<?php
namespace app\services;

use Yii;
use yii\httpclient\Client;
use yii\web\Cookie;

class ApiService
{
    private $baseUrl = 'http://87.228.37.14:61510';
    private $authToken = '3c4d5e6f-7g8h-9i0j-1k2l-3m4n5o6p7q8r';

    /**
     * Получаем sessionId
     */
    public function getSession()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->baseUrl . '/auth')
            ->setHeaders(['Authorization' => 'Bearer ' . $this->authToken])
            ->send();

        if ($response->isOk && $response->data['errorCode'] === 0) {
            return $response->data['sessionId'];
        }

        throw new \Exception('Failed to get session: ' . ($response->data['error'] ?? 'Unknown error'));
    }

    /**
     * Получаем список пациентов
     */
    public function getPatients($sessionId)
    {
        return $this->makeRequest('/patient', $sessionId);
    }

    /**
     * Получаем список исследований
     */
    public function getLabResearches($sessionId)
    {
        return $this->makeRequest('/labReserchInfo', $sessionId);
    }

    /**
     * Получаем конкретное исследование
     */
    public function getLabResearch($sessionId, $labDirectionGuid)
    {
        return $this->makeRequest("/labReserchInfo/{$labDirectionGuid}", $sessionId);
    }

    /**
     * Получаем PDF документа
     */
    public function getLabPdf($sessionId, $labDirectionGuid)
    {
        return $this->makeRequest("/labReserchPdf/{$labDirectionGuid}", $sessionId);
    }

    /**
     * Общий метод для запросов
     */
    private function makeRequest($endpoint, $sessionId)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->baseUrl . $endpoint)
            ->addHeaders(['Cookie' => "sessionId={$sessionId}"])
            ->send();

        if ($response->isOk) {
            return $response->data;
        }

        throw new \Exception('API request failed: ' . ($response->data['error'] ?? 'Unknown error'));
    }
}