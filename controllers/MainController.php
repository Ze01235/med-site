<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\ApiService;

class MainController extends Controller
{
    public function actionIndex()
    {
        $apiService = new ApiService();
        $searchQuery = Yii::$app->request->get('s', '');

        try {
            $sessionId = $apiService->getSession();
            $patients = $apiService->getPatients($sessionId);
            $researches = $apiService->getLabResearches($sessionId);

            if (!empty($searchQuery)) {
                $patients = array_filter($patients, function($patient) use ($searchQuery) {
                    $fullName = "{$patient['lastName']} {$patient['firstName']} {$patient['middleName']}";
                    return stripos($fullName, $searchQuery) !== false
                        || stripos($patient['oms'], $searchQuery) !== false
                        || stripos($patient['snils'], $searchQuery) !== false;
                });
            }

            return $this->render('index', [
                'patients' => $patients,
                'researches' => $researches,
                'searchQuery' => $searchQuery
            ]);

        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return $this->render('error', ['message' => 'Ошибка при загрузке данных']);
        }
    }

    public function actionResearch($guid)
    {
        $apiService = new ApiService();

        try {
            $sessionId = $apiService->getSession();
            $research = $apiService->getLabResearch($sessionId, $guid);
            $pdf = $apiService->getLabPdf($sessionId, $guid);

            return $this->render('research', [
                'research' => $research,
                'pdf' => $pdf
            ]);

        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return $this->render('error', ['message' => 'Ошибка при загрузке исследования']);
        }
    }
}