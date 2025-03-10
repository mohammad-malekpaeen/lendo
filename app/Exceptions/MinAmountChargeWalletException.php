<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class MinAmountChargeWalletException extends Exception {

	/**
	 * @param Throwable|null $previous
	 */
	public function __construct(?Throwable $previous = null) {
		$message = trans('exception.wallet.minAmountChargeWallet');
		parent::__construct($message, Response::HTTP_NOT_FOUND, $previous);
	}
}
