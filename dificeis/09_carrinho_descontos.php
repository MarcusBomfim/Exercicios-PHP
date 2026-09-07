<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 09 (DIFÍCIL) - Carrinho de compras com regras de desconto
|--------------------------------------------------------------------------
|
| Conteúdo praticado: interfaces, polimorfismo, injeção de dependência,
| composição de objetos e o padrão Strategy (cada desconto é uma classe).
|
| A classe Item já está pronta. Você implementa o Carrinho e as 3 regras
| de desconto, todas seguindo a interface Desconto.
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
| Rode com:  php dificeis/09_carrinho_descontos.php
|
*/

final class Item
{
    // pronta para uso - não precisa alterar
    public function __construct(
        public readonly string $nome,
        public readonly float $preco,
        public readonly int $quantidade
    ) {
        if ($preco < 0 || $quantidade < 1) {
            throw new InvalidArgumentException('Item invalido');
        }
    }

    public function subtotal(): float
    {
        return $this->preco * $this->quantidade;
    }
}

interface Desconto
{
    // pronta para uso - não precisa alterar
    public function nome(): string;

    public function calcular(Carrinho $carrinho): float;
}

class Carrinho
{
    // TODO: propriedades e métodos

    public function adicionar(Item $item)
    {
        throw new RuntimeException('adicionar() ainda não foi implementado');
    }

    public function itens()
    {
        throw new RuntimeException('itens() ainda não foi implementado');
    }

    public function quantidadeTotal()
    {
        throw new RuntimeException('quantidadeTotal() ainda não foi implementado');
    }

    public function subtotal()
    {
        throw new RuntimeException('subtotal() ainda não foi implementado');
    }

    public function aplicarDesconto(Desconto $desconto)
    {
        throw new RuntimeException('aplicarDesconto() ainda não foi implementado');
    }

    public function totalDescontos()
    {
        throw new RuntimeException('totalDescontos() ainda não foi implementado');
    }

    public function resumoDescontos()
    {
        throw new RuntimeException('resumoDescontos() ainda não foi implementado');
    }

    public function total()
    {
        throw new RuntimeException('total() ainda não foi implementado');
    }
}

// TODO: implemente as 3 classes abaixo (todas implementam Desconto)

class DescontoPercentual implements Desconto
{
    public function __construct(float $percentual)
    {
        throw new RuntimeException('DescontoPercentual ainda não foi implementado');
    }

    public function nome(): string
    {
        throw new RuntimeException('nome() ainda não foi implementado');
    }

    public function calcular(Carrinho $carrinho): float
    {
        throw new RuntimeException('calcular() ainda não foi implementado');
    }
}

class DescontoAcimaDe implements Desconto
{
    public function __construct(float $minimo, float $valorFixo)
    {
        throw new RuntimeException('DescontoAcimaDe ainda não foi implementado');
    }

    public function nome(): string
    {
        throw new RuntimeException('nome() ainda não foi implementado');
    }

    public function calcular(Carrinho $carrinho): float
    {
        throw new RuntimeException('calcular() ainda não foi implementado');
    }
}

class DescontoLeve3Pague2 implements Desconto
{
    public function nome(): string
    {
        throw new RuntimeException('nome() ainda não foi implementado');
    }

    public function calcular(Carrinho $carrinho): float
    {
        throw new RuntimeException('calcular() ainda não foi implementado');
    }
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

/** Camiseta 4x50 = 200 | Caneca 1x25 = 25 | Meia 3x10 = 30  => subtotal 255 */
function carrinhoDeTeste(): Carrinho
{
    $carrinho = new Carrinho();
    $carrinho->adicionar(new Item('Camiseta', 50.0, 4));
    $carrinho->adicionar(new Item('Caneca', 25.0, 1));
    $carrinho->adicionar(new Item('Meia', 10.0, 3));

    return $carrinho;
}

titulo('Exercicio 09 - Carrinho com descontos');

verificar('carrinho vazio tem subtotal 0', 0.0, fn() => (new Carrinho())->subtotal());
verificar('subtotal do carrinho', 255.0, fn() => carrinhoDeTeste()->subtotal());
verificar('quantidade total de unidades', 8, fn() => carrinhoDeTeste()->quantidadeTotal());
verificar('quantos itens distintos', 3, fn() => count(carrinhoDeTeste()->itens()));
verificar('sem desconto, total = subtotal', 255.0, fn() => carrinhoDeTeste()->total());

verificar('desconto percentual de 10 por cento', 25.5, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoPercentual(10.0));
    return $c->totalDescontos();
});

verificar('total com 10 por cento de desconto', 229.5, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoPercentual(10.0));
    return $c->total();
});

verificar('desconto fixo acima de 200', 30.0, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoAcimaDe(200.0, 30.0));
    return $c->totalDescontos();
});

verificar('desconto fixo nao se aplica abaixo do minimo', 0.0, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoAcimaDe(300.0, 30.0));
    return $c->totalDescontos();
});

verificar('leve 3 pague 2 (50 da camiseta + 10 da meia)', 60.0, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoLeve3Pague2());
    return $c->totalDescontos();
});

verificar('as tres regras juntas', 115.5, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoPercentual(10.0));
    $c->aplicarDesconto(new DescontoAcimaDe(200.0, 30.0));
    $c->aplicarDesconto(new DescontoLeve3Pague2());
    return $c->totalDescontos();
});

verificar('total com as tres regras', 139.5, function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoPercentual(10.0));
    $c->aplicarDesconto(new DescontoAcimaDe(200.0, 30.0));
    $c->aplicarDesconto(new DescontoLeve3Pague2());
    return $c->total();
});

verificar('resumo traz o nome de cada regra', ['Percentual de 10%' => 25.5, 'Leve 3 pague 2' => 60.0], function () {
    $c = carrinhoDeTeste();
    $c->aplicarDesconto(new DescontoPercentual(10.0));
    $c->aplicarDesconto(new DescontoLeve3Pague2());
    return $c->resumoDescontos();
});

verificar('nome do desconto por valor minimo', 'Acima de 200.00', fn() => (new DescontoAcimaDe(200.0, 30.0))->nome());

verificar('total nunca fica negativo', 0.0, function () {
    $c = new Carrinho();
    $c->adicionar(new Item('Chaveiro', 10.0, 1));
    $c->aplicarDesconto(new DescontoAcimaDe(0.0, 50.0));
    return $c->total();
});

resumo();
