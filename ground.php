<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core.php");

// присвоение значений времени переменным
$start = '10:00';
$end = '19:00';
$break_time_start = '12:00';
$break_time_end  = '13:00';

// преобразование текстового представления даты в метку времени UNIX ( т.е.в количество секунд, прошедших с 1 января 1970 года 00:00:00 UTC)
// UTC - Coordinated Universal Time, Всеми́рное координи́рованное вре́мя

$start_time = strtotime($start);
$end_time = strtotime($end);
// в ходе цикла переменная $start_time приобретает очередные полчаса пока не достигнет значения переменной $end_time
while($start_time < $end_time) {
    $t = strtotime("+30 minute", $start_time); // конвертация дополнительных 30 минут к текущему времени
    // диапазон перерыва
    if ($start_time>=strtotime($break_time_start)&$start_time<strtotime($break_time_end)){
        $start_time = $t; // добавление новых 30 минут для следующей итерации
        continue;
    }
    p(date("H:i",$start_time));
    $start_time = $t;

}

die;
while ($start_time < $end_time) { // цикл while выполняет вложенные выражения повторно до тех пор,
    // пока выражение в самом while является true
//    p($start_time . " / " . date("+H:i", $start_time));
    if ($start_time>=strtotime($break_time_start)&$start_time<strtotime($break_time_end))continue;

    /*
    на этом этапе выводятся все итерации цикла:
    по умолчанию цикл перебирает значения, попадающие в $start_time
    если сделать дебаг любой другой переменной, ВСЕ итерации будут заменены на значение этой переменной
    */
    // присвоение переменной $t значения из переменной $start_time c добавлением 30 минут и последующим переводом в UNIX формат
        $t = strtotime("+30 minute", $start_time);
    if($start_time<=strtotime($break_time_start)or$start_time>=strtotime($break_time_end)) {
        p(date("H:i",$start_time));
    }
//    p(date("H:i",$start_time));
//        p("очередное время: " . date("H:i", $start_time) . " / " . $start_time);
        $start_time = $t;

// здесь в переменных остаются только значения "+30 минут", т.е. от 10:30 до 19:00


}
?>
  <? $st = strtotime($start);
    $et = strtotime($end);?>
<select name="time" id="time">
    <?
    while($st < $et) {
        $t = strtotime("+30 minute", $st);?>
        <option><?=date("H:i", $st)?></option>
        <? $st = $t;
    }
    ?>
</select>


<div>
    <label for="time">время приёма</label>
    <select name="time" id="time">
        <?
       while($start_time < $end_time) {
         $t = strtotime("+30 minute", $start_time);?>
           <option><?=date("H:i", $start_time)?></option>
            <? $start_time = $t;
       }
        ?>

</div>
<?




//&$start_time>=1681293600
