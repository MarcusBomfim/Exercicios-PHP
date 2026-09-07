<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

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
| Rode com:  php faceis/01_variaveis_e_tabuada.php
|
*/

function tabuada(int $numero)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('tabuada() ainda não foi implementada');
}

function somaAte(int $limite)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('somaAte() ainda não foi implementada');
}

function precoComDesconto(float $preco, float $percentual)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('precoComDesconto() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 01 - Variaveis e tabuada');

verificar('tabuada(3) tem 10 linhas', 10, fn() => count(tabuada(3)));
verificar('primeira linha da tabuada do 3', '3 x 1 = 3', fn() => tabuada(3)[0]);
verificar('ultima linha da tabuada do 3', '3 x 10 = 30', fn() => tabuada(3)[9]);
verificar('quinta linha da tabuada do 7', '7 x 5 = 35', fn() => tabuada(7)[4]);

verificar('somaAte(5)', 15, fn() => somaAte(5));
verificar('somaAte(100)', 5050, fn() => somaAte(100));
verificar('somaAte(0)', 0, fn() => somaAte(0));

verificar('precoComDesconto(100, 10)', 90.0, fn() => precoComDesconto(100.0, 10.0));
verificar('precoComDesconto(59.9, 15)', 50.92, fn() => precoComDesconto(59.9, 15.0));
verificar('precoComDesconto(80, 0)', 80.0, fn() => precoComDesconto(80.0, 0.0));

resumo();
