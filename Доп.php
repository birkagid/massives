<?php
function calculate($expression)
{
  $expression = str_replace(' ', '', $expression);
  $expression = str_split($expression);
  $allowedChars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '+', '-', '*', '/'];
  foreach ($expression as $char) {
    if (!in_array($char, $allowedChars)) {
      return "Error";
    }
  }
  $numbers = [];
  $operators = [];
  $currentNumber = "";
  $isFirstNumber = true;
  foreach ($expression as $char) {
    if (is_numeric($char) || ($char === '-' && $isFirstNumber)) {
      $currentNumber .= $char;
      $isFirstNumber = false;
    } else {
      if (!empty($currentNumber)) {
        $numbers[] = (int)$currentNumber;
        $currentNumber = "";
      }
      $operators[] = $char;
    }
  }
  if (!empty($currentNumber)) {
    $numbers[] = (int)$currentNumber;
  }
  if (count($numbers) > 5 || count($numbers) === 0) return "Error";
  if (count($numbers) !== count($operators) + 1) return "Error";
  $result = $numbers[0];
  for ($i = 0; $i < count($operators); $i++) {
    $operator = $operators[$i];
    $nextNumber = $numbers[$i + 1];
    if ($operator === '+') {
      $result += $nextNumber;
    } else if ($operator === '-') {
      $result -= $nextNumber;
    } else if ($operator === '*') {
      $result *= $nextNumber;
    } else if ($operator === '/') {
      if ($nextNumber === 0) return "Error";
      $result /= $nextNumber;
    }
  }
  return $result;
}
$expressions = ["2+4", "-2+8-4", "abc", "5///5", "5/0"];
foreach ($expressions as $exp) {
  $result = calculate($exp);
  echo $exp . " = ";
  if ($result === "Error") {
    echo "Error" . PHP_EOL;
  } else {
    echo $result . PHP_EOL;
  }
}
