<?php

/**
 * ---=== ProfiCaptcha 0.5 ===---
 * v. 0.5.0.0
 * 
 * (c) Леонтьев Валерий (Компания "Профигруп"), 2007—2008
 * (c) Leontyev Valera (Profigroup Company), 2007—2008
 * 
 * Разработчик: Валерий Леонтьев (feedbee@gmail.com)
 * Версия 0.1 разработана Александром Сукачем, но переписана на 90%.
 * Developers: Valery Leontyev (feedbee@gmail.com)
 * Basic 0.1 version was developed by Alex Sukach and 90% rewriten
 * 
 * Требования: PHP5 с установленными библиотеками GD и FreeType.
 * Стандартный движек сессий PHP должен быть включен и работать корректно.
 * Requirements: PHP5 with GD library and the FreeType library installed.
 * Standart session engine must be enabled and work propertly.
 * 
 * Лицензия: BSD / License: BSD
 * 
 * Copyright (c) 2007—2008, Leontyev Valera (Profigroup Company)
 *
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 * - Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * - Neither the name of Leontyev Valera or the Profigroup Company nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */

/**
 * 
 * !!! README !!!
 * 
 * Это файл настроек скрипта.
 * 
 * Script options file.
 * 
 */

/**
 * Настройки / Options
 */

// Отключаем вывод ошибок (при отладке закомментируйте)
// Disable error output (comment while debugging)
error_reporting(0);

class ProfiCaptchaOptions
{
	
	// Ключ в массиве $_SESSION для хранения массива сгенерированных контрольных кодов
	// The KEY of element of $_SESSION array to store generated control codes
	const SESSION_KEY = 'VeryficationNumber'; // default: VeryficationNumber
	
	// Относительный или абсолютный путь до файла с классом _со слешем на конце_
	// Relative or absolute path to class-file _with final slash_
	const CLASS_FILE_PATH = ''; // default: [empty]
	
	// Если фон брать из файла, установите значение true, если генеримровать — false
	// To create background from ready image set true, to generate random image set false
	const CREATE_FROM_IMAGE = false; // default: false
	
	// Размер изображения при генерации (используется только при CREATE_FROM_IMAGE = false)
	// Image size in generation mode (CREATE_FROM_IMAGE = false)
	static public $GenerationSize = array(
		'width' => 22,
		'height' => 35
	);
	
	// Относительный или абсолютный путь к каталогу с фонами _со слешем на конце_
	// Relative or absolute path to backgrounds directory _with final slash_
	const BACKGROUNDS_PATH = 'backgrounds/digits/'; // defaults: 
	// backgrounds/graphic-160x50, backgrounds/graphic-110x35
	
	// Относительный или абсолютный путь к каталогу со шрифтами _со слешем на конце_
	// Relative or absolute path to fonts directory _with final slash_
	const FONTS_PATH = 'fonts/'; // default: fonts/
	
	// Киличество символов на картинке
	// Count of symbols in the picture
	const SYMBOLS_COUNT = 1; // default: 5, you can use rand(4,5) for example
	
	// Набор символов, из которых будет сгенерирован код
	// Symbols collection to build code
	static public $Alphabet = '0'; // defaults:
	// alnum: 123456789ABCDEFGHKLMNPQRSTYVWXYZ
	// num: 123456789
	
	// Рисовать ли дополнительные шумы (true/false)
	// Draw additional noises (true/false)
	const DRAW_NOISE = false; // default: false
	
	// Коэфициент шумового искажения (от 0 до 30)
	// Noises distruction power (from 0 to 30)
	const DRAW_NOISE_POWER = 5; // default: 5
	
	// Искажить ли символы волнами (true/false)
	// Apply waves filter to symbols (true/false)
	const WAVES = false; // default: true
	
	// Размывать изображение
	// Blur the picture
	const BLUR = true; // default: false
	
	// Пределы угла поворота символа (от - до)
	// Limits of symbol rotation angle (from - to)
	static public $AngleLimits = array('from' => -25, 'to' => 25); // default: -25, 25
	
	// Максимальное количество хранимых сгенерированных кодов
	// Maximum count of generated codes stored
	const CODES_COUNT_LIMIT = 10; // default: 10, 0 for unlimited
	
	// array(A1=>array(D1=>B1, D2=>B3, ...), A2=>array(D2=>B2), ...);
	// Correct "bad symbols". If sybol D in font A does not readable (for ex. "1" looks like "7"),
	// change font for this letter to B. A and B is filenames (without path).
	// Если символ D плохо читается в шрифте A (например цифра "1" похожа на "7",
	// то заменяем этот шрифт для нее на B. A и B - имена файлов (без путей).
	static public $Correction = array(
		'RAVIE.TTF' => array('1' => 'TAHOMA.TTF', '5' => 'TAHOMA.TTF'),
		'FORTE.TTF' => array('1' => 'TAHOMA.TTF', '5' => 'TAHOMA.TTF', '7' => 'RAVIE.TTF', 'C' => 'TAHOMA.TTF', 'E' => 'TAHOMA.TTF', 'T' => 'TAHOMA.TTF'),
		'ANTQUABI.TTF' => array('7' => 'RAVIE.TTF'),
		'TAHOMA.TTF' => array('7' => 'RAVIE.TTF'),
		'ALGER.TTF' => array('1' => 'TAHOMA.TTF'),
		'AGENCYB.TTF' => array('1' => 'TAHOMA.TTF', '1' => 'RAVIE.TTF'),
		'ARIALNI.TTF' => array('1' => 'TAHOMA.TTF'),
	);

}

?>