<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 04 (FÁCIL) - Arrays
|--------------------------------------------------------------------------
|
| Conteúdo praticado: foreach e funções de array (count, array_sum, max, min,
| array_filter, array_values, in_array, array_unique).
|
| 1) media(array $numeros): float
|    Média aritmética. Se o array estiver vazio, retorne 0.0.
|    media([2, 4, 6]) -> 4.0
|
| 2) maiorEMenor(array $numeros): array
|    Retorna ['maior' => X, 'menor' => Y].
|    maiorEMenor([3, 9, 1]) -> ['maior' => 9, 'menor' => 1]
|    Com array vazio, retorne ['maior' => null, 'menor' => null].
|
| 3) apenasPares(array $numeros): array
|    Devolve só os números pares, com os índices renumerados a partir de 0.
|    (cuidado: array_filter preserva as chaves - veja array_values)
|    apenasPares([1, 2, 3, 4]) -> [2, 4]
|
| 4) removerDuplicados(array $itens): array
|    Remove valores repetidos mantendo a ordem original e renumerando as
|    chaves. removerDuplicados(['a', 'b', 'a', 'c', 'b']) -> ['a', 'b', 'c']
|
| Rode com:  php faceis/04_arrays.php
|
*/

function media(array $numeros)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('media() ainda não foi implementada');
}

function maiorEMenor(array $numeros)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('maiorEMenor() ainda não foi implementada');
}

function apenasPares(array $numeros)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('apenasPares() ainda não foi implementada');
}

function removerDuplicados(array $itens)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('removerDuplicados() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 04 - Arrays');

verificar('media([2, 4, 6])', 4.0, fn() => media([2, 4, 6]));
verificar('media([7.5, 2.5])', 5.0, fn() => media([7.5, 2.5]));
verificar('media([]) e zero', 0.0, fn() => media([]));

verificar('maiorEMenor([3, 9, 1])', ['maior' => 9, 'menor' => 1], fn() => maiorEMenor([3, 9, 1]));
verificar('maiorEMenor([-5, -2])', ['maior' => -2, 'menor' => -5], fn() => maiorEMenor([-5, -2]));
verificar('maiorEMenor([])', ['maior' => null, 'menor' => null], fn() => maiorEMenor([]));

verificar('apenasPares([1,2,3,4,5,6])', [2, 4, 6], fn() => apenasPares([1, 2, 3, 4, 5, 6]));
verificar('apenasPares([1,3,5])', [], fn() => apenasPares([1, 3, 5]));

verificar('removerDuplicados de letras repetidas', ['a', 'b', 'c'], fn() => removerDuplicados(['a', 'b', 'a', 'c', 'b']));
verificar('removerDuplicados([1,1,1])', [1], fn() => removerDuplicados([1, 1, 1]));

resumo();
