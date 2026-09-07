# Exercícios de PHP

10 exercícios de PHP para praticar do básico ao avançado: **5 fáceis, 3 médios
e 2 difíceis**.

Cada arquivo contém apenas o **enunciado**, em um comentário no topo. Você
escreve a solução no próprio arquivo, abaixo do comentário.

## Requisitos

**PHP 8.1 ou superior** (alguns exercícios pedem `match`, `readonly` e
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

```bash
php faceis/01_variaveis_e_tabuada.php
```

## Estrutura

```
.
├── faceis/     exercícios 01 a 05
├── medios/     exercícios 06 a 08
└── dificeis/   exercícios 09 e 10
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
- Cada enunciado traz exemplos de entrada e saída: use-os para testar
  seu código.
- Travou? Procure uma dica, não a resposta pronta.
