<?php
    if($region=="1"){
        $region="<span class='badge badge-info'>NA</span>";
    }
    if($region=="2"){
        $region="<span class='badge badge-primary'>OC</span>";
    }
    if($region=="3"){
        $region="<span class='badge badge-success'>EU</span>";
    }
    if(empty($region)){
        $region="<span class='badge badge-warning'>Open</span>";
    }
?>