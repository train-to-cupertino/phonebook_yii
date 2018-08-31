<?php
//namespace common\models;
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Phone;

class Contact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
		
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            //['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
	
	
    //функция связи модели
    public function getPhones()
    {
		return $this->hasMany(Phone::className(), ['contact_id' => 'id']);
		//return $this->hasMany(Phone::className(), ['id' => 'contact_id']);
		//return implode(",", $this->hasMany(Phone::className(), ['contact_id' => 'id']));
    }	
}
