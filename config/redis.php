<?php
$dbconfig=[
    1=>'mp',
    2=>'task',
    3=>'yimai',
    4=>'club',
];
$prefix=[
    'mp'=>'0_',
    'club'=>'0_',
];
$XYWYSRVCONFIG['XYWYSRV_REDIS4_HOST']='proxy19054.redis.service.op.xywy.com';
$XYWYSRVCONFIG['XYWYSRV_REDIS4_PORT']='19054';
foreach($dbconfig as $k=>$v)
{
    $redis['rd'.$v]=[
        'class' => 'app\components\vendor\RedisConnection',
        'hostname' => $XYWYSRVCONFIG["XYWYSRV_REDIS{$k}_HOST"],
        'port' => $XYWYSRVCONFIG["XYWYSRV_REDIS{$k}_PORT"],
        'database' => 0,
    ];
    if($prefix[$v])
    {
        $redis['rd'.$v]['prefix']=$prefix[$v];
    }
}

return $redis;
