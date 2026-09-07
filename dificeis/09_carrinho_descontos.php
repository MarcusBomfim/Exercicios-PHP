<?php

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 09 (DIFÍCIL) - Carrinho de compras com regras de desconto
|--------------------------------------------------------------------------
|
| Conteúdo praticado: interfaces, polimorfismo, injeção de dependência,
| composição de objetos e o padrão Strategy (cada desconto é uma classe).
|
| Você vai criar tudo: a classe Item, a interface Desconto, a classe
| Carrinho e as 3 regras de desconto.
|
| ITEM (nome, preco e quantidade podem ser readonly)
|   __construct(string $nome, float $preco, int $quantidade)
|       - preco negativo ou quantidade menor que 1 -> InvalidArgumentException
|   subtotal(): float   -> preco * quantidade
|
| DESCONTO (interface)
|   nome(): string
|   calcular(Carrinho $carrinho): float   -> quanto descontar, em reais
|
| CARRINHO
|   adicionar(Item $item): void
|   itens(): array                  -> lista dos itens adicionados
|   quantidadeTotal(): int          -> soma das quantidades
|   subtotal(): float               -> soma dos subtotais dos itens
|   aplicarDesconto(Desconto $d): void   -> guarda a regra no carrinho
|   totalDescontos(): float         -> soma do que cada regra calculou (2 casas)
|   resumoDescontos(): array        -> [nome da regra => valor descontado]
|   total(): float                  -> subtotal - totalDescontos, NUNCA negativo
|                                      (arredondado em 2 casas)
|
| REGRAS DE DESCONTO (cada uma implementa Desconto)
|   DescontoPercentual(float $percentual)
|       - desconta o percentual sobre o subtotal do carrinho
|       - nome(): "Percentual de 10%"  -> sprintf('Percentual de %.0f%%', $p)
|
|   DescontoAcimaDe(float $minimo, float $valorFixo)
|       - se o subtotal for >= $minimo, desconta $valorFixo; senão, 0.0
|       - nome(): "Acima de 200.00"    -> sprintf('Acima de %.2f', $minimo)
|
|   DescontoLeve3Pague2()
|       - para CADA item, a cada 3 unidades uma sai de graça:
|         desconto do item = floor(quantidade / 3) * preco
|       - nome(): "Leve 3 pague 2"
|
| Todos os descontos são calculados sobre o subtotal original
| (um desconto não incide sobre o outro).
|
*/


