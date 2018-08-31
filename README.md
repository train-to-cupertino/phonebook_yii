# phonebook
Test phonebook app

Создание БД и таблиц:

-- База данных: `test`

>Структура таблицы `contact`
>>CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

> Структура таблицы `phone`
>>CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `phone` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

>ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

>ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);