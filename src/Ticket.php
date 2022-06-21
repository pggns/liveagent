<?php declare(strict_types=1);

namespace Pggns\LiveAgent;

class Ticket {
    const STATUS_ANSWERED = 'A';
    const STATUS_CALLING = 'P';
    const STATUS_CHATTING = 'T';
    const STATUS_DELETED = 'X';
    const STATUS_SPAM = 'B';
    const STATUS_INIT = 'I';
    const STATUS_OPEN = 'C';
    const STATUS_RESOLVED = 'R';
    const STATUS_NEW = 'N';
    const STATUS_POSTPONED = 'W';

    /** @var string */
    protected $subject;

    /** @var string */
    protected $message;

    /** @var string */
    protected $recipient;

    /** @var string */
    protected $recipientName;

    /** @var string */
    protected $userIdentifier;

    /** @var string */
    protected $departmentId;

    /** @var array */
    protected $attachments = [];

    /** @var string */
    protected $status = self::STATUS_INIT;

    /** @var string */
    protected $cc;

    /** @var \DateTime */
    protected $dateCreated;

    /** @var string */
    protected $mailMessageId;

    /** @var bool */
    protected $isHtmlMessage = true;

    /** @var bool */
    protected $doNotSendEmail = true;

    /** @var bool */
    protected $useTemplate = true;

    /** @var array */
    protected $customFields = [];

    /** @var array */
    protected $tags = [];

    /**
     * @param string Message subject
     * @param string Message body
     * @param string Recipient email. If useridentifier is visitor, recipient must be LiveAgent mail account. If useridentifier is agent, recipient must be visitor.
     * @param string Ticket creator identifier - can be userid or email of an existing agent or visitor. It can not be email of a LiveAgent mail account.
     * @param string Department identifier - id of the department (not its name)
     */
    public function __construct(string $subject, string $message, string $recipient, string $userIdentifier, string $departmentId = 'default') {
        $this->setSubject($subject);
        $this->setMessage($message);
        $this->setRecipient($recipient);
        $this->setUserIdentifier($userIdentifier);
        $this->setDepartmentId($departmentId);
    }

    /**
     * @return string
     */
    public function getSubject(): string {
        return $this->subject;
    }

    /**
     * @param string Message subject
     * @return self
     */
    public function setSubject(string $subject): self {
        $this->subject = (string) $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * @param string Message body
     * @return self
     */
    public function setMessage(string $message): self {
        $this->message = (string) $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient(): string {
        return $this->recipient;
    }

    /**
     * @param string Recipient email. If useridentifier is visitor, recipient must be LiveAgent mail account. If useridentifier is agent, recipient must be visitor.
     * @return self
     */
    public function setRecipient(string $recipient): self {
        $this->recipient = (string) $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientName(): ?string {
        return $this->recipientName;
    }

    /**
     * @param string
     * @return self
     */
    public function setRecipientName(string $recipientName = null): self {
        $this->recipientName = $recipientName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserIdentifier(): string {
        return $this->userIdentifier;
    }

    /**
     * @param string Ticket creator identifier - can be userid or email of an existing agent or visitor. It can not be email of a LiveAgent mail account.
     * @return self
     */
    public function setUserIdentifier(string $userIdentifier): self {
        $this->userIdentifier = (string) $userIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartmentId(): string {
        return $this->departmentId;
    }

    /**
     * @param string Department identifier - id of the department (not its name)
     * @return self
     */
    public function setDepartmentId(string $departmentId): self {
        $this->departmentId = (string) $departmentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string {
        return $this->status;
    }

    /**
     * @param string
     * @return self
     */
    public function setStatus(string $status): self {
        $this->status = (string) $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments(): array {
        return array_keys($this->attachments);
    }

    /**
     * @param string
     * @return self
     */
    public function setAttachments(array $attachments = []): self {
        $this->attachments = $attachments ? array_flip($attachments) : [];
        return $this;
    }

    /**
     * @param string
     * @return self
     */
    public function addAttachment(string $attachment): self {
        $this->attachments[$attachment] = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getCc(): ?string {
        return $this->cc;
    }

    /**
     * @param string
     * @return self
     */
    public function setCc(string $cc = null): self {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): ?\DateTime {
        return $this->dateCreated;
    }

    /**
     * @param string
     * @return self
     */
    public function setDateCreated(\DateTime $dateCreated = null): self {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailMessageId(): ?string {
        return $this->mailMessageId;
    }

    /**
     * @param string
     * @return self
     */
    public function setMailMessageId(string $messageId = null): self {
        $this->mailMessageId = $messageId;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsHtmlMessage(): bool {
        return $this->isHtmlMessage;
    }

    /**
     * @param bool
     * @return self
     */
    public function setIsHtmlMessage(bool $isHtmlMessage): self {
        $this->isHtmlMessage = $isHtmlMessage;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDoNotSendEmail(): bool {
        return $this->doNotSendEmail;
    }

    /**
     * @param bool
     * @return self
     */
    public function setDoNotSendEmail(bool $doNotSendEmail): self {
        $this->doNotSendEmail = $doNotSendEmail;
        return $this;
    }

    /**
     * @return bool
     */
    public function getUseTemplate(): bool {
        return $this->useTemplate;
    }

    /**
     * @param bool
     * @return self
     */
    public function setUseTemplate(bool $useTemplate): self {
        $this->useTemplate = $useTemplate;
        return $this;
    }

    /**
     * @return array
     */
    public function getCustomFields(): array {
        return $this->customFields;
    }

    /**
     * @param array
     * @return self
     */
    public function setCustomFields(array $customFields): self {
        foreach($customFields AS $key => $value) {
            $this->setCustomField($key, $value);
        }
        return $this;
    }

    /**
     * @param string
     * @param string
     * @return self
     */
    public function setCustomField(string $key, string $value = null): self {
        if($value !== null) {
            $this->customFields[$key] = $value;
        } else {
            unset($this->customFields[$key]);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array {
        return array_keys($this->tags);
    }

    /**
     * @param array
     * @return self
     */
    public function setTags(array $tags = []): self {
        $this->tags = array_flip($tags);
        return $this;
    }

    /**
     * @param string
     * @return self
     */
    public function addTag(string $tag): self {
        $this->tags[$tag] = true;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        // required
        $data = [
            'subject' => $this->getSubject(),
            'message' => $this->getMessage(),
            'recipient' => $this->getRecipient(),
            'useridentifier' => $this->getUserIdentifier(),
            'departmentid' => $this->getDepartmentId(),
        ];

        $optional_data = [
            'attachments' => $this->attachments ? implode(',', $this->getAttachments()) : null,
            'carbon_copy' => $this->getCc(),
            'date_created' => $this->dateCreated ? $this->getDateCreated()->format('r') : null,
            'do_not_send_mail' => $this->doNotSendEmail ? 'Y' : 'N',
            'is_html_message' => $this->isHtmlMessage ? 'Y' : 'N',
            'mail_message_id' => $this->getMailMessageId(),
            'recipient_name' => $this->getRecipientName(),
            'status' => $this->getStatus(),
            'tags' => $this->tags ? $this->getTags() : null,
            'use_template' => $this->useTemplate ? 'Y' : 'N',
        ];

        // optional
        foreach($optional_data AS $key => $value) {
            if($value) {
                $data[$key] = $value;
            }
        }

        $customFields = [];
        foreach($this->customFields AS $key => $value) {
            $customFields[] = [
                'code' => $key,
                'value' => $value,
            ];
        }

        if($customFields) {
            $data['custom_fields'] = $customFields;
        }

        return $data;
    }
}
