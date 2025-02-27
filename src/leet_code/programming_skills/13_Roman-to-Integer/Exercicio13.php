<?php

namespace leet_code;

class Exercicio13
{
    private $map = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];

    private $difference = [
        'I' => 1,
        'X' => 10,
        'C' => 100,
    ];

    private $subtractLogic = [
        'I' => ['V', 'X'],
        'X' => ['L', 'C'],
        'C' => ['D', 'M'],
    ];

    /**
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $romanNumber = str_split($s);
        $value = 0;

        for ($i = 0; $i < count($romanNumber); $i++) {
            $literal = $romanNumber[$i];
            $next = $romanNumber[$i + 1] ?? null;

            if ($this->numberHasTwoLiterals($literal, $next)) {
                $i++;
                $value += $this->map[$next] - $this->difference[$literal];

                continue;
            }

            $value += $this->map[$literal];
        }

        return $value;
    }

    private function numberHasTwoLiterals(string $literal, ?string $next)
    {
        if ($next == null) return false;

        if (!($this->subtractLogic[$literal] ?? false)) return false;

        return in_array($next, $this->subtractLogic[$literal]);
    }
}


$s = 'III';
$s = 'LVIII';
$s = 'MCMXCIV';
echo (new Exercicio13())->romanToInt($s);