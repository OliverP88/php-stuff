<?php

class CalculationSegmentDisplay
{
    /**
     * @return string
     */
    public function calculateMostAmountPower(): string
    {

        $array = [
            0 => 6,
            1 => 2,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 3,
            8 => 7,
            9 => 6
        ];

        $period = new DatePeriod(
            new DateTime('00:00'),
            DateInterval::createFromDateString('1 min'),
            new DateTime('23:59')
        );

        $returnMsg = ''; $currentMaxCalculation = 1;
        foreach ($period as $time) {
            $formatTime = $time->format("H:i");
            $calculateTime = $array[$formatTime[0]] + $array[$formatTime[1]] + $array[$formatTime[3]] + $array[$formatTime[4]];

            if ($calculateTime > $currentMaxCalculation) {
                $currentMaxCalculation = $calculateTime;
                $returnMsg = $currentMaxCalculation . ' amount of power  -- for time '. $formatTime;
            }elseif ($calculateTime == $currentMaxCalculation) {
                /* This is a check in case if we have more time with the same amount of power,
                 but we don't have it for this range of time but if we change the time range we can get multiple times.*/
                $returnMsg = $returnMsg . ', ' . $currentMaxCalculation . ' amount of power  -- for time '. $formatTime;
            }
        }

        return $returnMsg;
    }
}

$calculation = new CalculationSegmentDisplay();
echo $calculation->calculateMostAmountPower();
// The result is 26 amount of power  -- for time 08:08.
