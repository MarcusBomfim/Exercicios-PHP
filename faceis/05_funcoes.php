<?php

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


