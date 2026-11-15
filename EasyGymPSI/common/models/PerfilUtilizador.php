<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil_utilizador".
 *
 * @property int $perfil_id
 * @property int $user_id
 * @property string|null $nome
 * @property string|null $nif
 * @property string|null $telefone
 * @property string|null $morada
 * @property string|null $data_nascimento
 *
 * @property Inscricao[] $inscricaos
 * @property MarcacaoAvaliacao[] $marcacaoAvaliacaos
 * @property MarcacaoAvaliacao[] $marcacaoAvaliacaos0
 * @property Notificacao[] $notificacaos
 * @property PlanoTreino[] $planoTreinos
 * @property PlanoTreino[] $planoTreinos0
 * @property ReservaAula[] $reservaAulas
 * @property User $user
 */
class PerfilUtilizador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil_utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'telefone', 'morada', 'data_nascimento'], 'default', 'value' => null],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['data_nascimento'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['nif'], 'string', 'max' => 9],
            [['telefone'], 'string', 'max' => 20],
            [['morada'], 'string', 'max' => 200],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'perfil_id' => 'Perfil ID',
            'user_id' => 'User ID',
            'nome' => 'Nome',
            'nif' => 'Nif',
            'telefone' => 'Telefone',
            'morada' => 'Morada',
            'data_nascimento' => 'Data Nascimento',
        ];
    }

    /**
     * Gets query for [[Inscricaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::class, ['perfil_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[MarcacaoAvaliacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoAvaliacaos()
    {
        return $this->hasMany(MarcacaoAvaliacao::class, ['cliente_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[MarcacaoAvaliacaos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoAvaliacaos0()
    {
        return $this->hasMany(MarcacaoAvaliacao::class, ['pt_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[Notificacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::class, ['perfil_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[PlanoTreinos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoTreinos()
    {
        return $this->hasMany(PlanoTreino::class, ['cliente_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[PlanoTreinos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoTreinos0()
    {
        return $this->hasMany(PlanoTreino::class, ['pt_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[ReservaAulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservaAulas()
    {
        return $this->hasMany(ReservaAula::class, ['perfil_id' => 'perfil_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
