<?php

namespace app\controllers;

use app\models\Team;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TeamController extends Controller
{
    public function actionView($id)
    {
        $team = Team::find()->with('participants')->where(['id' => $id])->one();

        if ($team === null) {
            throw new NotFoundHttpException('Команда не найдена.');
        }

        return $this->render('view', ['team' => $team]);
    }
}
