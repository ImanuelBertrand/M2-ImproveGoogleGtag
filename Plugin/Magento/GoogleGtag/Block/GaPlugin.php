<?php
/**
 * ImproveGoogleGtag - Fixes the Google Analytics4 implementation in Magento_GoogleGtag
 *
 * @category Analytics
 * @package  ImproveGoogleGtag
 * @author   Imanuel Bertrand
 * @license  MIT
 * @link     https://github.com/ImanuelBertrand/ImproveGoogleGtag
 */

namespace Ibertrand\ImproveGoogleGtag\Plugin\Magento\GoogleGtag\Block;

use Magento\GoogleGtag\Block\Ga;

class GaPlugin
{
    /**
     * Magento GoogleGtag doesn't add the currency field to the orders array
     * but only to the top level of the array.
     * The javascript code doesn't read the top level, so the currency isn't
     * transmitted to GA and GA doesn't display revenue for purchases.
     *
     * @param array $orderTrackingData
     *
     * @return array
     */
    private function addCurrencyToOrders(array $orderTrackingData)
    {
        if (empty($orderTrackingData['orders']) || empty($orderTrackingData['currency'])) {
            return $orderTrackingData;
        }

        foreach ($orderTrackingData['orders'] as $key => $order) {
            if (!isset($order['currency'])) {
                $orderTrackingData['orders'][$key]['currency'] = $orderTrackingData['currency'];
            }
        }
        return $orderTrackingData;
    }

    /**
     * @param Ga    $subject
     * @param array $result
     *
     * @return array
     *
     * @see Ga::getOrdersTrackingData
     *
     */
    public function afterGetOrdersTrackingData(Ga $subject, array $result): array
    {
        return $this->addCurrencyToOrders($result);
    }
}
