<?php

namespace App\Enum;

enum FieldEnum: string {

    use BaseEnum;

    case id            = 'id';
    case walletId      = 'wallet_id';
    case userId        = 'user_id';
    case code          = 'code';
    case email         = 'email';
    case name          = 'name';
    case phoneNumber   = 'phone_number';
    case label         = 'label';
    case type          = 'type';
    case createdAt     = 'created_at';
    case updatedAt     = 'updated_at';
    case verifiedAt    = 'verified_at';
    case date          = 'date';
    case format        = 'format';
    case username      = 'username';
    case password      = 'password';
    case user          = 'user';
    case authorization = 'authorization';
    case token         = 'token';
    case bearer        = 'bearer';
    case balance       = 'balance';
    case isIncome      = 'is_income';
    case amount        = 'amount';
    case deposit       = 'deposit';
    case transaction   = 'transaction';
    case wallet        = 'wallet';
    case create        = 'create';
    case withdraw      = 'withdraw';
    case transactionId = 'transaction_id';
}
