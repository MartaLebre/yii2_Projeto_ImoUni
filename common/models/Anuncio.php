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
 * @property int $numero_telemovel
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
            [['titulo'], 'required', 'message' => 'Introduza um título.'],
            [['titulo'], 'string', 'max' => 45],
            
            [['preco'], 'required', 'message' => 'Introduza um preço.'],
            [['preco'], 'integer', 'message' => 'Preço inválido.'],
    
            ['data_disponibilidade', 'safe'],
            ['data_disponibilidade', 'required', 'message' => 'Introduza a data de disponibilidade.'],
            ['data_disponibilidade', 'date', 'format' => 'Y-M-d', 'message' => 'Formato de data inválida.'],
            
            [['despesas_inc'], 'required', 'message' => 'Escolha uma das opções.'],
    
            [['descricao'], 'required', 'message' => 'Introduza uma descrição.'],
            [['descricao'], 'string'],
    
            ['numero_telemovel', 'integer', 'message' => 'Número de telemovel incorreto.'],
            ['numero_telemovel', 'required', 'message' => 'Introduza um número de telemovel.'],
            [
                'numero_telemovel', 'string', 'min' => 9, 'max' => 9,
                'tooShort' => 'O número de telemovel tem que ter 9 dígitos.',
                'tooLong' => 'O número de telemovel tem que ter 9 dígitos.'
            ],
            
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
            'titulo' => 'Título',
            'preco' => 'Preço',
            'data_criacao' => 'Data da criação',
            'data_disponibilidade' => 'Data de disponibilidade',
            'despesas_inc' => 'Despesas incluídas',
            'descricao' => 'Descrição',
            'numero_telemovel' => 'Número de telemóvel',
        ];
    }
    
    /**
     * Cria uma casa
     * @param Casa $id_user para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addAnuncio($id_user, $id_casa){
        if (!$this->validate()) {
            return null;
        }
        
        $anuncio = new Anuncio();
    
        $anuncio->id_proprietario = $id_user;
        $anuncio->id_casa = $id_casa;
        $anuncio->titulo = $this->titulo;
        $anuncio->preco = $this->preco;
        $anuncio->data_disponibilidade = $this->data_disponibilidade;
        $anuncio->despesas_inc = $this->despesas_inc;
        $anuncio->descricao = $this->descricao;
        $anuncio->numero_telemovel = $this->numero_telemovel;
        $anuncio->save();
        
        return true;
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
