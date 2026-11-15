<?php

declare(strict_types=1);

namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;

/**
 * Pesquisa e filtros da lista "Users and access" (nome/email, role, estado).
 */
class UserSearch extends Model
{
    public $q;
    public $role;
    public $status;

    public function rules(): array
    {
        return [
            [['q', 'role', 'status'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        // Os utilizadores com soft delete (status 0) nunca aparecem na lista.
        $query = User::find()
            ->alias('u')
            ->joinWith('perfil p')
            ->where(['<>', 'u.status', User::STATUS_DELETED]);

        $this->load($params);

        if ($this->q !== null && $this->q !== '') {
            $query->andWhere([
                'or',
                ['like', 'p.nome', $this->q],
                ['like', 'u.email', $this->q],
                ['like', 'u.username', $this->q],
            ]);
        }

        if ($this->status !== null && $this->status !== '') {
            $query->andWhere(['u.status' => (int) $this->status]);
        }

        if ($this->role !== null && $this->role !== '') {
            $query->andWhere([
                'in',
                'u.id',
                (new Query())
                    ->select(new Expression('CAST(user_id AS UNSIGNED)'))
                    ->from('auth_assignment')
                    ->where(['item_name' => $this->role]),
            ]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 8],
            'sort' => [
                'defaultOrder' => ['nome' => SORT_ASC],
                'attributes' => [
                    'nome' => ['asc' => ['p.nome' => SORT_ASC], 'desc' => ['p.nome' => SORT_DESC]],
                    'email' => ['asc' => ['u.email' => SORT_ASC], 'desc' => ['u.email' => SORT_DESC]],
                    'status' => ['asc' => ['u.status' => SORT_ASC], 'desc' => ['u.status' => SORT_DESC]],
                ],
            ],
        ]);
    }
}