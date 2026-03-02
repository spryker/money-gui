<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MoneyGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MoneyGui\Communication\Form\DataProvider\MoneyCollectionTypeAllStoreCurrenciesDataProvider;
use Spryker\Zed\MoneyGui\Communication\Form\DataProvider\MoneyCollectionTypeDataProviderInterface;
use Spryker\Zed\MoneyGui\Communication\Form\DataProvider\MoneyCollectionTypeMultiStoreCollectionDataProvider;
use Spryker\Zed\MoneyGui\Communication\Form\DataProvider\MoneyTypeDataProvider;
use Spryker\Zed\MoneyGui\Communication\Mapper\MoneyValueMapper;
use Spryker\Zed\MoneyGui\Communication\Mapper\MoneyValueMapperInterface;
use Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToCurrencyFacadeInterface;
use Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToStoreFacadeInterface;
use Spryker\Zed\MoneyGui\MoneyGuiDependencyProvider;

/**
 * @method \Spryker\Zed\MoneyGui\MoneyGuiConfig getConfig()
 */
class MoneyGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createMoneyTypeDataProvider(): MoneyTypeDataProvider
    {
        return new MoneyTypeDataProvider($this->getStoreFacade());
    }

    public function createMoneyCollectionTypeMultiStoreCollectionDataProvider(): MoneyCollectionTypeDataProviderInterface
    {
        return new MoneyCollectionTypeMultiStoreCollectionDataProvider(
            $this->getCurrencyFacade(),
            $this->createMoneyValueMapper(),
        );
    }

    public function createMoneyCollectionTypeAllStoreCurrenciesDataProvider(): MoneyCollectionTypeDataProviderInterface
    {
        return new MoneyCollectionTypeAllStoreCurrenciesDataProvider(
            $this->getCurrencyFacade(),
            $this->createMoneyValueMapper(),
        );
    }

    public function createMoneyValueMapper(): MoneyValueMapperInterface
    {
        return new MoneyValueMapper();
    }

    public function getCurrencyFacade(): MoneyGuiToCurrencyFacadeInterface
    {
        return $this->getProvidedDependency(MoneyGuiDependencyProvider::FACADE_CURRENCY);
    }

    public function getStoreFacade(): MoneyGuiToStoreFacadeInterface
    {
        return $this->getProvidedDependency(MoneyGuiDependencyProvider::FACADE_STORE);
    }
}
