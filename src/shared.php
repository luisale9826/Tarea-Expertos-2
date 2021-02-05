<?php

function calculoProbabilidad($instacia, $m, $prob, $n) {
    return ($instacia+$m*$prob)/($n+$m);
}
