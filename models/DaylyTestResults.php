<?php

namespace app\models;
use Yii;
use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "phostestglobaltest".
 *
 * @property integer $id
 * @property string $stationid
 * @property string $uutname
 * @property string $partnumber
 * @property string $serialnumber
 * @property string $techname
 * @property string $testdate
 * @property string $timestart
 * @property string $timestop
 * @property integer $uutplace
 * @property string $testmode
 * @property string $globalresult
 * @property integer $indexrange
 * @property string $versions
 * @property integer $backupflag
 */
class DaylyTestResults extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ateglobal';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'pass_result', 'fail_result'], 'integer'],
            [['time_update'], 'string'],
            [['server_name'], 'string', 'max' => 25],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server_name' => 'ServerName',
            'pass_result' => 'PassResult',
            'fail_result' => 'FailResult',
            'serialnumber' => 'Serialnumber',
            'time_update' => 'Timestart',
        ];
    }

    public function getLastDayPassResults()
    {
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $res1 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\''.Yii::$app->user->identity->username.'\'')->queryAll();
        else{
          $res1 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ceragon\'')->queryAll();
          $res2 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex1\'')->queryAll();
          $res3 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex2\'')->queryAll();
          $res4 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics1\'')->queryAll();
          $res5 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics2\'')->queryAll();
          $res6 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'VCL1\'')->queryAll();
          $res7 = Yii::$app->db->createCommand('SELECT PASS_RESULT as passresult from PASSFAIL_RESULTS where SERVER_NAME=\'JBL1\'')->queryAll();
        }
        $pass_result = array();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $pass_result = array((int)$res1[0]['passresult']);
        else
          $pass_result = array((int)$res1[0]['passresult'], (int)$res2[0]['passresult'], (int)$res3[0]['passresult'], (int)$res4[0]['passresult'], (int)$res5[0]['passresult'], (int)$res6[0]['passresult'], (int)$res7[0]['passresult']);
        return $pass_result;
    }
    public function getLastDayFailResults()
    {
      if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
        $res1 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\''.Yii::$app->user->identity->username.'\'')->queryAll();
      else{
        $res1 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ceragon\'')->queryAll();
        $res2 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex1\'')->queryAll();
        $res3 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex2\'')->queryAll();
        $res4 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics1\'')->queryAll();
        $res5 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics2\'')->queryAll();
        $res6 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'VCL1\'')->queryAll();
        $res7 = Yii::$app->db->createCommand('SELECT FAIL_RESULT as failresult from PASSFAIL_RESULTS where SERVER_NAME=\'JBL1\'')->queryAll();
      }
        $fail_result = array();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $fail_result = array((int)$res1[0]['failresult']);
        else
          $fail_result = array((int)$res1[0]['failresult'], (int)$res2[0]['failresult'], (int)$res3[0]['failresult'], (int)$res4[0]['failresult'], (int)$res5[0]['failresult'], (int)$res6[0]['failresult'], (int)$res7[0]['failresult']);
        return $fail_result;
    }
    public function getLastDayErrorResults()
    {
      if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
        $res1 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\''.Yii::$app->user->identity->username.'\'')->queryAll();
      else{
        $res1 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ceragon\'')->queryAll();
        $res2 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex1\'')->queryAll();
        $res3 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'Flex2\'')->queryAll();
        $res4 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics1\'')->queryAll();
        $res5 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'Ionics2\'')->queryAll();
        $res6 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'VCL1\'')->queryAll();
        $res7 = Yii::$app->db->createCommand('SELECT ERROR_RESULT as errorresult from PASSFAIL_RESULTS where SERVER_NAME=\'JBL1\'')->queryAll();
      }
        $error_result = array();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $error_result = array((int)$res1[0]['errorresult']);
        else
          $error_result = array((int)$res1[0]['errorresult'], (int)$res2[0]['errorresult'], (int)$res3[0]['errorresult'], (int)$res4[0]['errorresult'], (int)$res5[0]['errorresult'], (int)$res6[0]['errorresult'], (int)$res7[0]['errorresult']);
        return $error_result;
    }
// SELECT UUTNAME, COUNT ( globalresult ) as failcount FROM (SELECT A.id, A.uutname, A.serialnumber, A.testdate, A.globalresult, B.*  from PHOSTESTGLOBALTEST A, PHOSTESTGLOBALRES B  where A.id = B.HEADER_ID and B.teststatus='Fail' AND A.testdate >= dateadd (-1 day to current_date) and A.GLOBALRESULT='Fail' order by A.uutname ASC, A.serialnumber ASC) GROUP BY UUTNAME  ORDER by failcount DESC
    public function getLastDayUUTFails()
    {
  //    print(Yii::$app->user->identity->username);

      if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon')){
          //$sql_string = 'SELECT UUTNAME as name, COUNT(GLOBALRESULT) as y FROM (SELECT A.id, A.UUTNAME, A.SERIALNUMBER, A.TESTDATE, A.GLOBALRESULT, B.HEADER_ID, A.FACILITY, B.TESTSTATUS from PHOSTESTGLOBALTEST A, PHOSTESTGLOBALRES B where A.id = B.HEADER_ID AND A.FACILITY=\''.Yii::$app->user->identity->username.'\' AND B.TESTSTATUS=\'Fail\' AND A.TESTDATE >= NOW() - INTERVAL 1 DAY and A.GLOBALRESULT=\'Fail\' order by A.UUTNAME ASC, A.SERIALNUMBER ASC) as table_result GROUP BY UUTNAME ORDER by y DESC';
          $sql_string = 'SELECT UUTNAME as name, COUNT(GLOBALRESULT) as fails FROM (SELECT * from PHOSTESTGLOBALTEST where FACILITY=\''.Yii::$app->user->identity->username.'\' AND TESTDATE >= NOW() - INTERVAL 1 DAY and GLOBALRESULT=\'Fail\' order by UUTNAME ASC, SERIALNUMBER ASC) as table_result GROUP BY UUTNAME ORDER by fails DESC';
      }
      else{
//        $sql_string = 'SELECT UUTNAME as name, COUNT(GLOBALRESULT) as y FROM (SELECT A.id, A.UUTNAME, A.SERIALNUMBER, A.TESTDATE, A.GLOBALRESULT, B.HEADER_ID, B.TESTSTATUS from PHOSTESTGLOBALTEST A, PHOSTESTGLOBALRES B where A.id = B.HEADER_ID and B.TESTSTATUS=\'Fail\' AND A.TESTDATE >= NOW() - INTERVAL 1 DAY AND A.GLOBALRESULT=\'Fail\' order by A.UUTNAME ASC, A.SERIALNUMBER ASC) as table_result GROUP BY UUTNAME ORDER by y DESC';
        $sql_string = 'SELECT UUTNAME as name, COUNT(GLOBALRESULT) as fails FROM (SELECT * from PHOSTESTGLOBALTEST where GLOBALRESULT=\'Fail\' AND TESTDATE >= NOW() - INTERVAL 1 DAY AND GLOBALRESULT=\'Fail\' order by UUTNAME ASC, SERIALNUMBER ASC) as table_result GROUP BY UUTNAME ORDER by fails DESC';
      }
        $res1 = Yii::$app->db->createCommand($sql_string)->queryAll();
        $uutFail_result = array();
        $uutFail_result = $res1;
        return $uutFail_result;
    }

    public function getDaylyPassFailResults()
    {
      if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
        $res1 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\''.Yii::$app->user->identity->username.'\' order by DATE ASC')->queryAll();
      else{
        $res1 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'Ceragon\' order by DATE ASC')->queryAll();
        $res2 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'Flex1\' order by DATE ASC')->queryAll();
        $res3 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'Flex2\' order by DATE ASC')->queryAll();
        $res4 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'Ionics1\' order by DATE ASC')->queryAll();
        $res5 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'Ionics2\' order by DATE ASC')->queryAll();
        $res6 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'VCL1\' order by DATE ASC')->queryAll();
        $res7 = Yii::$app->db->createCommand('SELECT * from PASSFAIL_DAYLY where SERVER=\'JBL1\' order by DATE ASC')->queryAll();
      }
        $dayly_result = array();
        if ((Yii::$app->user->identity->username <> 'admin') AND (Yii::$app->user->identity->username <> 'Ceragon'))
          $dayly_result = array($res1);
        else
          $dayly_result = array($res1, $res2, $res3, $res4, $res5, $res6, $res7);
        return $dayly_result;
    }

}
