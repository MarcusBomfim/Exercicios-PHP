<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

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
| Rode com:  php medios/06_relatorio_vendas.php
|
*/

function totalPorProduto(array $vendas)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('totalPorProduto() ainda não foi implementada');
}

function produtoMaisVendido(array $vendas)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('produtoMaisVendido() ainda não foi implementada');
}

function resumoPorCategoria(array $vendas)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('resumoPorCategoria() ainda não foi implementada');
}

function formatarMoeda(float $valor)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('formatarMoeda() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

$vendas = [
    ['produto' => 'Teclado', 'categoria' => 'Perifericos', 'quantidade' => 2, 'preco' => 150.0],
    ['produto' => 'Mouse',   'categoria' => 'Perifericos', 'quantidade' => 5, 'preco' => 80.0],
    ['produto' => 'Monitor', 'categoria' => 'Telas',       'quantidade' => 1, 'preco' => 1200.0],
    ['produto' => 'Teclado', 'categoria' => 'Perifericos', 'quantidade' => 3, 'preco' => 150.0],
    ['produto' => 'Cadeira', 'categoria' => 'Moveis',      'quantidade' => 2, 'preco' => 900.0],
    ['produto' => 'Mouse',   'categoria' => 'Perifericos', 'quantidade' => 1, 'preco' => 80.0],
];

titulo('Exercicio 06 - Relatorio de vendas');

verificar(
    'totalPorProduto somado e ordenado (maior -> menor)',
    ['Cadeira' => 1800.0, 'Monitor' => 1200.0, 'Teclado' => 750.0, 'Mouse' => 480.0],
    fn() => totalPorProduto($vendas)
);
verificar('totalPorProduto com lista vazia', [], fn() => totalPorProduto([]));

verificar('produto mais vendido em quantidade', 'Mouse', fn() => produtoMaisVendido($vendas));

verificar(
    'resumoPorCategoria em ordem alfabetica',
    [
        'Moveis'      => ['itens' => 2,  'faturamento' => 1800.0],
        'Perifericos' => ['itens' => 11, 'faturamento' => 1230.0],
        'Telas'       => ['itens' => 1,  'faturamento' => 1200.0],
    ],
    fn() => resumoPorCategoria($vendas)
);

verificar('formatarMoeda(1234.5)', 'R$ 1.234,50', fn() => formatarMoeda(1234.5));
verificar('formatarMoeda(0)', 'R$ 0,00', fn() => formatarMoeda(0.0));
verificar('formatarMoeda(1800)', 'R$ 1.800,00', fn() => formatarMoeda(1800.0));

resumo();
