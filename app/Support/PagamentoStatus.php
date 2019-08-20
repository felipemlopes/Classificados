<?php

namespace App\Support;
/**
 * Class Status.
 */
class PagamentoStatus
{
    const AGUARDANDOPAGAMENTO = 1;
    const EMANALISE = 2;
    const PAGO = 3;
    const DISPONIVEL = 4;
    const EMDISPUTA = 5;
    const DEVOLVIDO = 6;
    const CANCELADO = 7;

    //SÓ LIBERA QUANDO PAGA OU DISPONIVEL
}
