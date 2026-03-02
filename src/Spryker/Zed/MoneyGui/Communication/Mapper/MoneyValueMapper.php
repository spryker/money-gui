<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MoneyGui\Communication\Mapper;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;

class MoneyValueMapper implements MoneyValueMapperInterface
{
    public function mapCurrencyTransferToMoneyValueTransfer(
        CurrencyTransfer $currencyTransfer,
        MoneyValueTransfer $moneyValueTransfer
    ): MoneyValueTransfer {
        $moneyValueTransfer->setCurrency($currencyTransfer);
        $moneyValueTransfer->setFkCurrency($currencyTransfer->getIdCurrency());

        return $moneyValueTransfer;
    }
}
