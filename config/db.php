<?php
$dbconfig=[
    1=>'acar',
];
foreach($dbconfig as $k=>$v)
{
    $db['db'.$v]=[
        'class' => 'yii\db\Connection',
        // 配置主服务器
        'dsn' => "mysql:host={$ACARSRVCONFIG["ACARSRV_DB{$k}_HOST"]};port={$ACARSRVCONFIG["ACARSRV_DB{$k}_PORT"]};dbname={$ACARSRVCONFIG["ACARSRV_DB{$k}_NAME"]};$charset",
        'username' => $ACARSRVCONFIG["ACARSRV_DB{$k}_USER"],
        'password' => $ACARSRVCONFIG["ACARSRV_DB{$k}_PASS"],
    ];
}
return $db;
