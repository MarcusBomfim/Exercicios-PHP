<?php
declare(strict_types=1);

/**
 * Roda todos os exercicios de uma vez, cada um em seu proprio processo.
 *
 *   php rodar_todos.php
 */

$arquivos = array_merge(
    glob(__DIR__ . '/faceis/*.php') ?: [],
    glob(__DIR__ . '/medios/*.php') ?: [],
    glob(__DIR__ . '/dificeis/*.php') ?: []
);

foreach ($arquivos as $arquivo) {
    passthru(escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($arquivo));
}
