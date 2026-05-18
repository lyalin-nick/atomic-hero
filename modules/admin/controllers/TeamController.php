<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Team;
use app\models\Participant;
use app\models\ResultForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TeamController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $teams = Team::find()->with('participants')->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index', ['teams' => $teams]);
    }

    public function actionCreate()
    {
        $team = new Team();

        if ($team->load(Yii::$app->request->post())) {
            if ($team->save()) {
                $this->saveParticipants($team);
                Yii::$app->session->setFlash('success', 'Команда создана.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', [
            'team' => $team,
            'participants' => [new Participant()],
        ]);
    }

    public function actionUpdate($id)
    {
        $team = $this->findTeam($id);

        if ($team->load(Yii::$app->request->post())) {
            if ($team->save()) {
                Participant::deleteAll(['team_id' => $team->id]);
                $this->saveParticipants($team);
                Yii::$app->session->setFlash('success', 'Команда обновлена.');
                return $this->redirect(['index']);
            }
        }

        $participants = $team->participants;
        if (empty($participants)) {
            $participants = [new Participant()];
        }

        return $this->render('form', [
            'team' => $team,
            'participants' => $participants,
        ]);
    }

    public function actionDelete($id)
    {
        $team = $this->findTeam($id);
        Participant::deleteAll(['team_id' => $team->id]);
        $team->delete();

        Team::recalculatePlaces();

        Yii::$app->session->setFlash('success', 'Команда удалена.');
        return $this->redirect(['index']);
    }

    public function actionResult($id)
    {
        $team = $this->findTeam($id);
        $model = new ResultForm();

        if ($team->start_time) {
            $model->start_time = $team->start_time;
            $model->finish_time = $team->finish_time;
            $model->downtime_minutes = intdiv((int)$team->downtime_seconds, 60);
            $model->downtime_seconds = (int)$team->downtime_seconds % 60;
            $model->penalty_minutes = intdiv((int)$team->penalty_seconds, 60);
            $model->penalty_seconds = (int)$team->penalty_seconds % 60;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $team->start_time = $model->start_time;
            $team->finish_time = $model->finish_time;
            $team->downtime_seconds = $model->getDowntimeTotalSeconds();
            $team->penalty_seconds = $model->getPenaltyTotalSeconds();
            $team->calculateResult();

            if ($team->save()) {
                Team::recalculatePlaces();
                Yii::$app->session->setFlash('success', 'Результат сохранён.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('result', [
            'team' => $team,
            'model' => $model,
        ]);
    }

    private function findTeam($id)
    {
        $team = Team::findOne($id);
        if ($team === null) {
            throw new NotFoundHttpException('Команда не найдена.');
        }
        return $team;
    }

    private function saveParticipants(Team $team)
    {
        $post = Yii::$app->request->post('Participant', []);
        foreach ($post as $data) {
            if (empty($data['full_name'])) {
                continue;
            }
            $p = new Participant();
            $p->team_id = $team->id;
            $p->full_name = $data['full_name'];
            $p->save();
        }
    }
}
