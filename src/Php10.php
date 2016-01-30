<?php
/**
 * This file is part of the Nagoya.Php10
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Nagoya\Php10;

class Php10
{
    protected $seets = '';
    protected $start = 1;
    protected $end = null;
    protected $checkAndDeciderMap;

    public function __construct()
    {
        $this->checkAndDeciderMap = [
            '---' => [[$this, 'decide3'], 0],
            '--'  => [[$this, 'decide2'], 0],
            '-'   => [[$this, 'decide1'], 1],
        ];
    }

    public function parseInput($input)
    {
        $temp = explode(':', $input);
        $this->end = $temp[0];
        $this->seets = str_repeat('-', $this->end + 2);

        return $temp[1];
    }

    public function run($input)
    {
        $arrivings = $this->parseInput($input);

        foreach (str_split($arrivings) as $arriving) {
            if (ctype_upper($arriving)) {
                $this->processArriving($arriving);
            } elseif (ctype_lower($arriving)) {
                $this->processLeaving($arriving);
            }

            echo $this->seets . PHP_EOL;
        }

        return $this->output();
    }

    public function processArriving($arriving)
    {
        $index = $this->findSeet();
        if ($index) {
            $this->seets[$index] = $arriving;
        }
    }

    public function processLeaving($leaving)
    {
        $this->seets = str_replace(strtoupper($leaving), '-', $this->seets);
    }

    public function findSeet()
    {
        foreach ($this->checkAndDeciderMap as $checking=>$decider) {
            if (($index = strpos($this->seets, $checking, $decider[1])) === false) continue;

            if ($seet = call_user_func($decider[0], $index)) return $seet;
        }

        return null;
    }

    public function decide3($found)
    {
        return $found + 1;
    }

    public function decide2($found)
    {
        if ($found === 0) return 1;

        return $found;
    }

    public function decide1($found)
    {
        return $found;
    }

    public function output()
    {
        return substr($this->seets, 1, $this->end);
    }
}
