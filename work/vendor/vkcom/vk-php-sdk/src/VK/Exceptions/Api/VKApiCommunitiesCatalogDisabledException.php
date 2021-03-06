<?php
namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

/**
 */
class VKApiCommunitiesCatalogDisabledException extends VKApiException {

	/**
	 * VKApiCommunitiesCatalogDisabledException constructor.
	 *
	 * @param VkApiError $error
	 */
	public function __construct(VkApiError $error) {
		parent::__construct(1310, 'Catalog is not available for this user', $error);
	}
}
