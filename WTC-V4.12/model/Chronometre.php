<?php
class Chronometre
{
    private $filename = "prestationDonnees_temp.json";

    public function __construct()
    {
        if (!file_exists($this->filename)) {
            $this->initializeEmptyFile();
        }
    }

    function startTimer()
    {
        $contenuFichier = $this->getFileContent();

        if ($contenuFichier == null) {
            $message = [
                'time_start' => microtime(true),
                'time_accumulated' => 0
            ];
        } else {
            $time_accumulated = $contenuFichier['time_accumulated'];
            $message = [
                'time_start' => microtime(true),
                'time_accumulated' => $time_accumulated
            ];
        }

        $this->fillFile(json_encode($message));
    }

    function pauseTimer()
    {
        $message = $this->getFileContent();

        $execution_time = (microtime(true) - $message['time_start']);
        $message['time_accumulated'] += $execution_time;
        $message['time_start'] = 0;

        $this->fillFile(json_encode($message));
    }

    function stopTimer()
    {
        $seconds = $this->getFileContentInSeconds();
        echo round($seconds, 2);
        $this->initializeEmptyFile();
    }

    function getFileContent()
    {
        return json_decode(file_get_contents($this->filename), true);
    }

    function fillFile($contenuAInserer)
    {
        file_put_contents($this->filename, $contenuAInserer);
    }


    function getFileContentInSeconds()
    {
        $fileContent = $this->getFileContent();

        $startTime = $fileContent['time_start'];
        $accumulatedTime = $fileContent['time_accumulated'];

        if ($startTime == 0 && $accumulatedTime == 0) {
            return 0;
        }

        $countedSeconds = $accumulatedTime;

        if (($startTime != 0) && ($accumulatedTime == 0)) {
            $countedSeconds += (microtime(true) - $startTime);

        } else if (($startTime == 0) && ($accumulatedTime != 0)) {
            $countedSeconds = $accumulatedTime;

        } else if (($startTime != 0) && ($accumulatedTime != 0)) {
            $countedSeconds = (microtime(true) - $startTime) + $accumulatedTime;
        }

        return $countedSeconds;
    }

    function initializeEmptyFile()
    {
        $defaultData = [
            'time_start' => 0,
            'time_accumulated' => 0
        ];
        $this->fillFile(json_encode($defaultData));
    }
}
?>