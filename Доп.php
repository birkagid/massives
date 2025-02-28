<?php
function calculate($expression)
{
  $expression = trim($expression);
  if (is_numeric($expression)) {
    return (float)$expression;
  }
  $opIndex = -1;
  $minPriority = 4;
  $operators = ['+', '-', '*', '/'];
  foreach ($operators as $i => $op) {
    $index = strpos($expression, $op);
    if ($index !== false) {
      $priority = ($op === '+' || $op === '-') ? 1 : 2;
      if ($priority <= $minPriority) {
        $minPriority = $priority;
        $opIndex = $index;
        $operator = $op;
      }
    }
  }
  if ($opIndex === -1){
    return "Error";
  }
  $leftOperand = trim(substr($expression, 0, $opIndex));
  $rightOperand = trim(substr($expression, $opIndex + 1));
  $left = calculate($leftOperand);
  $right = calculate($rightOperand);
  switch ($operator) {
    case '+':
      return $left + $right;
    case '-':
      return $left - $right;
    case '*':
      return $left * $right;
    case '/':
      if ($right === 0) {
        return "Error";
      }
      return $left / $right;
    default:
      return "Error";
  }
}
echo "Введите арифметическое выражение: ";
$expression = readline();
$result = calculate($expression);
if ($result === "Error") {
  echo "Ошибка: " . $result . PHP_EOL;
} else {
  echo "Ответ: " . $result . PHP_EOL;
}
