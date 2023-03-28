## Техническое задание
врачу, принимающему пациентов необходимо расписание на неделю, в котором будет выставляться назначение на определённое время пациентов. К каждому назначению должен выставляться запас времени.Назначения не должны пересекаться. На каждого пациента должна заводиться личная карточка (ФИО, дата рождения, пол и т.д.), а также должна вестись история посещений (отчёт врача после каждого визита пациента)

### TODO 
- подготовить вёрстку страниц (расписание, личная карточка, интерфейс CRUD назначений в расписании, интерфейс CRUD пациентов)
- БД. Таблицы 1 - пациенты, 2 - история посещений.  
- Сделать интерфейс для назначений даты и времени приёма на странице пациента.   
+- в таблице history обьеденить столбцы day и time. Обрабатывать выходное значение можно так: list($date,$time) = explode(" ", "2023-03-06 16:32:42").  
Запрашивать данные можно по обрывку строки с оператором LIKE "SELECT * FROM `history` WHERE `created_at` LIKE '2023-02-25%';".  
+ Уникализировать поле name в таблице patient. Добавить поле "номер ОМС" или в структуре поля  name отметить "unique"  
+ В таблице History столбец patient переименовать в patient_id и в этом столбце вместо имени заносить идентификаторы пациентов из таблицы patient (взаимосвязь "один ко многим").    
+ Таблица "Schedule": название таблицы переименовать в "History", поле "patient_id" назначить тип int, добавить поле протокола приёма txt.  
- Создать страницу, на которой будут выведены все посещения, посещения, которые прошли (в прошлом) отмечать серым цветом, те, которые будут (в будущем) - зелёным цветом.  
- При удалении карты пациента так же удалять всю историю посещений этого пациента.  
- Проверка входных данных при внесении и редактирование.  
- Главная страница (index.php) - реализовать dashboard с виджетами (будущие назначения на сегодня/на неделю/на месяц, список пациентов, хроника посещений), сайдбар с меню.