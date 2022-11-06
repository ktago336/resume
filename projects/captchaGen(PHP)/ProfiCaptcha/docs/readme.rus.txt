ProfiCaptcha 0.5
(c) Леонтьев Валерий (Компания "Профигруп"), 2007—2008

=== Содержание ===

1. О скрипте.
2. Лицензия.
3. Установка и использование.
4. Ссылки

=== О скрипте ===

CAPTCHA — это аббревиатура от английских слов "Completely Automatic Public Turing Test to Tell
Computers and Humans Apart" — полностью автоматический тест Тьюринга для различения компьютеров
и людей. Иными словами, это задача, которую легко решает человек, но которую невозможно (или
крайне трудно) научить решать компьютер.
Применяются CAPTCHA для того, чтобы предотвратить множественные автоматические регистрации и
отправления сообщений программами-роботами. Т. е. задача CAPTCHA — защита от спама, флуда и
захвата аккаунтов.
Чаще всего CAPTCHA выглядит как тем или иным образом зашумленное случайное число, слово или
иная надпись, которую пользователю нужно прочитать и ввести прочитанный результат, хотя
существуют и другие алгоритмы.
ProfiCaptcha – это PHP-скрипт для организации на страницах сайта проверки у посетителя
«человеческого фактора» для защиты от спам- и флуд-роботов. В форму вставляется картинка,
сгенерированная скриптом, на которой изображены символы. Картинка защищена от распознавания
роботами. Пользователь читает символы на картинке и вводит их в поле формы. Скрипт, принимающий
форму, проверяет наличие введенного пользователем кода в специальной переменной сессии. Если
код не найден – возвращается ошибка и предложение ввести код повторно.
Разработчики: Валерий Леонтьев (feedbee@gmail.com)
Версия 0.1 разработана Александром Сукачем, но переписана на 90%.
Требования: PHP5 с установленными библиотеками GD и FreeType и включенной поддержкой стандартных
сессий.

=== Лицензия: BSD ===

Copyright (c) 2007—2008, Leontyev Valera (Profigroup Company)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted
provided that the following conditions are met:
- Redistributions of source code must retain the above copyright notice, this list of conditions
and the following disclaimer.
- Redistributions in binary form must reproduce the above copyright notice, this list of
conditions and the following disclaimer in the documentation and/or other materials provided
with the distribution.
- Neither the name of Leontyev Valera or the Profigroup Company nor the names of its contributors
may be used to endorse or promote products derived from this software without specific prior
written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

=== Установка и использование ===

Что бы интегрировать скрипт в Ваш сайт, нужно проделать следующие шаги:
1) Распаковать архив со скриптом.
2) Открыть файл Settings.php в текстовом или PHP-реакторе. Внести необходимые изменения в
настройки скрипта.
3) Загрузить все файлы на сервер (рекомендуется в отдельный каталог).
4) В HTML-форму на сайте вставить картинку и поле для ввода кода (см. пример).
5) В скрипте, принимающем форму, вставить проверку на соответствие кода. Код должен
присутствовать в массиве $_SESSION[SESSION_KEY], где SESSION_KEY – константа класса,
установленная в настройках скрипта (по умолчанию: «VeryficationNumber», т.е. массив
$_SESSION[‘VeryficationNumber’]).

Скрипт можно настроить по своему усмотрению. Для этого необходимо изменить настройки в файле
Settings.php (все настройки прокомментированы) и поэкспериментировать с результатами.
Кроме того, можно менять фоновые изображения и файлы шрифтов. Размер результирующего
изображения равен размеру фонового изображения. Скрипт случайно выбирает любой файл изображения 
и файл шрифта для каждой цифры из соответствующих каталогов, указанных в настройках. Файлы
фоновых изображений должны быть в формате PNG, JPEG или GIF.

=== Ссылки ===

- Страница скрипта ProfiCaptcha – http://valera.ws/proficaptcha/ 
- Сайт компании «Профигруп» – http://profigroup.by/ 
- Блог автора скрипта – http://valera.ws/ 
- Русскоязычный ресурс о CAPTCHA – http://captcha.ru/ 
- Страница Википедии о CAPTCHA - http://ru.wikipedia.org/wiki/CAPTCHA
Удачи!
