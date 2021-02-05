# yii2-clamav
yii2-clamav is a Yii2 component to clamd / clamscan that allows you to scan files and directories using ClamAV.

Examples
========

in your config file

```PHP
<?php
    'components' => [
    .....
        'clamav' => [
            'class' => 'Cacko\ClamAv\Scanner',
            'driver' => 'clamd_local',
            'socket' => '/var/run/clamav/clamd.sock'
        ],
```

Scan file
```PHP
<?php

$result = Yii::$app->clamav->scan('my_file.txt');

```

Scan text
```PHP
<?php

$result = Yii::$app->clamav->scanBuffer(file_get_contents('my_file.txt'));

```

Scan file as object
```PHP
<?php

$result = Yii::$app->clamav->scanResource(new SplFileObject('my_file.txt'), 'rb');

```