<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anuncio".
 *
 * @property int $id
 * @property int|null $id_proprietario
 * @property int|null $id_casa
 * @property string $titulo
 * @property int $preco
 * @property string $data_criacao
 * @property string $data_disponibilidade
 * @property int $despesas_inc
 * @property string $descricao
 *
 * @property Perfil $proprietario
 * @property Casa $casa
 * @property Reserva[] $reservas
 * @property Visita[] $visitas
 */
class Anuncio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anuncio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proprietario', 'id_casa', 'preco', 'despesas_inc'], 'integer'],
            [['titulo', 'preco', 'data_criacao', 'data_disponibilidade', 'despesas_inc', 'descricao'], 'required'],
            [['data_criacao', 'data_disponibilidade'], 'safe'],
            [['descricao'], 'string'],
            [['titulo'], 'string', 'max' => 45],
            [['id_proprietario'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_proprietario' => 'id_user']],
            [['id_casa'], 'exist', 'skipOnError' => true, 'targetClass' => Casa::className(), 'targetAttribute' => ['id_casa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proprietario' => 'Id Proprietario',
            'id_casa' => 'Id Casa',
            'titulo' => 'Titulo',
            'preco' => 'Preco',
            'data_criacao' => 'Data Criacao',
            'data_disponibilidade' => 'Data Disponibilidade',
            'despesas_inc' => 'Despesas Inc',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[Proprietario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProprietario()
    {
        return $this->hasOne(Perfil::className(), ['id_user' => 'id_proprietario']);
    }

    /**
     * Gets query for [[Casa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCasa()
    {
        return $this->hasOne(Casa::className(), ['id' => 'id_casa']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_anuncio' => 'id']);
    }

    /**
     * Gets query for [[Visitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitas()
    {
        return $this->hasMany(Visita::className(), ['id_anuncio' => 'id']);
    }

    public function FazPublish($canal, $msg)
    {
        try {
            $server = "127.0.0.1";
            $port = 1883;
            $username = ""; // set your username
            $password = ""; // set your password
            $client_id = "phpMQTT-publisher"; // unique!
            $mqtt = new \backend\mosquitto\phpMQTT($server, $port, $client_id);
            if ($mqtt->connect(true, NULL, $username, $password)) {
                $mqtt->publish($canal, $msg, 0);
                $mqtt->close();
            } else {
                file_put_contents("debug.output", "Time out!");
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id = $this->id;
        $id_proprietario = $this->id_proprietario;
        $id_casa = $this->id_casa;
        $titulo = $this->titulo;
        $preco = $this->preco;
        $data_criacao = $this->data_criacao;
        $data_disponibilidade = $this->data_disponibilidade;
        $despesas_inc = $this->despesas_inc;
        $descricao = $this->descricao;

        $myObj = new \stdClass();
        $myObj->id = $id;
        $myObj->id_proprietario = $id_proprietario;
        $myObj->id_casa = $id_casa;
        $myObj->titulo = $titulo;
        $myObj->preco = $preco;
        $myObj->data_criacao = $data_criacao;
        $myObj->data_disponibilidade = $data_disponibilidade;
        $myObj->despesas_inc = $despesas_inc;
        $myObj->descricao = $descricao;


        $myJSON = json_encode($myObj);
        if ($insert)
            $this->FazPublish("INSERT", $myJSON);
        else
            $this->FazPublish("UPDATE", $myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $id = $this->id;
        $myObj = new \stdClass();
        $myObj->id = $id;
        $myJSON = json_encode($myObj);
        $this->FazPublish("DELETE", $myJSON);
    }
}
