<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 06 (MÉDIO) - Relatório de vendas
|--------------------------------------------------------------------------
|
| Conteúdo praticado: arrays associativos, agrupamento, ordenação
| (arsort, ksort, usort), number_format, foreach com chave => valor.
|
| Cada venda é um array assoc: ['produto', 'categoria', 'quantidade', 'preco']
| O faturamento de uma venda é quantidade * preco.
|
| 1) totalPorProduto(array $vendas): array
|    Retorna produto => faturamento somado, ORDENADO do maior faturamento
|    para o menor (as chaves precisam continuar sendo o nome do produto).
|    Dica: arsort() ordena pelos valores preservando as chaves.
|
| 2) produtoMaisVendido(array $vendas): string
|    Nome do produto com a maior QUANTIDADE somada (não é faturamento).
|
| 3) resumoPorCategoria(array $vendas): array
|    categoria => ['itens' => quantidade somada, 'faturamento' => total]
|    ordenado alfabeticamente pelo nome da categoria (ksort).
|    'itens' deve ser int e 'faturamento' deve ser float.
|
| 4) formatarMoeda(float $valor): string
|    1234.5 -> "R$ 1.234,50"   (ponto para milhar, vírgula para centavos)
|    Dica: number_format($valor, 2, ',', '.')
|
*/


function totalPorProduto(array $vendas): array
{
    $totais = [];

    foreach ($vendas as $venda) {
        $produto = $venda['produto'];
        $totais[$produto] = ($totais[$produto] ?? 0.0) + $venda['quantidade'] * $venda['preco'];
    }

    arsort($totais);

    return $totais;
}

function produtoMaisVendido(array $vendas): string
{
    $quantidades = [];

    foreach ($vendas as $venda) {
        $produto = $venda['produto'];
        $quantidades[$produto] = ($quantidades[$produto] ?? 0) + $venda['quantidade'];
    }

    if ($quantidades === []) {
        throw new InvalidArgumentException('Nenhuma venda informada');
    }

    arsort($quantidades);

    return (string) array_key_first($quantidades);
}

function resumoPorCategoria(array $vendas): array
{
    $resumo = [];

    foreach ($vendas as $venda) {
        $categoria = $venda['categoria'];

        if (!isset($resumo[$categoria])) {
            $resumo[$categoria] = ['itens' => 0, 'faturamento' => 0.0];
        }

        $resumo[$categoria]['itens'] += $venda['quantidade'];
        $resumo[$categoria]['faturamento'] += $venda['quantidade'] * $venda['preco'];
    }

    ksort($resumo);

    return $resumo;
}

function formatarMoeda(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}


/* --- Demonstracao --- */

$vendas = [
    ['produto' => 'Teclado', 'categoria' => 'Perifericos', 'quantidade' => 2, 'preco' => 150.0],
    ['produto' => 'Mouse',   'categoria' => 'Perifericos', 'quantidade' => 5, 'preco' => 80.0],
    ['produto' => 'Monitor', 'categoria' => 'Telas',       'quantidade' => 1, 'preco' => 1200.0],
    ['produto' => 'Teclado', 'categoria' => 'Perifericos', 'quantidade' => 3, 'preco' => 150.0],
    ['produto' => 'Cadeira', 'categoria' => 'Moveis',      'quantidade' => 2, 'preco' => 900.0],
    ['produto' => 'Mouse',   'categoria' => 'Perifericos', 'quantidade' => 1, 'preco' => 80.0],
];

echo 'Faturamento por produto:', PHP_EOL;

foreach (totalPorProduto($vendas) as $produto => $total) {
    echo '  ', str_pad((string) $produto, 10), formatarMoeda($total), PHP_EOL;
}

echo 'Mais vendido (em unidades): ', produtoMaisVendido($vendas), PHP_EOL;
echo 'Resumo por categoria:', PHP_EOL;

foreach (resumoPorCategoria($vendas) as $categoria => $dados) {
    echo '  ', str_pad((string) $categoria, 14), $dados['itens'], ' itens - ', formatarMoeda($dados['faturamento']), PHP_EOL;
}
