<?php

declare(strict_types=1);

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ClientController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['verAreaCliente']],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index', ['user' => Yii::$app->user->identity]);
    }

    public function actionMembership(): string
    {
        return $this->renderPlaceholder('Membership', [
            'Current membership',
            'Available plans',
            'Membership history',
        ]);
    }

    public function actionBilling(): string
    {
        return $this->renderPlaceholder('Billing', [
            'Current balance and next billing date',
            'Payment method',
            'Billing history',
        ]);
    }

    public function actionInvoices(): string
    {
        return $this->renderPlaceholder('Invoices', [
            'Filter by period and type',
            'Invoices and receipts',
            'Download ZIP',
        ]);
    }

    public function actionFreeze(): string
    {
        return $this->renderPlaceholder('Freeze enrollment', [
            'Current freeze status',
            'Request a freeze',
            'Freeze history',
        ]);
    }

    private function renderPlaceholder(string $title, array $sections): string
    {
        return $this->render('placeholder', ['title' => $title, 'sections' => $sections]);
    }
}