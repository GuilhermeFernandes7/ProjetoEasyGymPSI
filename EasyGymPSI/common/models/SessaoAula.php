<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sessao_aula".
 *
 * @property int $sessao_id
 * @property int $aula_id
 * @property string $data_hora
 *
 * @property Aula $aula
 */
class SessaoAula extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessao_aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aula_id', 'data_hora'], 'required'],
            [['aula_id'], 'integer'],
            [['data_hora'], 'safe'],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'aula_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sessao_id' => 'Sessao ID',
            'aula_id' => 'Aula ID',
            'data_hora' => 'Data Hora',
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

}
