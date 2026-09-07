<?php

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
*/


