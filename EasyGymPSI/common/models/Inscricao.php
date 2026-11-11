<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inscricao".
 *
 * @property int $inscricao_id
 * @property int $perfil_id
 * @property string $estado
 * @property string|null $data_fim
 *
 * @property Fatura[] $faturas
 * @property PerfilUtilizador $perfil
 */
class Inscricao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inscricao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_fim'], 'default', 'value' => null],
            [['perfil_id', 'estado'], 'required'],
            [['perfil_id'], 'integer'],
            [['data_fim'], 'safe'],
            [['estado'], 'string', 'max' => 30],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilUtilizador::class, 'targetAttribute' => ['perfil_id' => 'perfil_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inscricao_id' => 'Inscricao ID',
            'perfil_id' => 'Perfil ID',
            'estado' => 'Estado',
            'data_fim' => 'Data Fim',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['inscricao_id' => 'inscricao_id']);
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(PerfilUtilizador::class, ['perfil_id' => 'perfil_id']);
    }

}
