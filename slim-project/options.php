<?php

use RedBeanPHP\R;

R::setup('mysql:host=localhost;dbname=hky', 'hky', 'hky');

define('__PUBLIC__', 'http://'.$_SERVER['SERVER_ADDR'].'/');

die(__PUBLIC__);