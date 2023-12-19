<?
$arPatient = $CORE['PATIENT']->Read();

$arHistory = $CORE['HISTORY']->Read();
// p($arHistory);
// подключение шаблона блока
template();