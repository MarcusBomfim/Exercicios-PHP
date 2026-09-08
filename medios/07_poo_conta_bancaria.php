<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 07 (MÉDIO) - POO: classe ContaBancaria
|--------------------------------------------------------------------------
|
| Conteúdo praticado: classes, construtor, encapsulamento (private),
| métodos, exceções e objetos passados como parâmetro.
|
| Crie a exceção SaldoInsuficienteException (extends RuntimeException) e a
| classe ContaBancaria com:
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
*/


class SaldoInsuficienteException extends RuntimeException
{
}

class ContaBancaria
{
    private float $saldo;

    /** @var string[] */
    private array $extrato = [];

    public function __construct(private string $titular, float $saldoInicial = 0.0)
    {
        if ($saldoInicial < 0) {
            throw new InvalidArgumentException('O saldo inicial nao pode ser negativo');
        }

        $this->saldo = $saldoInicial;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getExtrato(): array
    {
        return $this->extrato;
    }

    public function depositar(float $valor): void
    {
        $this->creditar($valor);

        $this->extrato[] = sprintf('Deposito de %.2f', $valor);
    }

    public function sacar(float $valor): void
    {
        $this->debitar($valor);

        $this->extrato[] = sprintf('Saque de %.2f', $valor);
    }

    public function transferirPara(ContaBancaria $destino, float $valor): void
    {
        $this->debitar($valor);
        $destino->creditar($valor);

        $this->extrato[] = sprintf('Transferencia enviada de %.2f', $valor);
        $destino->extrato[] = sprintf('Transferencia recebida de %.2f', $valor);
    }

    private function creditar(float $valor): void
    {
        $this->exigirValorPositivo($valor);

        $this->saldo += $valor;
    }

    private function debitar(float $valor): void
    {
        $this->exigirValorPositivo($valor);

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException(
                sprintf('Saldo insuficiente: disponivel %.2f, pedido %.2f', $this->saldo, $valor)
            );
        }

        $this->saldo -= $valor;
    }

    private function exigirValorPositivo(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidArgumentException('O valor precisa ser maior que zero');
        }
    }
}


/* --- Demonstracao --- */

$ana = new ContaBancaria('Ana', 200.0);
$bia = new ContaBancaria('Bia');

$ana->depositar(100.0);
$ana->sacar(30.0);
$ana->transferirPara($bia, 50.0);

foreach ([$ana, $bia] as $conta) {
    echo $conta->getTitular(), ' - saldo ', number_format($conta->getSaldo(), 2), PHP_EOL;

    foreach ($conta->getExtrato() as $linha) {
        echo '  ', $linha, PHP_EOL;
    }
}

try {
    $bia->sacar(1000.0);
} catch (SaldoInsuficienteException $e) {
    echo 'Erro esperado: ', $e->getMessage(), PHP_EOL;
}

try {
    $ana->depositar(0.0);
} catch (InvalidArgumentException $e) {
    echo 'Erro esperado: ', $e->getMessage(), PHP_EOL;
}
