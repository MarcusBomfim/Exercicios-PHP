<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 05 (FÁCIL) - Funções, parâmetros padrão e recursão
|--------------------------------------------------------------------------
|
| Conteúdo praticado: criar funções, parâmetro com valor padrão,
| laços e (opcionalmente) recursão.
|
| 1) fatorial(int $n): int
|    fatorial(0) -> 1 | fatorial(5) -> 120
|    Pode ser feito com um laço ou chamando a própria função (recursão).
|
| 2) ehPrimo(int $n): bool
|    Números menores que 2 não são primos.
|    Dica de performance: basta testar divisores até a raiz quadrada de n.
|
| 3) fibonacci(int $quantidade): array
|    Retorna os N primeiros termos começando em 0 e 1.
|    fibonacci(7) -> [0, 1, 1, 2, 3, 5, 8]
|    fibonacci(0) -> []
|
| 4) converterTemperatura(float $valor, string $para = 'F'): float
|    Se $para for 'F', converte de Celsius para Fahrenheit: (C * 9 / 5) + 32
|    Se $para for 'C', converte de Fahrenheit para Celsius: (F - 32) * 5 / 9
|    Arredonde o resultado para 2 casas decimais.
|
*/


function fatorial(int $n): int
{
    $resultado = 1;

    for ($i = 2; $i <= $n; $i++) {
        $resultado *= $i;
    }

    return $resultado;
}

function ehPrimo(int $n): bool
{
    if ($n < 2) {
        return false;
    }

    if ($n % 2 === 0) {
        return $n === 2;
    }

    for ($i = 3; $i * $i <= $n; $i += 2) {
        if ($n % $i === 0) {
            return false;
        }
    }

    return true;
}

function fibonacci(int $quantidade): array
{
    $sequencia = [];

    for ($i = 0; $i < $quantidade; $i++) {
        $sequencia[] = $i < 2 ? $i : $sequencia[$i - 1] + $sequencia[$i - 2];
    }

    return $sequencia;
}

function converterTemperatura(float $valor, string $para = 'F'): float
{
    return match (strtoupper($para)) {
        'F' => round($valor * 9 / 5 + 32, 2),
        'C' => round(($valor - 32) * 5 / 9, 2),
        default => throw new InvalidArgumentException("Unidade invalida: {$para}"),
    };
}


/* --- Demonstracao --- */

echo 'fatorial(5) = ', fatorial(5), PHP_EOL;
echo 'fatorial(10) = ', fatorial(10), PHP_EOL;
echo '97 e primo? ', ehPrimo(97) ? 'sim' : 'nao', PHP_EOL;
echo '9 e primo? ', ehPrimo(9) ? 'sim' : 'nao', PHP_EOL;
echo 'fibonacci(7) = ', implode(', ', fibonacci(7)), PHP_EOL;
echo '37 C = ', converterTemperatura(37.0), ' F', PHP_EOL;
echo '212 F = ', converterTemperatura(212.0, 'C'), ' C', PHP_EOL;
