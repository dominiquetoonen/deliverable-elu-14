<?php

class Log
{

    /**
     * Log errors to an error log.
     *
     * @param string $message
     */
    public static function error(string $message)
    {
        global $db;

        // Log to log file.
        // - datetime
        // - message
    }

    /**
     * Log (save) a search query to database.
     *
     * @param string $string
     * @param int $results
     */
    public static function search(string $string, int $results)
    {
        global $db;

        $data = [
            'string' => $string,
            'results' => $results,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $db->insert('log', $data);
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}