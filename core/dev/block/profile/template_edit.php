<div id="patient_appointment">
    <h1>Пациент: <?=$arPatient['name']?></h1>
    <img src="<?=$arPatient['patient_photo']?>" alt="">

    <form method="post" id="app">
        <h2>редактирование приёма</h2>
        <table border="1">
            <tr>
                <th>Имя</th>
                <th>Дата приёма</th>
            </tr>
            <tr>
                <td><?=$arPatient['name']?></td>
                <td><?=$arHistory['day_time']?></td>
            </tr>
        </table>
        <div class="field_area">
            <label for="reason">причина обращения</label>
            <input type="text" id="reason" name="reason" class="field" value="<?=$arHistory['reason']?>">
        </div>
        <div class="field_area">
            <label for="survey">лечение</label>
            <textarea name="survey" id="survey" cols="30" rows="10" class="field"><?=$arHistory['survey']?></textarea>
        </div>
        <div class="field_area">
            <label for="resume">результат</label>
            <textarea id="resume" name="resume" cols="30" rows="10" class="field"><?=$arHistory['resume']?></textarea>
        </div>
        <div class="field_area">
            <label for="visit_status">статус посещения</label>
            <select name="visit_status" id="visit_status">
                <? foreach ($CORE['LIST']['visit_status'] as $key => $value): ?>
                    <option value="<?=$key?>"<?=$arHistory['visit_status']==$key ? " selected" : ""?>><?=$value['label']?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="field_area">
            <input type="hidden" name="patient_id" value="<?=$arHistory['patient_id']?>" required>
            <input type="submit" name="edit_appoint" value="внести изменения" class="field">
        </div>
    </form>
</div>
