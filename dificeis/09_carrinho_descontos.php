<?php

declare(strict_types=1);

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




final class Item
{
    public function __construct(
        public readonly string $nome,
        public readonly float $preco,
        public readonly int $quantidade,
    ) {
        if ($preco < 0) {
            throw new InvalidArgumentException('O preco nao pode ser negativo');
        }

        if ($quantidade < 1) {
            throw new InvalidArgumentException('A quantidade precisa ser pelo menos 1');
        }
    }

    public function subtotal(): float
    {
        return $this->preco * $this->quantidade;
    }
}

/*
 * Cada regra de desconto e uma classe propria (padrao Strategy). O carrinho
 * nao sabe como o desconto e calculado: so pede o valor a quem sabe.
 */
interface Desconto
{
    public function nome(): string;

    public function calcular(Carrinho $carrinho): float;
}

final class Carrinho
{
    /** @var Item[] */
    private array $itens = [];

    /** @var Desconto[] */
    private array $descontos = [];

    public function adicionar(Item $item): void
    {
        $this->itens[] = $item;
    }

    /** @return Item[] */
    public function itens(): array
    {
        return $this->itens;
    }

    public function quantidadeTotal(): int
    {
        return array_sum(array_map(
            static fn (Item $item): int => $item->quantidade,
            $this->itens,
        ));
    }

    public function subtotal(): float
    {
        return array_sum(array_map(
            static fn (Item $item): float => $item->subtotal(),
            $this->itens,
        ));
    }

    public function aplicarDesconto(Desconto $desconto): void
    {
        $this->descontos[] = $desconto;
    }

    public function totalDescontos(): float
    {
        return round(array_sum($this->resumoDescontos()), 2);
    }

    /** @return array<string, float> */
    public function resumoDescontos(): array
    {
        $resumo = [];

        foreach ($this->descontos as $desconto) {
            $nome = $desconto->nome();

            /*
             * Duas regras podem devolver o mesmo nome (dois percentuais de 10%,
             * por exemplo). Somando em vez de sobrescrever, o resumo continua
             * batendo com o totalDescontos.
             */
            $resumo[$nome] = round(($resumo[$nome] ?? 0.0) + $desconto->calcular($this), 2);
        }

        return $resumo;
    }

    public function total(): float
    {
        return round(max(0.0, $this->subtotal() - $this->totalDescontos()), 2);
    }
}

final class DescontoPercentual implements Desconto
{
    public function __construct(private readonly float $percentual)
    {
    }

    public function nome(): string
    {
        return sprintf('Percentual de %.0f%%', $this->percentual);
    }

    public function calcular(Carrinho $carrinho): float
    {
        return $carrinho->subtotal() * ($this->percentual / 100);
    }
}

final class DescontoAcimaDe implements Desconto
{
    public function __construct(
        private readonly float $minimo,
        private readonly float $valorFixo,
    ) {
    }

    public function nome(): string
    {
        return sprintf('Acima de %.2f', $this->minimo);
    }

    public function calcular(Carrinho $carrinho): float
    {
        return $carrinho->subtotal() >= $this->minimo ? $this->valorFixo : 0.0;
    }
}

final class DescontoLeve3Pague2 implements Desconto
{
    public function nome(): string
    {
        return 'Leve 3 pague 2';
    }

    public function calcular(Carrinho $carrinho): float
    {
        $desconto = 0.0;

        foreach ($carrinho->itens() as $item) {
            // A cada 3 unidades do mesmo item, uma sai de graca.
            $desconto += intdiv($item->quantidade, 3) * $item->preco;
        }

        return $desconto;
    }
}


/* --- Demonstracao --- */

$carrinho = new Carrinho();
$carrinho->adicionar(new Item('Teclado mecanico', 150.00, 2));
$carrinho->adicionar(new Item('Mouse sem fio', 80.00, 3));
$carrinho->adicionar(new Item('Cabo HDMI', 25.00, 7));

$carrinho->aplicarDesconto(new DescontoPercentual(10));
$carrinho->aplicarDesconto(new DescontoAcimaDe(200.00, 50.00));
$carrinho->aplicarDesconto(new DescontoLeve3Pague2());

echo 'Itens no carrinho:', PHP_EOL;

foreach ($carrinho->itens() as $item) {
    echo sprintf(
        '  %-18s %2dx %8s = %9s',
        $item->nome,
        $item->quantidade,
        number_format($item->preco, 2),
        number_format($item->subtotal(), 2),
    ), PHP_EOL;
}

echo PHP_EOL;
echo 'Quantidade total: ', $carrinho->quantidadeTotal(), PHP_EOL;
echo 'Subtotal:         ', number_format($carrinho->subtotal(), 2), PHP_EOL;

echo PHP_EOL;
echo 'Descontos aplicados:', PHP_EOL;

foreach ($carrinho->resumoDescontos() as $nome => $valor) {
    echo sprintf('  %-20s -%9s', $nome, number_format($valor, 2)), PHP_EOL;
}

echo PHP_EOL;
echo 'Total de descontos: ', number_format($carrinho->totalDescontos(), 2), PHP_EOL;
echo 'Total a pagar:      ', number_format($carrinho->total(), 2), PHP_EOL;


/* O total nunca fica negativo, por maior que seja o desconto. */

$pequeno = new Carrinho();
$pequeno->adicionar(new Item('Caneta', 5.00, 1));
$pequeno->aplicarDesconto(new DescontoAcimaDe(0.00, 100.00));

echo PHP_EOL;
echo 'Carrinho pequeno com desconto maior que o subtotal:', PHP_EOL;
echo '  subtotal ', number_format($pequeno->subtotal(), 2),
    ' - desconto ', number_format($pequeno->totalDescontos(), 2),
    ' = total ', number_format($pequeno->total(), 2), PHP_EOL;


/* --- Erros esperados --- */

echo PHP_EOL;

try {
    new Item('Preco invalido', -1.00, 1);
} catch (InvalidArgumentException $e) {
    echo 'Erro esperado: ', $e->getMessage(), PHP_EOL;
}

try {
    new Item('Quantidade invalida', 10.00, 0);
} catch (InvalidArgumentException $e) {
    echo 'Erro esperado: ', $e->getMessage(), PHP_EOL;
}
