<?php
declare(strict_types=1);

/**
 * Mini "framework" de testes usado por todos os exercicios.
 * Voce NAO precisa alterar este arquivo - so os arquivos de exercicio.
 */

$GLOBALS['__testes'] = ['ok' => 0, 'falhas' => 0];

function titulo(string $texto): void
{
    echo PHP_EOL . str_repeat('=', 62) . PHP_EOL;
    echo '  ' . $texto . PHP_EOL;
    echo str_repeat('=', 62) . PHP_EOL;
}

function formatar($valor): string
{
    if (is_bool($valor)) {
        return $valor ? 'true' : 'false';
    }
    if ($valor === null) {
        return 'null';
    }
    if (is_float($valor)) {
        return rtrim(rtrim(number_format($valor, 4, '.', ''), '0'), '.');
    }
    if (is_string($valor)) {
        return '"' . $valor . '"';
    }
    if (is_array($valor)) {
        $json = json_encode($valor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $json === false ? var_export($valor, true) : $json;
    }
    if (is_object($valor)) {
        return get_class($valor);
    }
    return var_export($valor, true);
}

function saoIguais($esperado, $obtido): bool
{
    if (is_float($esperado) && (is_float($obtido) || is_int($obtido))) {
        return abs($esperado - (float) $obtido) < 0.0001;
    }
    return $esperado === $obtido;
}

/**
 * @param mixed $esperado
 * @param mixed $obtido  Pode ser o valor pronto ou uma funcao anonima:
 *                       verificar('soma', 5, fn() => soma(2, 3));
 */
function verificar(string $descricao, $esperado, $obtido): void
{
    if ($obtido instanceof Closure) {
        try {
            $obtido = $obtido();
        } catch (Throwable $e) {
            $GLOBALS['__testes']['falhas']++;
            echo '  [FALHOU] ' . $descricao . PHP_EOL;
            echo '           erro: ' . get_class($e) . ' - ' . $e->getMessage() . PHP_EOL;
            return;
        }
    }

    if (saoIguais($esperado, $obtido)) {
        $GLOBALS['__testes']['ok']++;
        echo '  [ OK   ] ' . $descricao . PHP_EOL;
        return;
    }

    $GLOBALS['__testes']['falhas']++;
    echo '  [FALHOU] ' . $descricao . PHP_EOL;
    echo '           esperado: ' . formatar($esperado) . PHP_EOL;
    echo '           obtido:   ' . formatar($obtido) . PHP_EOL;
}

/**
 * Verifica que o codigo dentro da funcao anonima lanca uma excecao da classe informada.
 */
function verificarExcecao(string $descricao, string $classeEsperada, Closure $fn): void
{
    try {
        $fn();
    } catch (Throwable $e) {
        if ($e instanceof $classeEsperada) {
            $GLOBALS['__testes']['ok']++;
            echo '  [ OK   ] ' . $descricao . PHP_EOL;
            return;
        }
        $GLOBALS['__testes']['falhas']++;
        echo '  [FALHOU] ' . $descricao . PHP_EOL;
        echo '           esperava excecao ' . $classeEsperada . ', veio ' . get_class($e) . PHP_EOL;
        return;
    }

    $GLOBALS['__testes']['falhas']++;
    echo '  [FALHOU] ' . $descricao . PHP_EOL;
    echo '           nenhuma excecao foi lancada (esperava ' . $classeEsperada . ')' . PHP_EOL;
}

function resumo(): void
{
    $ok = $GLOBALS['__testes']['ok'];
    $falhas = $GLOBALS['__testes']['falhas'];
    echo str_repeat('-', 62) . PHP_EOL;
    if ($falhas === 0) {
        echo "  TUDO CERTO! {$ok} teste(s) passaram. Parabens!" . PHP_EOL . PHP_EOL;
        return;
    }
    echo "  {$ok} passaram / {$falhas} falharam - continue tentando." . PHP_EOL . PHP_EOL;
}
