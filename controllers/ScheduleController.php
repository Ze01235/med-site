<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\ApiService;

class ScheduleController extends Controller
{
    public function actionIndex()
    {
        $apiService = new ApiService();

        try {
            $sessionId = $apiService->getSession();
            $researches = $apiService->getLabResearches($sessionId);

            // Логируем полученные данные для отладки
            Yii::debug('Received researches data: ' . print_r($researches, true));

            $schedule = $this->processResearches($researches);

            return $this->render('index', [
                'schedule' => $schedule,
                'currentDate' => date('Y-m-d')
            ]);

        } catch (\Exception $e) {
            Yii::error('Schedule loading error: ' . $e->getMessage());
            throw new \yii\web\HttpException(500, 'Ошибка при загрузке расписания: ' . $e->getMessage());
        }
    }

    private function processResearches(array $researches): array
    {
        $schedule = [];

        foreach ($researches as $research) {
            try {
                $item = $this->createScheduleItem($research);
                $date = $item['date'];

                if (!isset($schedule[$date])) {
                    $schedule[$date] = [];
                }

                $schedule[$date][] = $item;
            } catch (\Exception $e) {
                Yii::error('Error processing research item: ' . $e->getMessage());
                continue;
            }
        }

        // Сортировка по времени
        foreach ($schedule as &$dayEvents) {
            usort($dayEvents, function($a, $b) {
                return strcmp($a['time'], $b['time']);
            });
        }

        return $schedule;
    }

    private function createScheduleItem(array $research): array
    {
        // Проверка обязательных полей
        if (!isset($research['directionDate'])) {
            throw new \InvalidArgumentException('Missing directionDate in research');
        }

        // Безопасное преобразование данных
        return [
            'date' => date('Y-m-d', strtotime($research['directionDate'])),
            'time' => date('H:i', strtotime($research['directionDate'])),
            'title' => $this->getResearchTitle($research),
            'description' => $this->getResearchDescription($research),
            'priority' => $research['isPriority'] ?? false,
            'guid' => $research['labDirectionGuid'] ?? null,
            'raw_data' => $research // Сохраняем оригинальные данные
        ];
    }

    private function getResearchTitle(array $research): string
    {
        $labName = is_array($research['laboratory'] ?? null)
            ? ($research['laboratory']['name'] ?? 'Неизвестная лаборатория')
            : 'Неизвестная лаборатория';

        return 'Исследование: ' . $labName;
    }

    private function getResearchDescription(array $research): string
    {
        $patientId = $research['patientLocalId'] ?? 'не указан';
        $number = $research['number'] ?? 'N/A';

        return "Пациент ID: $patientId, Номер: $number";
    }
}