<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 03 (FÁCIL) - Manipulação de strings
|--------------------------------------------------------------------------
|
| Conteúdo praticado: funções de string nativas do PHP.
| Vale a pena olhar: strrev, strtolower, str_split, trim, ucwords,
| preg_replace, explode/implode, substr_count.
|
| 1) inverterTexto(string $texto): string
|    "PHP e legal" -> "lagel e PHP"
|
| 2) contarVogais(string $texto): int
|    Conta as vogais (a, e, i, o, u), sem diferenciar maiúsculas
|    de minúsculas. "Programacao" -> 5
|
| 3) formatarNome(string $nome): string
|    Remove espaços sobrando no início/fim, transforma vários espaços
|    seguidos em um só e deixa cada palavra com a inicial maiúscula.
|    "  maria   da  SILVA " -> "Maria Da Silva"
|
| 4) ehPalindromo(string $texto): bool
|    Ignora espaços e maiúsculas/minúsculas.
|    "Ame a ema" -> true | "PHP rocks" -> false
|
| Rode com:  php faceis/03_strings.php
|
*/

function inverterTexto(string $texto)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('inverterTexto() ainda não foi implementada');
}

function contarVogais(string $texto)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('contarVogais() ainda não foi implementada');
}

function formatarNome(string $nome)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('formatarNome() ainda não foi implementada');
}

function ehPalindromo(string $texto)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('ehPalindromo() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 03 - Strings');

verificar('inverter "PHP e legal"', 'lagel e PHP', fn() => inverterTexto('PHP e legal'));
verificar('inverter texto vazio', '', fn() => inverterTexto(''));

verificar('vogais de "Programacao"', 5, fn() => contarVogais('Programacao'));
verificar('vogais de "AEIOU"', 5, fn() => contarVogais('AEIOU'));
verificar('vogais de "xyz"', 0, fn() => contarVogais('xyz'));

verificar('formatar "  maria   da  SILVA "', 'Maria Da Silva', fn() => formatarNome('  maria   da  SILVA '));
verificar('formatar "JOAO pedro"', 'Joao Pedro', fn() => formatarNome('JOAO pedro'));

verificar('"Ame a ema" e palindromo', true, fn() => ehPalindromo('Ame a ema'));
verificar('"arara" e palindromo', true, fn() => ehPalindromo('arara'));
verificar('"PHP rocks" nao e palindromo', false, fn() => ehPalindromo('PHP rocks'));

resumo();
