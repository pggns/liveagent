<?php declare(strict_types=1);

namespace QualityUnit;

class LiveAgentApi
{
	const TICKET_ATTRIBUTE_INNEWOROPENSTATE = 'inNewOrOpenState';
	const TICKET_ATTRIBUTE_ENDCHAORCALL = 'endChatOrCall';
	const TICKET_ATTRIBUTE_NOTE = 'note';

	/** @var string */
	protected $apiUrl;

	/** @var string */
	protected $apiKey;

	/**
	 * @param string
	 * @param string
	 */
	public function __construct(string $apiUrl, string $apiKey)
	{
		$this->apiUrl = $apiUrl;
		$this->apiKey = $apiKey;
	}

	/**
	 * List of agents
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getAgents(int $page = 1, int $itemsPerPage = 10, string $sortDir = 'ASC', string $sortField = null, array $filters = [], int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'agents', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * List of online agents with their activity status (A - Available, B - Busy) and open tickets.
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getAgentsActivity(int $page = 1, int $itemsPerPage = 10, string $sortDir = 'ASC', string $sortField = null, array $filters = [], int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'agents/activity', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * Retrieves an agent
	 * @param string
	 * @return \stdClass
	 */
	public function getAgent(string $userId): \stdClass
	{
		return $this->sendRequest('GET', 'agents/' . $userId);
	}

	/**
	 * GGet agent statuses in departments
	 * @param string
	 * @return \stdClass
	 */
	public function getAgentStatus(string $userId): \stdClass
	{
		return $this->sendRequest('GET', 'agents/' . $userId . '/status');
	}

	/**
	 * Bans list
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getBans(int $page = 1, int $itemsPerPage = 10, string $sortDir = 'ASC', string $sortField = null, array $filters = [], int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'bans', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * Get ban item
	 * @param int
	 * @return \stdClass
	 */
	public function getBan(int $bandId): \stdClass
	{
		return $this->sendRequest('GET', 'bans/' . $bandId);
	}

	/**
	 * Gets list of calls
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getCalls(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'calls', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Return the status of call
	 * @param string
	 * @return \stdClass
	 */
	public function getCallStatus(string $callId): \stdClass
	{
		return $this->sendRequest('GET', 'calls/' . $callId . '/status');
	}

	/**
	 * Gets list of canned messages
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getCannedMessages(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'canned_messages', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets canned message
	 * @param string
	 * @return \stdClass
	 */
	public function getCannedMessage(string $cannedMessageId): \stdClass
	{
		return $this->sendRequest('GET', 'canned_messages/' . $cannedMessageId);
	}

	/**
	 * Gets list of chats
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getChats(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'chats', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets list of companies
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getCompanies(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'companies', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Get company by specific id
	 * @param string
	 * @return \stdClass
	 */
	public function getCompany(string $companyId): \stdClass
	{
		return $this->sendRequest('GET', 'companies/' . $companyId);
	}

	/**
	 * Gets list of contacts
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getContacts(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'contacts', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Get contact by specific id
	 * @param string
	 * @return \stdClass
	 */
	public function getContact(string $contactId): \stdClass
	{
		return $this->sendRequest('GET', 'contacts/' . $contactId);
	}

	/**
	 * Gets list of custom buttons
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getCustomButtons(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'custom_buttons', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Get custom button by id
	 * @param string
	 * @return \stdClass
	 */
	public function getCustomButton(string $customButtonId): \stdClass
	{
		return $this->sendRequest('GET', 'custom_buttons/' . $customButtonId);
	}

	/**
	 * Gets list of departments
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getDepartments(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'departments', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Get department by specific id
	 * @param string
	 * @return \stdClass
	 */
	public function getDepartment(string $departmentId): \stdClass
	{
		return $this->sendRequest('GET', 'departments/' . $departmentId);
	}

	/**
	 * Is agent in department
	 * @param string
	 * @param string
	 * @return \stdClass
	 */
	public function getDepartmentAgent(string $departmentId, string $agentId): \stdClass
	{
		return $this->sendRequest('GET', 'departments/' . $departmentId . '/' . $agentId);
	}

	/**
	 * Agent list
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getDevices(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'devices', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Get device departments by department id
	 * @param string
	 * @param string
	 * @return \stdClass
	 */
	public function getDevicesDepartment(string $departmentId): \stdClass
	{
		return $this->sendRequest('GET', 'devices/departments/' . $departmentId);
	}

	/**
	 * Get device by id
	 * @param int
	 * @return \stdClass
	 */
	public function getDevice(int $deviceId): \stdClass
	{
		return $this->sendRequest('GET', 'devices/' . $deviceId);
	}

	/**
	 * Get device departments
	 * @param int
	 * @param string
	 * @return \stdClass
	 */
	public function getDeviceDepartments(int $deviceId, string $departmentId = null): \stdClass
	{
		return $this->sendRequest('GET', 'devices/' . $deviceId . '/departments' . ($departmentId ? '/' . $departmentId : ''));
	}

	/**
	 * Get device departments
	 * @param int
	 * @param string
	 * @return \stdClass
	 */
	public function getDeviceDepartmentsPlan(int $deviceId, string $departmentId): \stdClass
	{
		return $this->sendRequest('GET', 'devices/' . $deviceId . '/departments/' . $departmentId . '/plans');
	}

	/**
	 * Get device department plan
	 * @param int
	 * @param string
	 * @uses LiveAgent::getDeviceDepartmentsPlan() alias
	 * @return \stdClass
	 */
	public function getPlans(int $deviceId, string $departmentId): \stdClass
	{
		return $this->getDeviceDepartmentsPlan($deviceId, $departmentId);
	}

	/**
	 * Filters list
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getFilters(int $page = 1, int $itemsPerPage = 10, string $sortDir = 'ASC', string $sortField = null, array $filters = [], int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'filters', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * Get filter
	 * @param string
	 * @return \stdClass
	 */
	public function getFilter(string $filterId): \stdClass
	{
		return $this->sendRequest('GET', 'filters/' . $filterId);
	}

	/**
	 * Gets list of contact groups
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getGroups(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'groups', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * Get group
	 * @param string
	 * @return \stdClass
	 */
	public function getGroup(string $groupId): \stdClass
	{
		return $this->sendRequest('GET', 'groups/' . $groupId);
	}

	/**
	 * Gets list of mail accounts
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getMailAccounts(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'mail_accounts', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets mail account
	 * @param string
	 * @return \stdClass
	 */
	public function getMailAccount(string $mailAccountId): \stdClass
	{
		return $this->sendRequest('GET', 'mail_accounts/' . $mailAccountId);
	}

	/**
	 * Gets a page visits for user contact id. If elastic search is enabled and it throws exception, error is logged and empty array is returned.
	 * @param string
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getPageVisists(string $contactId, string $sortDir = 'ASC', string $sortField = null, int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'page_visits/' . $contactId . '/contact', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
		]);
	}

	/**
	 * Gets list of available phone numbers
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @param array Additional objects
	 * @return \stdClass
	 */
	public function getPhoneNumbers(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = [], array $additionalObjects = []): \stdClass
	{
		return $this->sendRequest('GET', 'phone_numbers', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
			'additionalObjects' => $additionalObjects,
		]);
	}

	/**
	 * Gets phone number
	 * @param string
	 * @return \stdClass
	 */
	public function getPhoneNumber(string $phoneNumberId): \stdClass
	{
		return $this->sendRequest('GET', 'phone_numbers/' . $phoneNumberId);
	}

	/**
	 * Gets list of available phone devices. Special filters (userId - filter phones available for specified user only)
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getPhones(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'phones', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets phone device (use app for LiveAgent Phone app device and web for web device)
	 * @param string
	 * @return \stdClass
	 */
	public function getPhone(string $phoneId): \stdClass
	{
		return $this->sendRequest('GET', 'phones/' . $phoneId);
	}

	/**
	 * Check that API is responding
	 * @return \stdClass
	 */
	public function getPing(): \stdClass
	{
		return $this->sendRequest('GET', 'ping');
	}

	/**
	 * Gets list of predefined answers
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getPredefinedAnswers(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'predefined_answers', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets phone device (use app for LiveAgent Phone app device and web for web device)
	 * @param string
	 * @return \stdClass
	 */
	public function getPredefinedAnswer(string $predefinedAnswerId): \stdClass
	{
		return $this->sendRequest('GET', 'predefined_answers/' . $predefinedAnswerId);
	}

	/**
	 * Retrieves the batch status and remaining items to process
	 * @param string
	 * @return \stdClass
	 */
	public function getQueueBatch(string $batchId): \stdClass
	{
		return $this->sendRequest('GET', 'queue/batch/' . $batchId);
	}

	/**
	 * Gets list of SLAs
	 * @return \stdClass
	 */
	public function getSlas(): \stdClass
	{
		return $this->sendRequest('GET', 'slas');
	}

	/**
	 * Gets SLA
	 * @param string
	 * @return \stdClass
	 */
	public function getSla(string $levelId): \stdClass
	{
		return $this->sendRequest('GET', 'slas/' . $levelId);
	}

	/**
	 * Gets ticket sla history
	 * @param string
	 * @return \stdClass
	 */
	public function getSlaHistory(string $ticketId): \stdClass
	{
		return $this->sendRequest('GET', 'slas/' . $ticketId . '/history');
	}

	/**
	 * Gets list of tags
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @return \stdClass
	 */
	public function getTags(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null): \stdClass
	{
		return $this->sendRequest('GET', 'tags', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
		]);
	}

	/**
	 * Get tag by tag id
	 * @param string
	 * @return \stdClass
	 */
	public function getTag(string $tagId): \stdClass
	{
		return $this->sendRequest('GET', 'tags/' . $tagId);
	}

	/**
	 * Gets list of tickets
	 * @param int Page to display. Not used if $from is defined.
	 * @param int Results per page. Used only if $page is used.
	 * @param int Result set start. Takes precedence over $page.
	 * @param int Result set end. Used only if $from is used.
	 * @param string Sorting direction ASC or DESC
	 * @param string Sorting field
	 * @param array Filters (array object [ key => value, ... ])
	 * @return \stdClass
	 */
	public function getTickets(int $page = 1, int $itemsPerPage = 10, int $from = null, int $to = null, string $sortDir = 'ASC', string $sortField = null, array $filters = []): \stdClass
	{
		return $this->sendRequest('GET', 'tickets', [
			'_page' => $page,
			'_perPage' => $itemsPerPage,
			'_from' => $from,
			'_to' => $to,
			'_sortDir' => $sortDir,
			'_sortField' => $sortField,
			'_filters' => $filters ? json_encode($filters) : null,
		]);
	}

	/**
	 * Gets ticket
	 * @param string
	 * @return \stdClass
	 */
	public function getTicket(string $ticketId): \stdClass
	{
		return $this->sendRequest('GET', 'tickets/' . $ticketId);
	}

	/**
	 * Gets ticket attribute
	 * @param string
	 * @param string inNewOrOpenState|endChatOrCall|note (use TICKET_ATTRIBUTE_* constants as parameter)
	 * @return \stdClass
	 */
	public function getTicketAttribute(string $ticketId, string $attributeName): \stdClass
	{
		return $this->sendRequest('GET', 'tickets/' . $ticketId . '/attributes/' . $attributeName);
	}

	/**
	 * Gets ticket message groups and messages
	 * @param string
	 * @return \stdClass
	 */
	public function getTicketMessages(string $ticketId): \stdClass
	{
		return $this->sendRequest('GET', 'tickets/' . $ticketId . '/messages');
	}

	/**
	 * Gets ticket SLA
	 * @param string
	 * @return \stdClass
	 */
	public function getTicketSla(string $ticketId): \stdClass
	{
		return $this->sendRequest('GET', 'tickets/' . $ticketId . '/sla');
	}

	/**
	 * Create ticket
	 * @return \stdClass
	 */
	public function createTicket(Ticket $ticket): \stdClass
	{
		return $this->sendRequest('POST', 'tickets', $ticket->toArray());
	}

	/**
	 * Retrieves a user (users)
	 * @param string
	 * @return \stdClass
	 */
	public function getUsers(string $userId): \stdClass
	{
		return $this->sendRequest('GET', 'tags/' . $userId);
	}

    /**
     * Create file
     * @param File $file
     * @return \stdClass
     */
    public function createFile(File $file) : \stdClass
    {
        return $this->sendRequest('POST', 'files', $file->toArray());
    }

    /**
     * @param string
     * @param string
     * @param array
     * @return \stdClass
     */
    protected function sendRequest(string $method, string $type, array $data = []): \stdClass
    {
        $curl = curl_init();

        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->apiUrl . '/' . $type . ($method == 'GET' ? '?' . http_build_query($data) : null),
            CURLOPT_HTTPHEADER => array_merge($this->getCurlHeaderByType($type), ['apikey: ' . $this->apiKey]),
            CURLOPT_CUSTOMREQUEST => $method,
        ];
        if ($type === 'files') {
            $options[CURLOPT_POSTFIELDS] = $data;
        } else {
            $options[CURLOPT_POSTFIELDS] = $method === 'GET' ? [] : json_encode($data);
        }
        curl_setopt_array($curl, $options);

        if (($response = curl_exec($curl)) === false) {
            throw new \RuntimeException(curl_error($curl), curl_errno($curl));
        }

        $json = (object)json_decode($response);
        if (($error = json_last_error()) !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON response.', $error);
        }

        if (($code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) !== 200) {
            throw new \RuntimeException($json->message, $code);
        }

        if (isset($json->response->status) && $json->response->status == 'ERROR') {
            throw new \RuntimeException($json->response->errormessage);
        }

        curl_close($curl);
        return (object)$json;
    }

    /**
     * We need custom header for file uploads.
     * @param string $type
     * @return array
     */
    protected function getCurlHeaderByType(string $type) : array
    {
        $headers = [
            'default' => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
            'files' => [
                'Content-Type: multipart/form-data'
            ]
        ];

        return $headers[$type] ?? $headers['default'];
    }
}
