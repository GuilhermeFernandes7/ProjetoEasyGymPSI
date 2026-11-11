<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plano_treino".
 *
 * @property int $plano_id
 * @property int $cliente_id
 * @property int $pt_id
 * @property string $exercicios
 * @property string $data_criacao
 *
 * @property PerfilUtilizador $cliente
 * @property PerfilUtilizador $pt
 */
class PlanoTreino extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plano_treino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'pt_id', 'exercicios', 'data_criacao'], 'required'],
            [['cliente_id', 'pt_id'], 'integer'],
            [['exercicios'], 'string'],
            [['data_criacao'], 'safe'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilUtilizador::class, 'targetAttribute' => ['cliente_id' => 'perfil_id']],
            [['pt_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilUtilizador::class, 'targetAttribute' => ['pt_id' => 'perfil_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plano_id' => 'Plano ID',
            'cliente_id' => 'Cliente ID',
            'pt_id' => 'Pt ID',
            'exercicios' => 'Exercicios',
            'data_criacao' => 'Data Criacao',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(PerfilUtilizador::class, ['perfil_id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Pt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPt()
    {
        return $this->hasOne(PerfilUtilizador::class, ['perfil_id' => 'pt_id']);
    }

}
