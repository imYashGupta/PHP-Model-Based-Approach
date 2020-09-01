<?php
$modelsDir = __DIR__.DIRECTORY_SEPARATOR.'models';
$files = scandir($modelsDir);
$models = array_diff($files, array('.', '..'));
foreach($models as $model){
    if($model=='model'  ){
        return;
    }
    require_once($modelsDir.DIRECTORY_SEPARATOR.$model);
}

