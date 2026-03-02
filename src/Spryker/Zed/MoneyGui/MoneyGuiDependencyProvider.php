<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MoneyGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToCurrencyFacadeBridge;
use Spryker\Zed\MoneyGui\Dependency\Facade\MoneyGuiToStoreFacadeBridge;

/**
 * @method \Spryker\Zed\MoneyGui\MoneyGuiConfig getConfig()
 */
class MoneyGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CURRENCY = 'FACADE_CURRENCY';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addCurrencyFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    protected function addCurrencyFacade(Container $container): Container
    {
        $container->set(static::FACADE_CURRENCY, function (Container $container) {
            return new MoneyGuiToCurrencyFacadeBridge($container->getLocator()->currency()->facade());
        });

        return $container;
    }

    protected function addStoreFacade(Container $container): Container
    {
        $container->set(static::FACADE_STORE, function (Container $container) {
            return new MoneyGuiToStoreFacadeBridge($container->getLocator()->store()->facade());
        });

        return $container;
    }
}
