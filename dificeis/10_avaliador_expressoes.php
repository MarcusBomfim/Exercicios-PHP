<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 10 (DIFÍCIL) - Avaliador de expressões matemáticas
|--------------------------------------------------------------------------
|
| Você vai escrever, do zero, um mini interpretador de expressões:
| "3 + 4 * 2 / (1 - 5) ^ 2" precisa devolver 3.5 — SEM usar eval().
|
| Conteúdo praticado: parsing caractere a caractere, pilhas (array_push /
| array_pop), precedência de operadores, algoritmo Shunting Yard e
| notação polonesa reversa (RPN).
|
| ------------------------------------------------------------------------
| 1) tokenizar(string $expressao): array
| ------------------------------------------------------------------------
|    Quebra a expressão em uma lista de tokens. Números viram FLOAT,
|    operadores e parênteses viram STRING. Espaços são ignorados.
|
|      tokenizar('1 + 2')      -> [1.0, '+', 2.0]
|      tokenizar('(1.5*2)')    -> ['(', 1.5, '*', 2.0, ')']
|
|    Operadores aceitos: + - * / ^
|    Menos unário: quando o '-' aparece no começo da expressão, logo depois
|    de um operador ou logo depois de '(', ele faz parte do número.
|      tokenizar('-3 + 5')     -> [-3.0, '+', 5.0]
|      tokenizar('2 * -3')     -> [2.0, '*', -3.0]
|    Qualquer outro caractere -> InvalidArgumentException.
|
| ------------------------------------------------------------------------
| 2) paraRPN(array $tokens): array
| ------------------------------------------------------------------------
|    Converte para notação polonesa reversa usando o Shunting Yard:
|      - número: vai direto para a saída;
|      - operador: enquanto o topo da pilha for um operador de precedência
|        MAIOR (ou IGUAL, se o operador atual for associativo à esquerda),
|        desempilhe para a saída; depois empilhe o operador atual;
|      - '(': empilha;
|      - ')': desempilha até achar o '(' correspondente (e descarta o par).
|
|    Precedências: + e - = 1 | * e / = 2 | ^ = 3
|    ^ é associativo à DIREITA (2^3^2 = 2^(3^2) = 512), os outros à esquerda.
|
|      paraRPN(tokenizar('1 + 2 * 3'))    -> [1.0, 2.0, 3.0, '*', '+']
|      paraRPN(tokenizar('(1 + 2) * 3'))  -> [1.0, 2.0, '+', 3.0, '*']
|
|    Parênteses desbalanceados -> InvalidArgumentException.
|
| ------------------------------------------------------------------------
| 3) avaliarRPN(array $rpn): float
| ------------------------------------------------------------------------
|    Percorre os tokens empilhando números; ao achar um operador, tira DOIS
|    números da pilha (cuidado com a ordem: o penúltimo é o da esquerda),
|    calcula e empilha o resultado. No fim sobra um único valor: o resultado.
|    Se sobrar mais de um valor (ou nenhum) -> InvalidArgumentException.
|    Divisão por zero: deixe o PHP lançar DivisionByZeroError naturalmente.
|
| ------------------------------------------------------------------------
| 4) calcular(string $expressao): float
| ------------------------------------------------------------------------
|    Junta as três etapas e devolve o resultado arredondado em 6 casas.
|
| Rode com:  php dificeis/10_avaliador_expressoes.php
|
*/

function tokenizar(string $expressao)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('tokenizar() ainda não foi implementada');
}

function paraRPN(array $tokens)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('paraRPN() ainda não foi implementada');
}

function avaliarRPN(array $rpn)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('avaliarRPN() ainda não foi implementada');
}

function calcular(string $expressao)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('calcular() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 10 - Avaliador de expressoes');

verificar('tokenizar "1 + 2"', [1.0, '+', 2.0], fn() => tokenizar('1 + 2'));
verificar('tokenizar "(1.5*2)"', ['(', 1.5, '*', 2.0, ')'], fn() => tokenizar('(1.5*2)'));
verificar('tokenizar menos unario no inicio', [-3.0, '+', 5.0], fn() => tokenizar('-3 + 5'));
verificar('tokenizar menos unario apos operador', [2.0, '*', -3.0], fn() => tokenizar('2 * -3'));
verificar('tokenizar subtracao normal', [10.0, '-', 4.0], fn() => tokenizar('10 - 4'));

verificarExcecao('caractere invalido', InvalidArgumentException::class, function () {
    tokenizar('2 + a');
});

verificar('RPN de "1 + 2 * 3"', [1.0, 2.0, 3.0, '*', '+'], fn() => paraRPN(tokenizar('1 + 2 * 3')));
verificar('RPN de "(1 + 2) * 3"', [1.0, 2.0, '+', 3.0, '*'], fn() => paraRPN(tokenizar('(1 + 2) * 3')));
verificar('RPN respeita associatividade a direita', [2.0, 3.0, 2.0, '^', '^'], fn() => paraRPN(tokenizar('2 ^ 3 ^ 2')));

verificarExcecao('parentese nao fechado', InvalidArgumentException::class, function () {
    paraRPN(tokenizar('(1 + 2'));
});

verificarExcecao('parentese fechado a mais', InvalidArgumentException::class, function () {
    paraRPN(tokenizar('1 + 2)'));
});

verificar('avaliarRPN simples', 7.0, fn() => avaliarRPN([1.0, 2.0, 3.0, '*', '+']));
verificar('avaliarRPN respeita a ordem da subtracao', 6.0, fn() => avaliarRPN([10.0, 4.0, '-']));

verificarExcecao('RPN sobrando operandos', InvalidArgumentException::class, function () {
    avaliarRPN([1.0, 2.0]);
});

verificar('calcular "1 + 2"', 3.0, fn() => calcular('1 + 2'));
verificar('calcular "2 + 3 * 4"', 14.0, fn() => calcular('2 + 3 * 4'));
verificar('calcular "(2 + 3) * 4"', 20.0, fn() => calcular('(2 + 3) * 4'));
verificar('calcular "10 / 4"', 2.5, fn() => calcular('10 / 4'));
verificar('calcular "2 ^ 3 ^ 2"', 512.0, fn() => calcular('2 ^ 3 ^ 2'));
verificar('calcular "-3 + 5"', 2.0, fn() => calcular('-3 + 5'));
verificar('calcular "3 + 4 * 2 / (1 - 5) ^ 2"', 3.5, fn() => calcular('3 + 4 * 2 / (1 - 5) ^ 2'));
verificar('calcular com decimais', 3.0, fn() => calcular('1.5 * 2'));
verificar('calcular parenteses aninhados', 45.0, fn() => calcular('((2 + 3) * (4 + 5))'));

verificarExcecao('divisao por zero', DivisionByZeroError::class, function () {
    calcular('1 / 0');
});

resumo();
