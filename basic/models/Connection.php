<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "connection".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $host
 * @property string $db_name
 * @property integer $user_id
 * @property integer $is_selected
 */
class Connection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'host', 'db_name', 'user_id'], 'required'],
            [['user_id', 'is_selected'], 'integer'],
            [['username', 'password', 'host', 'db_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'host' => 'Host',
            'db_name' => 'Db Name',
            'user_id' => 'User ID',
            'is_selected' => 'Is Selected',
        ];
    }
}
