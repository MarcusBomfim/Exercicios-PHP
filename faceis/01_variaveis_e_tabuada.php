<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 01 (FÁCIL) - Variáveis, operadores e laço for
|--------------------------------------------------------------------------
|
| Conteúdo praticado: tipos escalares, concatenação, laço `for`, arrays.
|
| 1) tabuada(int $numero): array
|    Retorna um array com as 10 linhas da tabuada do número, no formato
|    "3 x 1 = 3". Use um laço `for` de 1 até 10.
|
|    tabuada(3)[0]  ->  "3 x 1 = 3"
|    tabuada(3)[9]  ->  "3 x 10 = 30"
|
| 2) somaAte(int $limite): int
|    Soma todos os números inteiros de 1 até $limite (inclusive).
|    somaAte(5) -> 15   (1+2+3+4+5)
|    somaAte(0) -> 0
|
| 3) precoComDesconto(float $preco, float $percentual): float
|    Aplica um desconto percentual e devolve o novo preço,
|    arredondado para 2 casas decimais (veja a função round()).
|    precoComDesconto(100.0, 10.0) -> 90.0
|    precoComDesconto(59.9, 15.0)  -> 50.92
|
*/


function tabuada(int $numero): array
{
    $linhas = [];

    for ($i = 1; $i <= 10; $i++) {
        $linhas[] = sprintf('%d x %d = %d', $numero, $i, $numero * $i);
    }

    return $linhas;
}

function somaAte(int $limite): int
{
    $total = 0;

    for ($i = 1; $i <= $limite; $i++) {
        $total += $i;
    }

    return $total;
}

function precoComDesconto(float $preco, float $percentual): float
{
    return round($preco - ($preco * $percentual / 100), 2);
}


/* --- Demonstracao: rode com `php faceis/01_variaveis_e_tabuada.php` --- */

echo implode(PHP_EOL, tabuada(3)), PHP_EOL;
echo 'somaAte(5) = ', somaAte(5), PHP_EOL;
echo 'somaAte(100) = ', somaAte(100), PHP_EOL;
echo 'precoComDesconto(100, 10) = ', precoComDesconto(100.0, 10.0), PHP_EOL;
echo 'precoComDesconto(59.9, 15) = ', precoComDesconto(59.9, 15.0), PHP_EOL;
