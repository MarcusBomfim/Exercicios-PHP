<?php

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
*/


