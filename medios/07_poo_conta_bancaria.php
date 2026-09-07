<?php

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


