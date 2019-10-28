<?php

namespace App\Drivers;

use App\Socket\BinaryStreamConnection;
use Illuminate\Support\Facades\Log;

class DeviceRequest
{
    public function __construct($connection_params)
    {
        $this->ip = $connection_params['ip'];
        $this->port = $connection_params['port'];
        $this->device_address = $connection_params['device_address'];
        $this->type = $connection_params['connection_type'];
    }

    /**
     * Принимает двоичные HEX данные и 
     * возвращает строку для отображения
     *
     * @param string $str - запакованные hex данные
     * @return string распакованный hex
     */
    private function nice_hex(string $str): string
    {
        // Проверить правильность работы с двумя аргументами
        $unpacked_str = unpack('H*', $str, null)[1];

        return $this->nice_hex_string($unpacked_str);
    }

    /**
     * Разбивает полученный hex по два элемента
     *
     * @param string $str - hex строка
     * @return string - разбитая hex строка
     */
    private function nice_hex_string(string $str): string
    {
        return strtoupper(implode(' ', str_split($str, 2)));
    }

    private function crc_mbus(string $msg): string
    {
        $buffer = pack('H*', $msg);

        $result = 0x0000;

        if (($length = strlen($buffer)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $result ^= (ord($buffer[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($result <<= 1) & 0x10000) $result ^= 0x1021;
                    $result &= 0xFFFF;
                }
            }
        }

        $result = sprintf('%04X', $result);
        return $result;
    }

    /**
     * Определяет совпадение контрольной суммы
     * полученного пакета
     *
     * @param string $answer - полученный ответ, запакованная строка
     * @return boolean
     */
    private function crc_right(string $answer = ''): bool
    {
        $unpacked_answer = unpack('H*', $answer, null)[1];

        $received_crc = strtoupper(substr($unpacked_answer, -4));

        // Необходимо обработать строку для каждого счетчика по-своему
        $clean_answer = substr($unpacked_answer, 2, -4);
        $calculated_crc = $this->crc_mbus($clean_answer);

        return $received_crc === $calculated_crc;
    }

    private function parse_answer(string $data)
    {
        return unpack('H*', $data, null)[1];
    }

    private function make_connection()
    {
        $connection = BinaryStreamConnection::getBuilder()
            ->setProtocol($this->type)
            ->setHost($this->ip)
            ->setPort($this->port)
            ->setTimeoutSec(3.5)
            ->setWriteTimeoutSec(2.5)
            ->build()
            ->connect();

        return $connection;
    }

    /**
     * Метод запроса к устройству
     *
     * @param string $message_command - отправляемая команда
     * @return void|string - ответ устройства
     */
    public function sendAndRecieve(string $message_command)
    {
        Log::channel('meters')->info("Отправляем команду: " . $this->nice_hex($message_command));

        $socket = $this->make_connection();

        $binary_answer = $socket->sendAndReceive($message_command);

        if (empty($binary_answer)) {
            Log::channel('meters')->error("Отсутствует ответ от устройства.");

            return;
        } else if (!$this->crc_right($binary_answer)) {
            Log::channel('meters')->error("Не совпадают контрольные суммы.");

            return;
        } else {
            $answer = $this->parse_answer($binary_answer);

            Log::channel('meters')->info("Получаем ответ: " . $this->nice_hex_string($answer));

            return $answer;
        }
    }
}