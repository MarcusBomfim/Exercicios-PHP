# Exercícios de PHP

10 exercícios de PHP para praticar do básico ao avançado: **5 fáceis, 3 médios
e 2 difíceis**. Cada arquivo é autocontido e traz:

1. o **enunciado** no comentário do topo;
2. as **funções/classes vazias** para preencher (procure por `// TODO`);
3. uma **bateria de testes** no final — não precisa mexer nela.

Enquanto o exercício não está implementado, os testes falham com a mensagem
`ainda não foi implementada`. Quando tudo passa, aparece `TUDO CERTO!`.

```
==============================================================
  Exercicio 01 - Variaveis e tabuada
==============================================================
  [ OK   ] tabuada(3) tem 10 linhas
  [FALHOU] somaAte(5)
           esperado: 15
           obtido:   null
--------------------------------------------------------------
  9 passaram / 1 falharam - continue tentando.
```

## Requisitos

**PHP 8.1 ou superior** (os exercícios usam `match`, `readonly` e
propriedades promovidas no construtor).

```bash
php -v
```

Se ainda não tiver o PHP no Windows: instale o
[XAMPP](https://www.apachefriends.org) e adicione `C:\xampp\php` ao PATH, ou
baixe o ZIP "Thread Safe" em [windows.php.net](https://windows.php.net/download),
extraia em `C:\php` e adicione essa pasta ao PATH.

No VS Code, valem a pena as extensões **PHP Intelephense** e **PHP Debug**.

## Como rodar

Um exercício por vez:

```bash
php faceis/01_variaveis_e_tabuada.php
```

Todos de uma vez:

```bash
php rodar_todos.php
```

## Estrutura

```
.
├── faceis/       exercícios 01 a 05
├── medios/       exercícios 06 a 08
├── dificeis/     exercícios 09 e 10
├── lib/teste.php mini framework de testes usado por todos os arquivos
└── rodar_todos.php
```

## Lista dos exercícios

### Fáceis
| # | Arquivo | Assunto |
|---|---------|---------|
| 01 | `faceis/01_variaveis_e_tabuada.php` | variáveis, operadores, laço `for` |
| 02 | `faceis/02_condicionais_boletim.php` | `if/elseif`, operadores lógicos, `match` |
| 03 | `faceis/03_strings.php` | funções de string, palíndromo |
| 04 | `faceis/04_arrays.php` | `foreach`, `array_filter`, `array_values` |
| 05 | `faceis/05_funcoes.php` | funções, parâmetro padrão, recursão |

### Médios
| # | Arquivo | Assunto |
|---|---------|---------|
| 06 | `medios/06_relatorio_vendas.php` | arrays associativos, agrupamento, ordenação |
| 07 | `medios/07_poo_conta_bancaria.php` | classes, encapsulamento, exceções |
| 08 | `medios/08_validador_cpf.php` | regex, dígitos verificadores, validação |

### Difíceis
| # | Arquivo | Assunto |
|---|---------|---------|
| 09 | `dificeis/09_carrinho_descontos.php` | interfaces, polimorfismo, padrão Strategy |
| 10 | `dificeis/10_avaliador_expressoes.php` | parser, pilha, Shunting Yard, RPN |

## Regras sugeridas

- Resolva na ordem — os difíceis usam o que vem antes.
- Não altere os testes para fazê-los passar. 🙂
- Travou? Procure uma dica, não a resposta pronta.
