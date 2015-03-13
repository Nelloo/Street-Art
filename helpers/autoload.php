<?php
function __autoload($className) {
    $pp="./";
    if(strpos($className,"PDO")===0) {
        include "$pp/model/base/db/pdo/$className.class.php";
        return;
    }
    if(strpos($className,"Adapter")!==false) {
        include "$pp/model/base/db/$className.class.php";
        return;
    }

    
    if($className=="Table") {
        include "$pp/model/base/tables/Table.class.php";
        return;
    }
    
    if($className=="Query") {
        include "$pp/model/base/queries/Query.class.php";
        return;
    }
    
    if(strpos($className,"SQL")!==false) {
        include "$pp/model/mymodel/queries/$className.class.php";
        return;
    }

    include "$pp/model/mymodel/tables/$className.class.php";
}
