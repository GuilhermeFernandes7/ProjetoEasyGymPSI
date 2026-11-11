<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property int $notificacao_id
 * @property int $perfil_id
 * @property string $mensagem
 * @property string $data_envio
 *
 * @property PerfilUtilizador $perfil
 */
class Notificacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id', 'mensagem'], 'required'],
            [['perfil_id'], 'integer'],
            [['data_envio'], 'safe'],
            [['mensagem'], 'string', 'max' => 255],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilUtilizador::class, 'targetAttribute' => ['perfil_id' => 'perfil_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notificacao_id' => 'Notificacao ID',
            'perfil_id' => 'Perfil ID',
            'mensagem' => 'Mensagem',
            'data_envio' => 'Data Envio',
        ];
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
