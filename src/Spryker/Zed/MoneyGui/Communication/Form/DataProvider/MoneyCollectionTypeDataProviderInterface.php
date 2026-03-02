<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MoneyGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\MoneyValueCollectionTransfer;

interface MoneyCollectionTypeDataProviderInterface
{
    public function getMoneyValuesWithCurrenciesForCurrentStore(): MoneyValueCollectionTransfer;

    public function mergeMissingMoneyValues(MoneyValueCollectionTransfer $currentFormMoneyValueCollectionTransfer): MoneyValueCollectionTransfer;
}
