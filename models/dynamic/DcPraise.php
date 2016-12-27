<?php
namespace app\models\dynamic;
use yii\db\ActiveRecord;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class DcPraise extends ActiveRecord
{


    public static function tableName()
    {

            return 'dc_praise';

    }


    public static function getDb() {
        return Yii::$app->get('dbdc');
    }


    /**
     * @param $table
     * @return object
     * @throws InvalidConfigException
     */
    public static function findx($table)
    {
        if (self::$table != $table) {
            self::$table = $table;
        }
        return Yii::$app->dbdc->createCommand("SELECT * FROM $table")->queryAll();
    }

    /**
     * @param array $row
     * @return static
     */





    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function findOnex($table, $condition)
    {
        return static::findByConditionx($table, $condition)->one();
    }

    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function findAllx($table, $condition)
    {
        return static::findByConditionx($table, $condition)->all();
    }

    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    protected static function findByConditionx($table, $condition)
    {
        $query = static::findx($table);

        if (!ArrayHelper::isAssociative($condition)) {
            // query by primary key
            $primaryKey = static::primaryKey();
            if (isset($primaryKey[0])) {
                $condition = [$primaryKey[0] => $condition];
            } else {
                throw new InvalidConfigException('"' . get_called_class() . '" must have a primary key.');
            }
        }

        return $query->andWhere($condition);
    }

}