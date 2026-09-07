<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

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
| Rode com:  php faceis/05_funcoes.php
|
*/

function fatorial(int $n)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('fatorial() ainda não foi implementada');
}

function ehPrimo(int $n)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('ehPrimo() ainda não foi implementada');
}

function fibonacci(int $quantidade)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('fibonacci() ainda não foi implementada');
}

function converterTemperatura(float $valor, string $para = 'F')
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('converterTemperatura() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 05 - Funcoes');

verificar('fatorial(0)', 1, fn() => fatorial(0));
verificar('fatorial(1)', 1, fn() => fatorial(1));
verificar('fatorial(5)', 120, fn() => fatorial(5));
verificar('fatorial(10)', 3628800, fn() => fatorial(10));

verificar('1 nao e primo', false, fn() => ehPrimo(1));
verificar('2 e primo', true, fn() => ehPrimo(2));
verificar('9 nao e primo', false, fn() => ehPrimo(9));
verificar('97 e primo', true, fn() => ehPrimo(97));

verificar('fibonacci(7)', [0, 1, 1, 2, 3, 5, 8], fn() => fibonacci(7));
verificar('fibonacci(1)', [0], fn() => fibonacci(1));
verificar('fibonacci(0)', [], fn() => fibonacci(0));

verificar('0 C -> 32 F', 32.0, fn() => converterTemperatura(0.0));
verificar('37 C -> 98.6 F', 98.6, fn() => converterTemperatura(37.0, 'F'));
verificar('212 F -> 100 C', 100.0, fn() => converterTemperatura(212.0, 'C'));

resumo();
