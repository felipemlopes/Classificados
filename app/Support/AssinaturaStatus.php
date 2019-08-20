<?php

namespace App\Support;
/**
 * Class Status.
 */
class AssinaturaStatus
{
    const INITIATED = 'INITIATED';
    const PENDING = 'PENDING';
    const ACTIVE = 'ACTIVE';
    const PAYMENT_METHOD_CHANGE = 'PAYMENT_METHOD_CHANGE';
    const SUSPENDED = 'SUSPENDED';
    const CANCELLED = 'CANCELLED';
    const CANCELLED_BY_RECEIVER = 'CANCELLED_BY_RECEIVER';
    const CANCELLED_BY_SENDER = 'CANCELLED_BY_SENDER';
    const EXPIRED = 'EXPIRED';

    //SÓ LIBERA QUANDO PAGA OU DISPONIVEL
}
