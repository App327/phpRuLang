<?php

class phpRuLang {
 private $libData = [
  'version' => '0.1.0',
  'versionRelDate' => '2026-08-23',
  'relChannel' => 'dev',
  'license' => 'MIT License',
  'githubLink' => 'https://www.github.com/App327/phpRuLang',
  'libName' => 'phpRuLang'
 ];
 public const ALPHABET_TYPE_STRING = 0;
 public const ALPHABET_TYPE_ARRAY = 1;
 public const ALPHABET_TYPE_ASSOC_ARRAY = 2;


 /*
   Возвращает сведения о версии библиотеки phpRuLang.
   Параметры (аргументы):
   • $property — название свойства (из переменной $libData), которое нужно получить; если равно null, то будет возвращён массив из всех свойств.
 */
 public static function version($property = null) {
  if ($property === null) {
   return $this->libData;
  } else {
   return $this->libData[$property];
  }
 }

 /*
   Возвращает алфавит русского языка.
   Параметры (аргументы):
   • $format — формат вывода (строка, массив или ассоциативный массив)
   • $params — массив с параметрами результата (список параметров зависит от формата)
 */
 public function getAlphabet(string|int $format = 'string', array $params = []) {
  $alphabetLetters = [
   'lowerCase' => [
    'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
   ],
   'upperCase' => [
    'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
   ]
  ];
  $supportedFormats = [self::ALPHABET_TYPE_STRING, self::ALPHABET_TYPE_ARRAY, self::ALPHABET_TYPE_ASSOC_ARRAY, 'string', 'str', 'array', 'arr', 'associative_array', 'assoc_array', 'assoc_arr'];
  $sfConvertRules = [
   'string' => self::ALPHABET_TYPE_STRING,
   'str' => self::ALPHABET_TYPE_STRING,
   'array' => self::ALPHABET_TYPE_ARRAY,
   'arr' => self::ALPHABET_TYPE_ARRAY,
   'associative_array' => self::ALPHABET_TYPE_ASSOC_ARRAY,
   'assoc_array' => self::ALPHABET_TYPE_ASSOC_ARRAY,
   'assoc_arr' => self::ALPHABET_TYPE_ASSOC_ARRAY
  ];
  $supportedStringAndArrayOrders = ['ulul', 'lulu', 'uull', 'lluu'];
  $supportedAssocArrayOrders = ['ulul', 'lulu'];
  if (is_string($format)) {
   $format = trim($format);
   $format = strtolower($format);
  }
  if (in_array($format, $supportedFormats)) {
   if (array_key_exists($format, $sfConvertRules)) {
    $f = $sfConvertRules[$format];
   }
  } else {
   throw new InvalidArgumentException('Значение параметра $format не является одним из допустимых', 1);
  }
  $p = [];
  $params = array_change_key_case($params, CASE_LOWER);
  array_walk($params, function(&$value) {
   if (is_string($value)) {
    $value = trim($value);
    $value = strtolower($value);
   }
  });
  if ($f === self::ALPHABET_TYPE_STRING) {
   if (array_key_exists('lowercase', $params) === false || is_bool($params['lowercase']) === false) {
    $p['lowerCase'] = true;
   } else {
    if ($params['lowercase'] === true) {
     $p['lowerCase'] = true;
    } else {
     $p['lowerCase'] = false;
    }
   }
   if (array_key_exists('uppercase', $params) === false || is_bool($params['uppercase']) === false) {
    $p['upperCase'] = true;
   } else {
    if ($params['uppercase'] === true) {
     $p['upperCase'] = true;
    } else {
     $p['upperCase'] = false;
    }
   }
   if ($p['lowerCase'] === false && $p['upperCase'] === false) {
    throw new InvalidArgumentException('В массиве в параметре $params должно быть установлено в true хотя бы только upperCase или lowerCase (или оба)', 2);
   }
   if ($p['lowerCase'] === true && $p['upperCase'] === true) {
    if (array_key_exists('order', $params) === false || is_string($params['order']) === false || in_array($params['order'], $supportedStringAndArrayOrders) === false) {
     $p['order'] = 'ulul';
    } else {
     $p['order'] = $params['order'];
    }
   }
   if ($p['upperCase'] === true) {
    if (array_key_exists('includeallucletters', $params) === false || is_bool($params['includeallucletters']) === false) {
     $p['includeAllUCLetters'] = true;
    } else {
     if ($params['includeallucletters'] === true) {
      $p['includeAllUCLetters'] = true;
     } else {
      $p['includeAllUCLetters'] = false;
     }
    }
   }
  } else if ($f === self::ALPHABET_TYPE_ARRAY) {
   if (array_key_exists('lowercase', $params) === false || is_bool($params['lowercase']) === false) {
    $p['lowerCase'] = true;
   } else {
    if ($params['lowercase'] === true) {
     $p['lowerCase'] = true;
    } else {
     $p['lowerCase'] = false;
    }
   }
   if (array_key_exists('uppercase', $params) === false || is_bool($params['uppercase']) === false) {
    $p['upperCase'] = true;
   } else {
    if ($params['uppercase'] === true) {
     $p['upperCase'] = true;
    } else {
     $p['upperCase'] = false;
    }
   }
   if ($p['lowerCase'] === false && $p['upperCase'] === false) {
    throw new InvalidArgumentException('В массиве в параметре $params должно быть установлено в true хотя бы только upperCase или lowerCase (или оба)', 2);
   }
   if ($p['lowerCase'] === true && $p['upperCase'] === true) {
    if (array_key_exists('combineletters', $params) === false || is_bool($params['combineletters']) === false) {
     $p['combineLetters'] = false;
    } else {
     if ($params['combineletters'] === true) {
      $p['combineLetters'] = true;
     } else {
      $p['combineLetters'] = false;
     }
    }
    if (array_key_exists('order', $params) === false || is_string($params['order']) === false || in_array($params['order'], $supportedStringAndArrayOrders) === false) {
     $p['order'] = 'ulul';
    } else {
     $p['order'] = $params['order'];
    }
   }
   if ($p['upperCase'] === true) {
    if (array_key_exists('includeallucletters', $params) === false || is_bool($params['includeallucletters']) === false) {
     $p['includeAllUCLetters'] = true;
    } else {
     if ($params['includeallucletters'] === true) {
      $p['includeAllUCLetters'] = true;
     } else {
      $p['includeAllUCLetters'] = false;
     }
    }
   }
  } else if ($f === self::ALPHABET_TYPE_ASSOC_ARRAY) {
   if (array_key_exists('order', $params) === false || is_string($params['order']) === false || in_array($params['order'], $supportedAssocArrayOrders) === false) {
    $p['order'] = 'ulul';
   } else {
    $p['order'] = $params['order'];
   }
  }
  $result;
  $tmpArray = [];
  if ($f === self::ALPHABET_TYPE_STRING) {
   $result = '';
   if ($p['upperCase'] === false && $p['lowerCase'] === true) {
    $tmpArray = $alphabetLetters['lowerCase'];
   } else if ($p['upperCase'] === true && $p['lowerCase'] === false) {
    $tmpArray = $alphabetLetters['upperCase'];
   } else {
    if ($p['order'] === 'ulul') {
     for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
      $tmpArray[] = $alphabetLetters['upperCase'][$i] ?: '';
      $tmpArray[] = $alphabetLetters['lowerCase'][$i] ?: '';
     }
    } else if ($p['order'] === 'lulu') {
     for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
      $tmpArray[] = $alphabetLetters['lowerCase'][$i] ?: '';
      $tmpArray[] = $alphabetLetters['upperCase'][$i] ?: '';
     }
    } else if ($p['order'] === 'uull') {
     $tmpArray = array_merge($alphabetLetters['upperCase'], $alphabetLetters['lowerCase']);
    } else if ($p['order'] === 'lluu') {
     $tmpArray = array_merge($alphabetLetters['lowerCase'], $alphabetLetters['upperCase']);
    }
   }
   if ($p['includeAllUCLetters'] === false) {
    unset($tmpArray[array_search('Ъ', $tmpArray)]);
    unset($tmpArray[array_search('Ы', $tmpArray)]);
    unset($tmpArray[array_search('Ь', $tmpArray)]);
   }
   $result = implode('', $tmpArray);
  } else if ($f === self::ALPHABET_TYPE_ARRAY) {
   $result = [];
   if ($p['upperCase'] === false && $p['lowerCase'] === true) {
    $tmpArray = $alphabetLetters['lowerCase'];
   } else if ($p['upperCase'] === true && $p['lowerCase'] === false) {
    $tmpArray = $alphabetLetters['upperCase'];
   } else {
    if ($p['order'] === 'ulul') {
     if ($p['combineLetters'] === true) {
      for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
       $tmpArray[] = ($alphabetLetters['upperCase'][$i] ?: '') . ($alphabetLetters['lowerCase'][$i] ?: '');
      }
     } else {
      for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
       $tmpArray[] = $alphabetLetters['upperCase'][$i] ?: '';
       $tmpArray[] = $alphabetLetters['lowerCase'][$i] ?: '';
      }
     }
    } else if ($p['order'] === 'lulu') {
     if ($p['combineLetters'] === true) {
      for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
       $tmpArray[] = ($alphabetLetters['lowerCase'][$i] ?: '') . ($alphabetLetters['upperCase'][$i] ?: '');
      }
     } else {
      for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
       $tmpArray[] = $alphabetLetters['lowerCase'][$i] ?: '';
       $tmpArray[] = $alphabetLetters['upperCase'][$i] ?: '';
      }
     }
    } else if ($p['order'] === 'uull') {
     if ($p['combineLetters'] === true) {
      $tmpArray[] = implode('', $alphabetLetters['upperCase']);
      $tmpArray[] = implode('', $alphabetLetters['lowerCase']);
     } else {
      $tmpArray[] = $alphabetLetters['upperCase'];
      $tmpArray[] = $alphabetLetters['lowerCase'];
     }
    } else if ($p['order'] === 'lluu') {
     if ($p['combineLetters'] === true) {
      $tmpArray[] = implode('', $alphabetLetters['lowerCase']);
      $tmpArray[] = implode('', $alphabetLetters['upperCase']);
     } else {
      $tmpArray[] = $alphabetLetters['lowerCase'];
      $tmpArray[] = $alphabetLetters['upperCase'];
     }
    }
   }
   if ($p['includeAllUCLetters'] === false) {
    unset($tmpArray[array_search('Ъ', $tmpArray)]);
    unset($tmpArray[array_search('Ы', $tmpArray)]);
    unset($tmpArray[array_search('Ь', $tmpArray)]);
   }
   $tmpArray = array_values($tmpArray);
   $result = $tmpArray;
  } else if ($f === self::ALPHABET_TYPE_ASSOC_ARRAY) {
   $result = [];
   if ($p['order'] === 'ulul') {
    for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
     $tmpArray[$alphabetLetters['upperCase'][$i]] = $alphabetLetters['lowerCase'][$i];
    }
   } else if ($p['order'] === 'lulu') {
    for ($i = 0; $i < max(count($alphabetLetters['upperCase']), count($alphabetLetters['lowerCase'])); $i++) {
     $tmpArray[$alphabetLetters['lowerCase'][$i]] = $alphabetLetters['upperCase'][$i];
    }
   }
   $result = $tmpArray;
  }
  return $result;
 }

}

?>