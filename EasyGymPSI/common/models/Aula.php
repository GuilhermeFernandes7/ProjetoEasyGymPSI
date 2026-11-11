<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property int $aula_id
 * @property string $modalidade
 * @property int $capacidade
 *
 * @property ReservaAula[] $reservaAulas
 * @property SessaoAula[] $sessaoAulas
 */
class Aula extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modalidade', 'capacidade'], 'required'],
            [['capacidade'], 'integer'],
            [['modalidade'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aula_id' => 'Aula ID',
            'modalidade' => 'Modalidade',
            'capacidade' => 'Capacidade',
        ];
    }

    /**
     * Gets query for [[ReservaAulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservaAulas()
    {
        return $this->hasMany(ReservaAula::class, ['aula_id' => 'aula_id']);
    }

    /**
     * Gets query for [[SessaoAulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessaoAulas()
    {
        return $this->hasMany(SessaoAula::class, ['aula_id' => 'aula_id']);
    }

}
