<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marcacao_avaliacao".
 *
 * @property int $marcacao_id
 * @property int $cliente_id
 * @property int $pt_id
 * @property string $data_hora
 * @property string $estado
 *
 * @property PerfilUtilizador $cliente
 * @property PerfilUtilizador $pt
 */
class MarcacaoAvaliacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao_avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'pt_id', 'data_hora', 'estado'], 'required'],
            [['cliente_id', 'pt_id'], 'integer'],
            [['data_hora'], 'safe'],
            [['estado'], 'string', 'max' => 30],
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
            'marcacao_id' => 'Marcacao ID',
            'cliente_id' => 'Cliente ID',
            'pt_id' => 'Pt ID',
            'data_hora' => 'Data Hora',
            'estado' => 'Estado',
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
