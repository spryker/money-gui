<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MoneyGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\MoneyValueCollectionTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Spryker\Zed\MoneyGui\Communication\Mapper\MoneyValueMapperInterface;
use Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToCurrencyFacadeInterface;

class MoneyCollectionTypeSingleStoreDataProvider extends BaseMoneyCollectionTypeDataProvider implements MoneyCollectionTypeDataProviderInterface
{
    /**
     * @var \Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToCurrencyFacadeInterface
     */
    protected $currencyFacade;

    /**
     * @var \Spryker\Zed\MoneyGui\Communication\Mapper\MoneyValueMapperInterface
     */
    protected $moneyValueMapper;

    /**
     * @param \Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToCurrencyFacadeInterface $currencyFacade
     * @param \Spryker\Zed\MoneyGui\Communication\Mapper\MoneyValueMapperInterface $moneyValueMapper
     */
    public function __construct(MoneyGuiToCurrencyFacadeInterface $currencyFacade, MoneyValueMapperInterface $moneyValueMapper)
    {
        $this->currencyFacade = $currencyFacade;
        $this->moneyValueMapper = $moneyValueMapper;
    }

    /**
     * @return \Generated\Shared\Transfer\MoneyValueCollectionTransfer
     */
    public function getMoneyValuesWithCurrenciesForCurrentStore(): MoneyValueCollectionTransfer
    {
        $moneyValueCollectionTransfer = new MoneyValueCollectionTransfer();

        $storeWithCurrencyTransfer = $this->currencyFacade->getCurrentStoreWithCurrencies();
        foreach ($storeWithCurrencyTransfer->getCurrencies() as $currencyTransfer) {
            $moneyValueCollectionTransfer->addMoneyValue(
                $this->moneyValueMapper->mapCurrencyTransferToMoneyValueTransfer($currencyTransfer, new MoneyValueTransfer()),
            );
        }

        return $moneyValueCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MoneyValueCollectionTransfer $currentFormMoneyValueCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\MoneyValueCollectionTransfer
     */
    public function mergeMissingMoneyValues(MoneyValueCollectionTransfer $currentFormMoneyValueCollectionTransfer): MoneyValueCollectionTransfer
    {
        $existingCurrencyMap = $this->createCurrencyIndexMap($currentFormMoneyValueCollectionTransfer);

        $storeWithCurrencyTransfer = $this->currencyFacade->getCurrentStoreWithCurrencies();
        foreach ($storeWithCurrencyTransfer->getCurrencies() as $currencyTransfer) {
            if (isset($existingCurrencyMap[$currencyTransfer->getIdCurrency()])) {
                continue;
            }

            $currentFormMoneyValueCollectionTransfer->addMoneyValue(
                $this->moneyValueMapper->mapCurrencyTransferToMoneyValueTransfer($currencyTransfer, new MoneyValueTransfer()),
            );
        }

        return $currentFormMoneyValueCollectionTransfer;
    }
}
