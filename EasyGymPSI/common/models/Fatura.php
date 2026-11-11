<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $fatura_id
 * @property int $inscricao_id
 * @property float $valor
 * @property string $data_emissao
 *
 * @property Inscricao $inscricao
 */
class Fatura extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inscricao_id', 'valor', 'data_emissao'], 'required'],
            [['inscricao_id'], 'integer'],
            [['valor'], 'number'],
            [['data_emissao'], 'safe'],
            [['inscricao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inscricao::class, 'targetAttribute' => ['inscricao_id' => 'inscricao_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fatura_id' => 'Fatura ID',
            'inscricao_id' => 'Inscricao ID',
            'valor' => 'Valor',
            'data_emissao' => 'Data Emissao',
        ];
    }

    /**
     * Gets query for [[Inscricao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscricao()
    {
        return $this->hasOne(Inscricao::class, ['inscricao_id' => 'inscricao_id']);
    }

}
