<?php
namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

/**
 */
class VKApiAccessNoteException extends VKApiException {

	/**
	 * VKApiAccessNoteException constructor.
	 *
	 * @param VkApiError $error
	 */
	public function __construct(VkApiError $error) {
		parent::__construct(181, 'Access to note denied', $error);
	}
}
