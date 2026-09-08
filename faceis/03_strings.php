<?php

declare(strict_types=1);

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
*/


function inverterTexto(string $texto): string
{
    return strrev($texto);
}

function contarVogais(string $texto): int
{
    return (int) preg_match_all('/[aeiou]/i', $texto);
}

function formatarNome(string $nome): string
{
    $limpo = preg_replace('/\s+/', ' ', trim($nome)) ?? '';

    return ucwords(strtolower($limpo));
}

function ehPalindromo(string $texto): bool
{
    $normalizado = strtolower(str_replace(' ', '', $texto));

    return $normalizado === strrev($normalizado);
}


/* --- Demonstracao --- */

echo inverterTexto('PHP e legal'), PHP_EOL;
echo 'vogais em "Programacao": ', contarVogais('Programacao'), PHP_EOL;
echo formatarNome('  maria   da  SILVA '), PHP_EOL;
echo '"Ame a ema" e palindromo? ', ehPalindromo('Ame a ema') ? 'sim' : 'nao', PHP_EOL;
echo '"PHP rocks" e palindromo? ', ehPalindromo('PHP rocks') ? 'sim' : 'nao', PHP_EOL;
