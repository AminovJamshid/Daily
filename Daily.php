<?php

declare(strict_types=1);

class Daily
{
    const WORK_DURATION = 540; // 9 soat = 540 minut

    public string $date;
    public string $arrivedAt;
    public string $leavedAt;

    public function calculate(
        string $date,
        string $arrivedAt,
        string $leavedAt
    ): void {
        $arrivedAt = DateTime::createFromFormat('H:i:s', $arrivedAt);
        $leavedAt = DateTime::createFromFormat('H:i:s', $leavedAt);

        $dailyWorkingHours = $leavedAt->diff($arrivedAt);

        $workedMinutes = ($dailyWorkingHours->h * 60) + $dailyWorkingHours->i;

        $this->date = $date;
        $this->arrivedAt = $arrivedAt->format('H:i:s');
        $this->leavedAt = $leavedAt->format('H:i:s');

        $workOffMinutes = self::WORK_DURATION - $workedMinutes;
        $workOffHours = floor($workOffMinutes / 60);
        $workOffRemainingMinutes = $workOffMinutes % 60;

        echo "Sana: {$this->date}\n";
        echo "Kelish vaqti: {$this->arrivedAt}\n";
        echo "Ketish vaqti: {$this->leavedAt}\n";
        echo "Ish vaqti davomiyligi: {$dailyWorkingHours->format('%H:%I:%S')}\n";
        echo "Qarzingiz: {$workOffHours} soat va {$workOffRemainingMinutes} daqiqa\n";
    }
}

function prompt($prompt_msg){
    echo($prompt_msg);
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    return trim($line);
}

// Input olish
$date = prompt("Sanani kiriting (YYYY-MM-DD): ");
$arrivedAt = prompt("Kelish vaqtini kiriting (HH:MM:SS): ");
$leavedAt = prompt("Ketish vaqtini kiriting (HH:MM:SS): ");

// Calculate
$today = new Daily();
$today->calculate($date, $arrivedAt, $leavedAt);
