<?php

/*
|--------------------------------------------------------------------------
| EXERCÍCIO 08 (MÉDIO) - Validador de CPF
|--------------------------------------------------------------------------
|
| Conteúdo praticado: expressões regulares, laços com índice, aritmética
| modular, validação de entrada.
|
| 1) limparCpf(string $cpf): string
|    Deixa só os dígitos. "529.982.247-25" -> "52998224725"
|    Dica: preg_replace('/\D/', '', $cpf)
|
| 2) validarCpf(string $cpf): bool
|    Aceita com ou sem máscara. Retorna false se:
|      - não tiver exatamente 11 dígitos;
|      - todos os dígitos forem iguais (ex.: 111.111.111-11);
|      - os dígitos verificadores não baterem.
|
|    COMO CALCULAR OS DÍGITOS VERIFICADORES:
|      1º dígito: multiplique os 9 primeiros dígitos pelos pesos 10, 9, 8 ...
|                 até 2, some tudo e faça `resto = soma % 11`.
|                 Se resto < 2 o dígito é 0, senão é 11 - resto.
|      2º dígito: mesma coisa, mas usando os 10 primeiros dígitos
|                 (incluindo o 1º verificador) com pesos 11, 10, 9 ... até 2.
|
| 3) formatarCpf(string $cpf): string
|    "52998224725" -> "529.982.247-25"
|    Se não tiver 11 dígitos, lance InvalidArgumentException.
|
*/


