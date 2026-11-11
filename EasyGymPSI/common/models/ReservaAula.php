<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserva_aula".
 *
 * @property int $reserva_id
 * @property int $aula_id
 * @property int $perfil_id
 * @property string $data_reserva
 *
 * @property Aula $aula
 * @property PerfilUtilizador $perfil
 */
class ReservaAula extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva_aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aula_id', 'perfil_id'], 'required'],
            [['aula_id', 'perfil_id'], 'integer'],
            [['data_reserva'], 'safe'],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'aula_id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilUtilizador::class, 'targetAttribute' => ['perfil_id' => 'perfil_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reserva_id' => 'Reserva ID',
            'aula_id' => 'Aula ID',
            'perfil_id' => 'Perfil ID',
            'data_reserva' => 'Data Reserva',
        ];
    }

    /**
     * Gets query for [[Aula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aula::class, ['aula_id' => 'aula_id']);
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
