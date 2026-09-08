<?php

declare(strict_types=1);

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


function limparCpf(string $cpf): string
{
    return preg_replace('/\D/', '', $cpf) ?? '';
}

function validarCpf(string $cpf): bool
{
    $digitos = limparCpf($cpf);

    if (strlen($digitos) !== 11) {
        return false;
    }

    if (preg_match('/^(\d)\1{10}$/', $digitos) === 1) {
        return false;
    }

    // A posicao 9 calcula o 1o verificador (pesos 10..2) e a 10 o 2o (pesos 11..2).
    foreach ([9, 10] as $posicao) {
        $soma = 0;
        $peso = $posicao + 1;

        for ($i = 0; $i < $posicao; $i++) {
            $soma += ((int) $digitos[$i]) * ($peso - $i);
        }

        $resto = $soma % 11;
        $verificador = $resto < 2 ? 0 : 11 - $resto;

        if ((int) $digitos[$posicao] !== $verificador) {
            return false;
        }
    }

    return true;
}

function formatarCpf(string $cpf): string
{
    $digitos = limparCpf($cpf);

    if (strlen($digitos) !== 11) {
        throw new InvalidArgumentException('O CPF precisa ter 11 digitos');
    }

    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digitos) ?? $digitos;
}


/* --- Demonstracao --- */

$cpfs = [
    '529.982.247-25',
    '52998224725',
    '123.456.789-09',
    '111.444.777-35',
    '529.982.247-26',
    '111.111.111-11',
    '123',
];

foreach ($cpfs as $cpf) {
    echo str_pad($cpf, 18), validarCpf($cpf) ? 'valido' : 'invalido', PHP_EOL;
}

echo 'formatado: ', formatarCpf('52998224725'), PHP_EOL;

try {
    formatarCpf('123');
} catch (InvalidArgumentException $e) {
    echo 'Erro esperado: ', $e->getMessage(), PHP_EOL;
}
