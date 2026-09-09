<?php

declare(strict_types=1);

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




/** Precedencia de cada operador: quanto maior, mais cedo ele e aplicado. */
const PRECEDENCIAS = ['+' => 1, '-' => 1, '*' => 2, '/' => 2, '^' => 3];

/** Só o '^' associa a direita: 2^3^2 e 2^(3^2), nao (2^3)^2. */
const ASSOCIATIVOS_A_DIREITA = ['^' => true];


/**
 * Quebra a expressao em tokens: numeros viram float, o resto vira string.
 *
 * @return list<float|string>
 */
function tokenizar(string $expressao): array
{
    $tokens = [];
    $posicao = 0;
    $tamanho = strlen($expressao);

    while ($posicao < $tamanho) {
        $caractere = $expressao[$posicao];

        if ($caractere === ' ') {
            $posicao++;
            continue;
        }

        if ($caractere === '(' || $caractere === ')') {
            $tokens[] = $caractere;
            $posicao++;
            continue;
        }

        if (ctype_digit($caractere) || $caractere === '.') {
            $tokens[] = lerNumero($expressao, $posicao);
            continue;
        }

        if (isset(PRECEDENCIAS[$caractere])) {
            /*
             * O '-' e unario quando nao ha nada antes dele que possa ser o lado
             * esquerdo de uma subtracao: no inicio da expressao, depois de outro
             * operador ou depois de '('. Nesses casos ele faz parte do numero.
             */
            if ($caractere === '-' && ehInicioDeOperando($tokens)) {
                $posicao++;
                $tokens[] = -lerNumero($expressao, $posicao);
                continue;
            }

            $tokens[] = $caractere;
            $posicao++;
            continue;
        }

        throw new InvalidArgumentException(
            sprintf('Caractere invalido na posicao %d: "%s"', $posicao, $caractere)
        );
    }

    return $tokens;
}

/**
 * Diz se o proximo token precisa ser um operando, e nao um operador binario:
 * lista vazia, ou o token anterior e um operador ou um '(' .
 *
 * @param list<float|string> $tokens
 */
function ehInicioDeOperando(array $tokens): bool
{
    if ($tokens === []) {
        return true;
    }

    $anterior = $tokens[array_key_last($tokens)];

    return is_string($anterior) && $anterior !== ')';
}

/**
 * Le um numero a partir de $posicao e avança o cursor. Recebe a posicao por
 * referencia porque quem chama precisa saber onde o numero terminou.
 */
function lerNumero(string $expressao, int &$posicao): float
{
    $inicio = $posicao;
    $numero = '';
    $pontos = 0;
    $tamanho = strlen($expressao);

    while ($posicao < $tamanho) {
        $caractere = $expressao[$posicao];

        if ($caractere === '.') {
            $pontos++;
        } elseif (!ctype_digit($caractere)) {
            break;
        }

        $numero .= $caractere;
        $posicao++;
    }

    if ($numero === '' || $numero === '.' || $pontos > 1) {
        throw new InvalidArgumentException(
            sprintf('Numero invalido na posicao %d', $inicio)
        );
    }

    return (float) $numero;
}


/**
 * Shunting Yard: converte a notacao normal para polonesa reversa, resolvendo
 * precedencia e parenteses de uma passada so.
 *
 * @param  list<float|string> $tokens
 * @return list<float|string>
 */
function paraRPN(array $tokens): array
{
    $saida = [];
    $pilha = [];

    foreach ($tokens as $token) {
        if (is_float($token)) {
            $saida[] = $token;
            continue;
        }

        if ($token === '(') {
            $pilha[] = $token;
            continue;
        }

        if ($token === ')') {
            while (($topo = array_pop($pilha)) !== null && $topo !== '(') {
                $saida[] = $topo;
            }

            if ($topo === null) {
                throw new InvalidArgumentException('Parentese fechado sem o correspondente aberto');
            }

            continue;
        }

        while ($pilha !== []) {
            $topo = $pilha[array_key_last($pilha)];

            if ($topo === '(' || !desempilhaAntes($token, $topo)) {
                break;
            }

            $saida[] = array_pop($pilha);
        }

        $pilha[] = $token;
    }

    while (($topo = array_pop($pilha)) !== null) {
        if ($topo === '(') {
            throw new InvalidArgumentException('Parentese aberto sem o correspondente fechado');
        }

        $saida[] = $topo;
    }

    return $saida;
}

/**
 * O operador do topo sai antes do atual quando tem precedencia maior, ou igual
 * com o atual associando a esquerda.
 */
function desempilhaAntes(string $atual, string $topo): bool
{
    $precedenciaAtual = PRECEDENCIAS[$atual];
    $precedenciaTopo = PRECEDENCIAS[$topo];

    if ($precedenciaTopo > $precedenciaAtual) {
        return true;
    }

    return $precedenciaTopo === $precedenciaAtual
        && !isset(ASSOCIATIVOS_A_DIREITA[$atual]);
}


/**
 * Percorre a RPN com uma pilha: numero empilha, operador consome dois.
 *
 * @param list<float|string> $rpn
 */
function avaliarRPN(array $rpn): float
{
    $pilha = [];

    foreach ($rpn as $token) {
        if (is_float($token)) {
            $pilha[] = $token;
            continue;
        }

        if (count($pilha) < 2) {
            throw new InvalidArgumentException(
                sprintf('Faltam operandos para o operador "%s"', $token)
            );
        }

        // Sai de tras para frente: o ultimo empilhado e o lado direito.
        $direita = array_pop($pilha);
        $esquerda = array_pop($pilha);

        // Em PHP o '^' e XOR de inteiros; a potenciacao e '**'.
        $pilha[] = match ($token) {
            '+' => $esquerda + $direita,
            '-' => $esquerda - $direita,
            '*' => $esquerda * $direita,
            '/' => $esquerda / $direita,
            '^' => $esquerda ** $direita,
        };
    }

    if (count($pilha) !== 1) {
        throw new InvalidArgumentException('A expressao nao resulta em um unico valor');
    }

    return (float) $pilha[0];
}


function calcular(string $expressao): float
{
    return round(avaliarRPN(paraRPN(tokenizar($expressao))), 6);
}


/* --- Demonstracao --- */

/** Mostra os tokens na mesma notacao do enunciado: floats com casa decimal. */
function mostrarTokens(array $tokens): string
{
    $partes = array_map(
        static fn (float|string $token): string => is_float($token)
            ? var_export($token, true)
            : "'{$token}'",
        $tokens,
    );

    return '[' . implode(', ', $partes) . ']';
}

$exemplo = '3 + 4 * 2 / (1 - 5) ^ 2';

echo 'Expressao: ', $exemplo, PHP_EOL;
echo '  tokens: ', mostrarTokens(tokenizar($exemplo)), PHP_EOL;
echo '  RPN:    ', mostrarTokens(paraRPN(tokenizar($exemplo))), PHP_EOL;
echo '  valor:  ', calcular($exemplo), PHP_EOL;

echo PHP_EOL;

$casos = [
    '1 + 2'                   => 3.0,
    '1 + 2 * 3'               => 7.0,
    '(1 + 2) * 3'             => 9.0,
    '(1.5*2)'                 => 3.0,
    '2 ^ 3 ^ 2'               => 512.0,
    '(2 ^ 3) ^ 2'             => 64.0,
    '-3 + 5'                  => 2.0,
    '2 * -3'                  => -6.0,
    '10 / 4'                  => 2.5,
    '3 + 4 * 2 / (1 - 5) ^ 2' => 3.5,
];

foreach ($casos as $expressao => $esperado) {
    $obtido = calcular($expressao);
    $situacao = abs($obtido - $esperado) < 0.000001 ? 'ok' : 'FALHOU';

    echo sprintf('  %-26s = %-10s %s', $expressao, $obtido, $situacao), PHP_EOL;
}


/* --- Erros esperados --- */

echo PHP_EOL;

$invalidas = ['2 +', '(1 + 2', '1 + 2)', '2 & 3', '1 2 3', '1.2.3'];

foreach ($invalidas as $expressao) {
    try {
        calcular($expressao);
        echo sprintf('  %-10s deveria ter falhado', $expressao), PHP_EOL;
    } catch (InvalidArgumentException $e) {
        echo sprintf('  %-10s -> %s', $expressao, $e->getMessage()), PHP_EOL;
    }
}

try {
    calcular('1 / 0');
} catch (DivisionByZeroError $e) {
    echo sprintf('  %-10s -> %s', '1 / 0', $e->getMessage()), PHP_EOL;
}
