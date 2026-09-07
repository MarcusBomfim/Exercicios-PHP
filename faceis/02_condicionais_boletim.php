<?php

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


