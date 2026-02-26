<?php
function showProgress($raised,$target){
    $percent = 0;
    if($target > 0){
        $percent = ($raised/$target)*100;
        if($percent > 100){
            $percent = 100;
        }
    }

    echo "
    <div class='progress'>
        <div class='progress-bar' style='width:$percent%'>
            <span class='progress-text'>".round($percent)."%</span>
        </div>
    </div>
    ";
}
?>