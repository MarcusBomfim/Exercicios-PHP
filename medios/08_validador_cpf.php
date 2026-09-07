<?php
declare(strict_types=1);
require __DIR__ . '/../lib/teste.php';

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
| Rode com:  php medios/08_validador_cpf.php
|
*/

function limparCpf(string $cpf)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('limparCpf() ainda não foi implementada');
}

function validarCpf(string $cpf)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('validarCpf() ainda não foi implementada');
}

function formatarCpf(string $cpf)
{
    // TODO: escreva seu código aqui
    throw new RuntimeException('formatarCpf() ainda não foi implementada');
}


/* ----------------------- TESTES (não precisa mexer) ----------------------- */

titulo('Exercicio 08 - Validador de CPF');

verificar('limparCpf com mascara', '52998224725', fn() => limparCpf('529.982.247-25'));
verificar('limparCpf com espacos e letras', '12345678909', fn() => limparCpf(' 123 456 789 09 '));

verificar('CPF valido com mascara', true, fn() => validarCpf('529.982.247-25'));
verificar('CPF valido sem mascara', true, fn() => validarCpf('52998224725'));
verificar('CPF valido com digito 0', true, fn() => validarCpf('123.456.789-09'));
verificar('outro CPF valido', true, fn() => validarCpf('111.444.777-35'));

verificar('digito verificador errado', false, fn() => validarCpf('529.982.247-26'));
verificar('todos os digitos iguais', false, fn() => validarCpf('111.111.111-11'));
verificar('zeros', false, fn() => validarCpf('000.000.000-00'));
verificar('curto demais', false, fn() => validarCpf('123'));
verificar('longo demais', false, fn() => validarCpf('529982247250'));
verificar('sem nenhum digito', false, fn() => validarCpf('abcdefghijk'));

verificar('formatarCpf', '529.982.247-25', fn() => formatarCpf('52998224725'));
verificar('formatarCpf ja formatado', '123.456.789-09', fn() => formatarCpf('123.456.789-09'));

verificarExcecao('formatarCpf com tamanho errado', InvalidArgumentException::class, function () {
    formatarCpf('123');
});

resumo();
