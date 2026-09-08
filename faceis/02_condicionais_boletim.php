<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 02 (FÁCIL) - Condicionais (if / elseif / switch)
|--------------------------------------------------------------------------
|
| Conteúdo praticado: if/elseif/else, operadores lógicos, switch/match.
|
| 1) situacaoDoAluno(float $nota): string
|    - nota >= 7.0                -> "Aprovado"
|    - nota >= 5.0 e menor que 7  -> "Recuperacao"
|    - nota < 5.0                 -> "Reprovado"
|    Se a nota for menor que 0 ou maior que 10, retorne "Nota invalida".
|
| 2) ehBissexto(int $ano): bool
|    Um ano é bissexto quando é divisível por 4, EXCETO se for divisível
|    por 100 — a não ser que também seja divisível por 400.
|    2024 -> true | 1900 -> false | 2000 -> true
|
| 3) classificarIdade(int $idade): string
|    0-12  -> "Crianca"
|    13-17 -> "Adolescente"
|    18-59 -> "Adulto"
|    60+   -> "Idoso"
|    Dica: dá para resolver com if/elseif ou com `match(true)` do PHP 8.
|
*/


function situacaoDoAluno(float $nota): string
{
    if ($nota < 0 || $nota > 10) {
        return 'Nota invalida';
    }

    if ($nota >= 7.0) {
        return 'Aprovado';
    }

    if ($nota >= 5.0) {
        return 'Recuperacao';
    }

    return 'Reprovado';
}

function ehBissexto(int $ano): bool
{
    return $ano % 4 === 0 && ($ano % 100 !== 0 || $ano % 400 === 0);
}

function classificarIdade(int $idade): string
{
    return match (true) {
        $idade <= 12 => 'Crianca',
        $idade <= 17 => 'Adolescente',
        $idade <= 59 => 'Adulto',
        default => 'Idoso',
    };
}


/* --- Demonstracao --- */

foreach ([9.5, 6.9, 4.9, 11.0] as $nota) {
    echo 'nota ', $nota, ' -> ', situacaoDoAluno($nota), PHP_EOL;
}

foreach ([2024, 2023, 1900, 2000] as $ano) {
    echo $ano, ' e bissexto? ', ehBissexto($ano) ? 'sim' : 'nao', PHP_EOL;
}

foreach ([5, 15, 30, 60] as $idade) {
    echo $idade, ' anos -> ', classificarIdade($idade), PHP_EOL;
}
