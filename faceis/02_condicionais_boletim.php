<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

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
| Rode com:  php faceis/02_condicionais_boletim.php
|
*/

function situacaoDoAluno(float $nota)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('situacaoDoAluno() ainda não foi implementada');
}

function ehBissexto(int $ano)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('ehBissexto() ainda não foi implementada');
}

function classificarIdade(int $idade)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('classificarIdade() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 02 - Condicionais');

verificar('nota 9.5 -> Aprovado', 'Aprovado', fn() => situacaoDoAluno(9.5));
verificar('nota 7.0 -> Aprovado', 'Aprovado', fn() => situacaoDoAluno(7.0));
verificar('nota 6.9 -> Recuperacao', 'Recuperacao', fn() => situacaoDoAluno(6.9));
verificar('nota 4.9 -> Reprovado', 'Reprovado', fn() => situacaoDoAluno(4.9));
verificar('nota 11 -> Nota invalida', 'Nota invalida', fn() => situacaoDoAluno(11.0));
verificar('nota -1 -> Nota invalida', 'Nota invalida', fn() => situacaoDoAluno(-1.0));

verificar('2024 e bissexto', true, fn() => ehBissexto(2024));
verificar('2023 nao e bissexto', false, fn() => ehBissexto(2023));
verificar('1900 nao e bissexto', false, fn() => ehBissexto(1900));
verificar('2000 e bissexto', true, fn() => ehBissexto(2000));

verificar('5 anos -> Crianca', 'Crianca', fn() => classificarIdade(5));
verificar('15 anos -> Adolescente', 'Adolescente', fn() => classificarIdade(15));
verificar('30 anos -> Adulto', 'Adulto', fn() => classificarIdade(30));
verificar('60 anos -> Idoso', 'Idoso', fn() => classificarIdade(60));

resumo();
