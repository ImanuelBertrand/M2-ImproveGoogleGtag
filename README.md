# M2-ImproveGoogleGtag
The core implementation of GoogleAnalytics4 tracking in Magento_GoogleGtag doesn't send the currency for purchase events, so GA would not track the revenue.

## Installation

    $ composer require ibertrand/improve-google-gtag
    $ bin/magento setup:upgrade
    $ bin/magento setup:di:compile
    $ bin/magento setup:static-content:deploy
