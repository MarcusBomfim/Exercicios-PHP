<?php

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


