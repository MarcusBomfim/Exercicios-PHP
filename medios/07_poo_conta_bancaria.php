<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 07 (MÉDIO) - POO: classe ContaBancaria
|--------------------------------------------------------------------------
|
| Conteúdo praticado: classes, construtor, encapsulamento (private),
| métodos, exceções e objetos passados como parâmetro.
|
| Implemente a classe ContaBancaria com:
|
|  __construct(string $titular, float $saldoInicial = 0.0)
|      - se $saldoInicial for negativo -> InvalidArgumentException
|
|  getTitular(): string
|  getSaldo(): float
|  getExtrato(): array   (lista de strings, na ordem em que aconteceram)
|
|  depositar(float $valor): void
|      - valor <= 0 -> InvalidArgumentException
|      - soma ao saldo e registra no extrato: "Deposito de 100.00"
|        (use sprintf('Deposito de %.2f', $valor))
|
|  sacar(float $valor): void
|      - valor <= 0 -> InvalidArgumentException
|      - valor maior que o saldo -> SaldoInsuficienteException
|      - subtrai do saldo e registra: "Saque de 30.00"
|
|  transferirPara(ContaBancaria $destino, float $valor): void
|      - usa as regras de sacar/depositar
|      - registra "Transferencia enviada de 50.00" na conta de origem
|        e "Transferencia recebida de 50.00" na conta de destino
|      (não registre também o Saque/Deposito: só as linhas de transferência)
|
| O saldo NÃO pode ser alterado de fora da classe (propriedade private).
|
| Rode com:  php medios/07_poo_conta_bancaria.php
|
*/

class SaldoInsuficienteException extends RuntimeException
{
    // pronta para uso - não precisa alterar
}

class ContaBancaria
{
    // TODO: declare as propriedades (private) e implemente os métodos

    public function __construct(string $titular, float $saldoInicial = 0.0)
    {
        throw new RuntimeException('__construct() ainda não foi implementado');
    }

    public function getTitular()
    {
        throw new RuntimeException('getTitular() ainda não foi implementado');
    }

    public function getSaldo()
    {
        throw new RuntimeException('getSaldo() ainda não foi implementado');
    }

    public function getExtrato()
    {
        throw new RuntimeException('getExtrato() ainda não foi implementado');
    }

    public function depositar(float $valor)
    {
        throw new RuntimeException('depositar() ainda não foi implementado');
    }

    public function sacar(float $valor)
    {
        throw new RuntimeException('sacar() ainda não foi implementado');
    }

    public function transferirPara(ContaBancaria $destino, float $valor)
    {
        throw new RuntimeException('transferirPara() ainda não foi implementado');
    }
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 07 - POO: Conta bancaria');

verificar('titular da conta', 'Marcus', fn() => (new ContaBancaria('Marcus'))->getTitular());
verificar('saldo inicial padrao e 0.0', 0.0, fn() => (new ContaBancaria('Marcus'))->getSaldo());
verificar('saldo inicial informado', 250.0, fn() => (new ContaBancaria('Ana', 250.0))->getSaldo());

verificarExcecao('saldo inicial negativo e recusado', InvalidArgumentException::class, function () {
    new ContaBancaria('Ana', -10.0);
});

verificar('deposito soma ao saldo', 100.0, function () {
    $c = new ContaBancaria('Ana');
    $c->depositar(100.0);
    return $c->getSaldo();
});

verificar('saque subtrai do saldo', 70.0, function () {
    $c = new ContaBancaria('Ana', 100.0);
    $c->sacar(30.0);
    return $c->getSaldo();
});

verificar('extrato registra as operacoes', ['Deposito de 100.00', 'Saque de 30.00'], function () {
    $c = new ContaBancaria('Ana');
    $c->depositar(100.0);
    $c->sacar(30.0);
    return $c->getExtrato();
});

verificarExcecao('deposito de valor zero e recusado', InvalidArgumentException::class, function () {
    (new ContaBancaria('Ana'))->depositar(0.0);
});

verificarExcecao('saque de valor negativo e recusado', InvalidArgumentException::class, function () {
    (new ContaBancaria('Ana', 50.0))->sacar(-5.0);
});

verificarExcecao('saque maior que o saldo e recusado', SaldoInsuficienteException::class, function () {
    (new ContaBancaria('Ana', 50.0))->sacar(50.01);
});

verificar('transferencia debita a origem', 150.0, function () {
    $origem = new ContaBancaria('Ana', 200.0);
    $destino = new ContaBancaria('Bia', 0.0);
    $origem->transferirPara($destino, 50.0);
    return $origem->getSaldo();
});

verificar('transferencia credita o destino', 80.0, function () {
    $origem = new ContaBancaria('Ana', 200.0);
    $destino = new ContaBancaria('Bia', 30.0);
    $origem->transferirPara($destino, 50.0);
    return $destino->getSaldo();
});

verificar('extrato da origem apos transferencia', ['Transferencia enviada de 50.00'], function () {
    $origem = new ContaBancaria('Ana', 200.0);
    $destino = new ContaBancaria('Bia');
    $origem->transferirPara($destino, 50.0);
    return $origem->getExtrato();
});

verificar('extrato do destino apos transferencia', ['Transferencia recebida de 50.00'], function () {
    $origem = new ContaBancaria('Ana', 200.0);
    $destino = new ContaBancaria('Bia');
    $origem->transferirPara($destino, 50.0);
    return $destino->getExtrato();
});

verificarExcecao('transferencia sem saldo e recusada', SaldoInsuficienteException::class, function () {
    (new ContaBancaria('Ana', 10.0))->transferirPara(new ContaBancaria('Bia'), 20.0);
});

resumo();
