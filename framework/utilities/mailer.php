<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * mailer.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license	http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link	http://codeigniter.com
 * @since	Version 1.0
 * 
 */

namespace Platform;

use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/mailer
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Mailer extends Library\Object {

    /**
     * Used as the User-Agent and X-Mailer headers' value.
     *
     * @var	string
     */
    public $useragent = 'BudKit';

    /**
     * Path to the Sendmail binary.
     *
     * @var	string
     */
    public $mailpath = '/usr/sbin/sendmail'; // Sendmail path

    /**
     * Which method to use for sending e-mails.
     *
     * @var	string	'mail', 'sendmail' or 'smtp'
     */
    public $protocol = 'mail';  // mail/sendmail/smtp

    /**
     * STMP Server host
     *
     * @var	string
     */
    public $smtpHost = '';

    /**
     * SMTP Username
     *
     * @var	string
     */
    public $smtpUser = '';

    /**
     * SMTP Password
     *
     * @var	string
     */
    public $smtpPass = '';

    /**
     * SMTP Server port
     *
     * @var	int
     */
    public $smtpPort = 25;

    /**
     * SMTP connection timeout in seconds
     *
     * @var	int
     */
    public $smtpTimeout = 30;

    /**
     * SMTP persistent connection
     *
     * @var	bool
     */
    public $smtpKeepalive = FALSE;

    /**
     * SMTP Encryption
     *
     * @var	string	empty, 'tls' or 'ssl'
     */
    public $smtpCrypto = '';

    /**
     * Whether to apply word-wrapping to the message body.
     *
     * @var	bool
     */
    public $wordwrap = TRUE;

    /**
     * Number of characters to wrap at.
     *
     * @see	CI_Email::$wordwrap
     * @var	int
     */
    public $wrapchars = 76;

    /**
     * Message format.
     *
     * @var	string	'text' or 'html'
     */
    public $mailtype = 'text';

    /**
     * Character set (default: utf-8)
     *
     * @var	string
     */
    public $charset = 'utf-8';

    /**
     * Multipart message
     *
     * @var	string	'mixed' (in the body) or 'related' (separate)
     */
    public $multipart = 'mixed';  // "mixed" (in the body) or "related" (separate)

    /**
     * Alternative message (for HTML messages only)
     *
     * @var	string
     */
    public $altMessage = '';

    /**
     * Whether to validate e-mail addresses.
     *
     * @var	bool
     */
    public $validate = FALSE;

    /**
     * X-Priority header value.
     *
     * @var	int	1-5
     */
    public $priority = 3;   // Default priority (1 - 5)

    /**
     * Newline character sequence.
     * Use "\r\n" to comply with RFC 822.
     *
     * @link	http://www.ietf.org/rfc/rfc822.txt
     * @var	string	"\r\n" or "\n"
     */
    public $newline = "\n";   // Default newline. "\r\n" or "\n" (Use "\r\n" to comply with RFC 822)

    /**
     * CRLF character sequence
     *
     * RFC 2045 specifies that for 'quoted-printable' encoding,
     * "\r\n" must be used. However, it appears that some servers
     * (even on the receiving end) don't handle it properly and
     * switching to "\n", while improper, is the only solution
     * that seems to work for all environments.
     *
     * @link	http://www.ietf.org/rfc/rfc822.txt
     * @var	string
     */
    public $crlf = "\n";

    /**
     * Whether to use Delivery Status Notification.
     *
     * @var	bool
     */
    public $dsn = FALSE;

    /**
     * Whether to send multipart alternatives.
     * Yahoo! doesn't seem to like these.
     *
     * @var	bool
     */
    public $sendMultipart = TRUE;

    /**
     * Whether to send messages to BCC recipients in batches.
     *
     * @var	bool
     */
    public $bccBatchMode = FALSE;

    /**
     * BCC Batch max number size.
     *
     * @see	CI_Email::$bcc_batch_mode
     * @var	int
     */
    public $bccBatchSize = 200;

    /**
     * Subject header
     *
     * @var	string
     */
    protected $subject = '';

    /**
     * Message body
     *
     * @var	string
     */
    protected $body = '';

    /**
     * Final message body to be sent.
     *
     * @var	string
     */
    protected $finalbody = '';

    /**
     * multipart/alternative boundary
     *
     * @var	string
     */
    protected $altBoundary = '';

    /**
     * Attachment boundary
     *
     * @var	string
     */
    protected $atcBoundary = '';

    /**
     * Final headers to send
     *
     * @var	string
     */
    protected $headerStr = '';

    /**
     * SMTP Connection socket placeholder
     *
     * @var	resource
     */
    protected $smtpConnect = '';

    /**
     * Mail encoding
     *
     * @var	string	'8bit' or '7bit'
     */
    protected $encoding = '8bit';

    /**
     * Whether to perform SMTP authentication
     *
     * @var	bool
     */
    protected $smtpAuth = FALSE;

    /**
     * Whether to send a Reply-To header
     *
     * @var	bool
     */
    protected $replytoFlag = FALSE;

    /**
     * Recipients
     *
     * @var	string[]
     */
    protected $recipients = array();

    /**
     * CC Recipients
     *
     * @var	string[]
     */
    protected $ccArray = array();

    /**
     * BCC Recipients
     *
     * @var	string[]
     */
    protected $bccArray = array();

    /**
     * Message headers
     *
     * @var	string[]
     */
    protected $headers = array();

    /**
     * Attachment data
     *
     * @var	array
     */
    protected $attachments = array();

    /**
     * Valid $protocol values
     *
     * @see	CI_Email::$protocol
     * @var	string[]
     */
    protected $protocols = array('mail', 'sendmail', 'smtp');

    /**
     * Base charsets
     *
     * Character sets valid for 7-bit encoding,
     * excluding language suffix.
     *
     * @var	string[]
     */
    protected $baseCharsets = array('us-ascii', 'iso-2022-');

    /**
     * Bit depths
     *
     * Valid mail encodings
     *
     * @see	CI_Email::$_encoding
     * @var	string[]
     */
    protected $bitDepths = array('7bit', '8bit');

    /**
     * $priority translations
     *
     * Actual values to send with the X-Priority header
     *
     * @var	string[]
     */
    protected $priorities = array('1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)');
    protected $config;

    // --------------------------------------------------------------------

    /**
     * Constructor - Sets Email Preferences
     *
     * The constructor can be passed an array of config values
     *
     * @param	array	$config = array()
     * @return	void
     */
    public function __construct($config = array()) {

        $this->config = \Library\Config::getInstance();
        $params = array(
            "protocol" => $this->config->getParam('outgoing-mail-handler','sendmail','server'),
            "smtpHost" => $this->config->getParam('outgoing-mail-server','','server'),
            "smtpUser" => $this->config->getParam('outgoing-mail-server-username','','server'),
            "smtpPass" => $this->config->getParam('outgoing-mail-server-password','','server'),
            "smtpPort" => $this->config->getParam('outgoing-mail-server-port',25,'server'),
            "smtpCrypto" => $this->config->getParam('outgoing-mail-server-security','','server'),
        );
        
        $siteEmail = $this->config->getParam('outgoing-mail-address','','server');
        $siteName = $this->config->getParam('site-name', $this->useragent);
        //Set the defaut from field
        $this->from($siteEmail, $siteName);
        
        $config = array_merge($params, $config);
        $this->initialize( $config );
        $this->charset = strtoupper($this->charset);
    }

    public function initialize($config) {
        //Set the default settings;
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method)) {
                    $this->$method($val);
                } else {
                    $this->$key = $val;
                }
            }
        }
        $this->clear();

        $this->smtpAuth = !($this->smtpUser === '' && $this->smtpPass === '');
   
        
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the Email Data
     *
     * @param	bool
     * @return	CI_Email
     */
    public function clear($clearAttachments = FALSE) {

        $this->subject = '';
        $this->body = '';
        $this->finalbody = '';
        $this->headerStr = '';
        $this->replytoFlag = FALSE;
        $this->recipients = array();
        $this->ccArray = array();
        $this->bccArray = array();
        $this->headers = array();
        $this->debugMsg = array();

        $this->setHeader('User-Agent', $this->useragent);
        $this->setHeader('Date', $this->setDate());

        if ($clearAttachments !== FALSE) {
            $this->attachments = array();
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set FROM
     *
     * @param	string	$from
     * @param	string	$name
     * @param	string	$return_path = NULL	Return-Path
     * @return	CI_Email
     */
    public function from($from, $name = '', $returnPath = NULL) {
        if (preg_match('/\<(.*)\>/', $from, $match)) {
            $from = $match[1];
        }
        if ($this->validate) {
            $this->validateEmail($this->strToArray($from));
            if ($returnPath) {
                $this->validateEmail($this->strToArray($returnPath));
            }
        }
        // prepare the display name
        if ($name !== '') {
            // only use Q encoding if there are characters that would require it
            if (!preg_match('/[\200-\377]/', $name)) {
                // add slashes for non-printing characters, slashes, and double quotes, and surround it in double quotes
                $name = '"' . addcslashes($name, "\0..\37\177'\"\\") . '"';
            } else {
                $name = $this->prepQEncoding($name);
            }
        }
        $this->setHeader('From', $name . ' <' . $from . '>');

        isset($returnPath) OR $returnPath = $from;
        $this->setHeader('Return-Path', '<' . $returnPath . '>');

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Reply-to
     *
     * @param	string
     * @param	string
     * @return	CI_Email
     */
    public function replyTo($replyto, $name = '') {

        if (preg_match('/\<(.*)\>/', $replyto, $match)) {
            $replyto = $match[1];
        }
        if ($this->validate) {
            $this->validateEmail($this->strToArray($replyto));
        }
        if ($name === '') {
            $name = $replyto;
        }
        if (strpos($name, '"') !== 0) {
            $name = '"' . $name . '"';
        }
        $this->setHeader('Reply-To', $name . ' <' . $replyto . '>');
        $this->replytoFlag = TRUE;

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Recipients
     *
     * @param	string
     * @return	CI_Email
     */
    public function to($to) {
        $to = $this->strToArray($to);
        $to = $this->cleanEmail($to);

        if ($this->validate) {
            $this->validateEmail($to);
        }
        if ($this->getProtocol() !== 'mail') {
            $this->setHeader('To', implode(', ', $to));
        }
        $this->recipients = $to;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set CC
     *
     * @param	string
     * @return	CI_Email
     */
    public function cc($cc) {

        $cc = $this->cleanEmail($this->strToArray($cc));

        if ($this->validate) {
            $this->validateEmail($cc);
        }

        $this->setHeader('Cc', implode(', ', $cc));

        if ($this->getProtocol() === 'smtp') {
            $this->ccArray = $cc;
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set BCC
     *
     * @param	string
     * @param	string
     * @return	CI_Email
     */
    public function bcc($bcc, $limit = '') {
        if ($limit !== '' && is_numeric($limit)) {
            $this->bccBatchMode = TRUE;
            $this->bccBatchSize = $limit;
        }

        $bcc = $this->cleanEmail($this->strToArray($bcc));

        if ($this->validate) {
            $this->validateEmail($bcc);
        }

        if ($this->getProtocol() === 'smtp' OR ($this->bccBatchMode && count($bcc) > $this->bccBatchSize)) {
            $this->bccArray = $bcc;
        } else {
            $this->setHeader('Bcc', implode(', ', $bcc));
        }

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Email Subject
     *
     * @param	string
     * @return	CI_Email
     */
    public function subject($subject) {
        $subject = $this->prepQEncoding($subject);
        $this->setHeader('Subject', $subject);
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Body
     *
     * @param	string
     * @return	CI_Email
     */
    public function message($body) {
        $this->body = rtrim(str_replace("\r", '', $body));

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Assign file attachments
     *
     * @param	string	$filename
     * @param	string	$disposition = 'attachment'
     * @param	string	$newname = NULL
     * @param	string	$mime = ''
     * @return	CI_Email
     */
    public function attach($filename, $disposition = '', $newname = NULL, $mime = '') {
        $this->attachments[] = array(
            'name' => array($filename, $newname),
            'disposition' => empty($disposition) ? 'attachment' : $disposition, // Can also be 'inline'  Not sure if it matters
            'type' => $mime
        );

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Add a Header Item
     *
     * @param	string
     * @param	string
     * @return	void
     */
    public function setHeader($header, $value) {
        $this->headers[$header] = $value;
    }

    // --------------------------------------------------------------------

    /**
     * Convert a String to an Array
     *
     * @param	string
     * @return	array
     */
    protected function strToArray($email) {
        if (!is_array($email)) {
            return (strpos($email, ',') !== FALSE) ? preg_split('/[\s,]/', $email, -1, PREG_SPLIT_NO_EMPTY) : (array) trim($email);
        }

        return $email;
    }

    // --------------------------------------------------------------------

    /**
     * Set Multipart Value
     *
     * @param	string
     * @return	CI_Email
     */
    public function setAltMessage($str = '') {
        $this->altMessage = (string) $str;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Mailtype
     *
     * @param	string
     * @return	CI_Email
     */
    public function setMailType($type = 'text') {
        $this->mailtype = ($type === 'html') ? 'html' : 'text';
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Wordwrap
     *
     * @param	bool
     * @return	CI_Email
     */
    public function setWordwrap($wordwrap = TRUE) {
        $this->wordwrap = (bool) $wordwrap;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Protocol
     *
     * @param	string
     * @return	CI_Email
     */
    public function setProtocol($protocol = 'mail') {
        $this->protocol = in_array($protocol, $this->protocols, TRUE) ? strtolower($protocol) : 'mail';
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Priority
     *
     * @param	int
     * @return	CI_Email
     */
    public function setPriority($n = 3) {
        $this->priority = preg_match('/^[1-5]$/', $n) ? (int) $n : 3;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Newline Character
     *
     * @param	string
     * @return	CI_Email
     */
    public function setNewline($newline = "\n") {
        $this->newline = in_array($newline, array("\n", "\r\n", "\r")) ? $newline : "\n";
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set CRLF
     *
     * @param	string
     * @return	CI_Email
     */
    public function setCRLF($crlf = "\n") {
        $this->crlf = ($crlf !== "\n" && $crlf !== "\r\n" && $crlf !== "\r") ? "\n" : $crlf;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Message Boundary
     *
     * @return	void
     */
    protected function setBoundaries() {
        $this->altBoundary = 'B_ALT_' . uniqid(''); // multipart/alternative
        $this->atcBoundary = 'B_ATC_' . uniqid(''); // attachment boundary
    }

    // --------------------------------------------------------------------

    /**
     * Get the Message ID
     *
     * @return	string
     */
    protected function getMessageId() {
        $from = str_replace(array('>', '<'), '', $this->headers['Return-Path']);
        return '<' . uniqid('') . strstr($from, '@') . '>';
    }

    // --------------------------------------------------------------------

    /**
     * Get Mail Protocol
     *
     * @param	bool
     * @return	mixed
     */
    protected function getProtocol($return = TRUE) {
        $this->protocol = strtolower($this->protocol);
        in_array($this->protocol, $this->protocols, TRUE) OR $this->protocol = 'mail';

        if ($return === TRUE) {
            return $this->protocol;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get Mail Encoding
     *
     * @param	bool
     * @return	string
     */
    protected function getEncoding($return = TRUE) {
        in_array($this->encoding, $this->bitDepths) OR $this->encoding = '8bit';

        foreach ($this->baseCharsets as $charset) {
            if (strpos($charset, $this->charset) === 0) {
                $this->encoding = '7bit';
            }
        }
        if ($return === TRUE) {
            return $this->encoding;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get content type (text/html/attachment)
     *
     * @return	string
     */
    protected function getContentType() {
        if ($this->mailtype === 'html') {
            return (count($this->attachments) === 0) ? 'html' : 'html-attach';
        } elseif ($this->mailtype === 'text' && count($this->attachments) > 0) {
            return 'plain-attach';
        } else {
            return 'plain';
        }
    }

    // --------------------------------------------------------------------

    /**
     * Set RFC 822 Date
     *
     * @return	string
     */
    protected function setDate() {
        $timezone = date('Z');
        $operator = ($timezone[0] === '-') ? '-' : '+';
        $timezone = abs($timezone);
        $timezone = floor($timezone / 3600) * 100 + ($timezone % 3600) / 60;

        return sprintf('%s %s%04d', date('D, j M Y H:i:s'), $operator, $timezone);
    }

    // --------------------------------------------------------------------

    /**
     * Mime message
     *
     * @return	string
     */
    protected function getMimeMessage() {
        return 'This is a multi-part message in MIME format.' . $this->newline . 'Your email application may not support this format.';
    }

    // --------------------------------------------------------------------

    /**
     * Validate Email Address
     *
     * @param	string
     * @return	bool
     */
    public function validateEmail($email) {
        if (!is_array($email)) {
            $this->setError('Email must be an array');
            return FALSE;
        }

        foreach ($email as $val) {
            if (!$this->validEmail($val)) {
                $this->setError('Invlid Email address');
                return FALSE;
            }
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Email Validation
     *
     * @param	string
     * @return	bool
     */
    public function validEmail($email) {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // --------------------------------------------------------------------

    /**
     * Clean Extended Email Address: Joe Smith <joe@smith.com>
     *
     * @param	string
     * @return	string
     */
    public function cleanEmail($email) {
        if (!is_array($email)) {
            return preg_match('/\<(.*)\>/', $email, $match) ? $match[1] : $email;
        }

        $cleanEmail = array();

        foreach ($email as $addy) {
            $cleanEmail[] = preg_match('/\<(.*)\>/', $addy, $match) ? $match[1] : $addy;
        }

        return $cleanEmail;
    }

    // --------------------------------------------------------------------

    /**
     * Build alternative plain text message
     *
     * Provides the raw message for use in plain-text headers of
     * HTML-formatted emails.
     * If the user hasn't specified his own alternative message
     * it creates one by stripping the HTML
     *
     * @return	string
     */
    protected function getAltMessage() {
        if (!empty($this->altMessage)) {
            return ($this->wordwrap) ? $this->word_wrap($this->altMessage, 76) : $this->altMessage;
        }

        $body = preg_match('/\<body.*?\>(.*)\<\/body\>/si', $this->body, $match) ? $match[1] : $this->body;
        $body = str_replace("\t", '', preg_replace('#<!--(.*)--\>#', '', trim(strip_tags($body))));

        for ($i = 20; $i >= 3; $i--) {
            $body = str_replace(str_repeat("\n", $i), "\n\n", $body);
        }

        // Reduce multiple spaces
        $body = preg_replace('| +|', ' ', $body);

        return ($this->wordwrap) ? $this->wordWrap($body, 76) : $body;
    }

    // --------------------------------------------------------------------

    /**
     * Word Wrap
     *
     * @param	string
     * @param	int	line-length limit
     * @return	string
     */
    public function wordWrap($str, $charlim = NULL) {
        // Set the character limit, if not already present
        if (empty($charlim)) {
            $charlim = empty($this->wrapchars) ? 76 : $this->wrapchars;
        }

        // Standardize newlines
        if (strpos($str, "\r") !== FALSE) {
            $str = str_replace(array("\r\n", "\r"), "\n", $str);
        }

        // Reduce multiple spaces at end of line
        $str = preg_replace('| +\n|', "\n", $str);

        // If the current word is surrounded by {unwrap} tags we'll
        // strip the entire chunk and replace it with a marker.
        $unwrap = array();
        if (preg_match_all('|(\{unwrap\}.+?\{/unwrap\})|s', $str, $matches)) {
            for ($i = 0, $c = count($matches[0]); $i < $c; $i++) {
                $unwrap[] = $matches[1][$i];
                $str = str_replace($matches[1][$i], '{{unwrapped' . $i . '}}', $str);
            }
        }

        // Use PHP's native public function to do the initial wordwrap.
        // We set the cut flag to FALSE so that any individual words that are
        // too long get left alone. In the next step we'll deal with them.
        $str = wordwrap($str, $charlim, "\n", FALSE);

        // Split the string into individual lines of text and cycle through them
        $output = '';
        foreach (explode("\n", $str) as $line) {
            // Is the line within the allowed character count?
            // If so we'll join it to the output and continue
            if (strlen($line) <= $charlim) {
                $output .= $line . $this->newline;
                continue;
            }

            $temp = '';
            do {
                // If the over-length word is a URL we won't wrap it
                if (preg_match('!\[url.+\]|://|wwww.!', $line)) {
                    break;
                }

                // Trim the word down
                $temp .= substr($line, 0, $charlim - 1);
                $line = substr($line, $charlim - 1);
            } while (strlen($line) > $charlim);

            // If $temp contains data it means we had to split up an over-length
            // word into smaller chunks so we'll add it back to our current line
            if ($temp !== '') {
                $output .= $temp . $this->newline;
            }

            $output .= $line . $this->newline;
        }

        // Put our markers back
        if (count($unwrap) > 0) {
            foreach ($unwrap as $key => $val) {
                $output = str_replace('{{unwrapped' . $key . '}}', $val, $output);
            }
        }
        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Build final headers
     *
     * @return	string
     */
    protected function buildHeaders() {
        $this->setHeader('X-Sender', $this->cleanEmail($this->headers['From']));
        $this->setHeader('X-Mailer', $this->useragent);
        $this->setHeader('X-Priority', $this->priorities[$this->priority - 1]);
        $this->setHeader('Message-ID', $this->getMessageId());
        $this->setHeader('Mime-Version', '1.0');
    }

    // --------------------------------------------------------------------

    /**
     * Write Headers as a string
     *
     * @return	void
     */
    protected function writeHeaders() {
        if ($this->protocol === 'mail') {
            if (isset($this->headers['Subject'])) {
                $this->subject = $this->headers['Subject'];
                unset($this->headers['Subject']);
            }
        }

        reset($this->headers);
        $this->headerStr = '';

        foreach ($this->headers as $key => $val) {
            $val = trim($val);

            if ($val !== '') {
                $this->headerStr .= $key . ': ' . $val . $this->newline;
            }
        }

        if ($this->getProtocol() === 'mail') {
            $this->headerStr = rtrim($this->headerStr);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Build Final Body and attachments
     *
     * @return	bool
     */
    protected function buildMessage() {
        if ($this->wordwrap === TRUE && $this->mailtype !== 'html') {
            $this->body = $this->wordWrap($this->body);
        }

        $this->setBoundaries();
        $this->writeHeaders();

        $hdr = ($this->getProtocol() === 'mail') ? $this->newline : '';
        $body = '';

        switch ($this->getContentType()) {
            case 'plain' :

                $hdr .= 'Content-Type: text/plain; charset=' . $this->charset . $this->newline
                        . 'Content-Transfer-Encoding: ' . $this->getEncoding();

                if ($this->getProtocol() === 'mail') {
                    $this->headerStr .= $hdr;
                    $this->finalbody = $this->body;
                } else {
                    $this->finalbody = $hdr . $this->newline . $this->newline . $this->body;
                }

                return;

            case 'html' :

                if ($this->sendMultipart === FALSE) {
                    $hdr .= 'Content-Type: text/html; charset=' . $this->charset . $this->newline
                            . 'Content-Transfer-Encoding: quoted-printable';
                } else {
                    $hdr .= 'Content-Type: multipart/alternative; boundary="' . $this->altBoundary . '"' . $this->newline . $this->newline;

                    $body .= $this->getMimeMessage() . $this->newline . $this->newline
                            . '--' . $this->altBoundary . $this->newline
                            . 'Content-Type: text/plain; charset=' . $this->charset . $this->newline
                            . 'Content-Transfer-Encoding: ' . $this->getEncoding() . $this->newline . $this->newline
                            . $this->getAltMessage() . $this->newline . $this->newline . '--' . $this->altBoundary . $this->newline
                            . 'Content-Type: text/html; charset=' . $this->charset . $this->newline
                            . 'Content-Transfer-Encoding: quoted-printable' . $this->newline . $this->newline;
                }

                $this->finalbody = $body . $this->prepQuotedPrintable($this->body) . $this->newline . $this->newline;

                if ($this->getProtocol() === 'mail') {
                    $this->headerStr .= $hdr;
                } else {
                    $this->finalbody = $hdr . $this->finalbody;
                }

                if ($this->sendMultipart !== FALSE) {
                    $this->finalbody .= '--' . $this->altBoundary . '--';
                }

                return;

            case 'plain-attach' :

                $hdr .= 'Content-Type: multipart/' . $this->multipart . '; boundary="' . $this->atcBoundary . '"' . $this->newline . $this->newline;

                if ($this->getProtocol() === 'mail') {
                    $this->headerStr .= $hdr;
                }

                $body .= $this->getMimeMessage() . $this->newline . $this->newline
                        . '--' . $this->atcBoundary . $this->newline
                        . 'Content-Type: text/plain; charset=' . $this->charset . $this->newline
                        . 'Content-Transfer-Encoding: ' . $this->getEncoding() . $this->newline . $this->newline
                        . $this->body . $this->newline . $this->newline;

                break;
            case 'html-attach' :

                $hdr .= 'Content-Type: multipart/' . $this->multipart . '; boundary="' . $this->atcBoundary . '"' . $this->newline . $this->newline;

                if ($this->getProtocol() === 'mail') {
                    $this->headerStr .= $hdr;
                }

                $body .= $this->getMimeMessage() . $this->newline . $this->newline
                        . '--' . $this->atcBoundary . $this->newline
                        . 'Content-Type: multipart/alternative; boundary="' . $this->altBoundary . '"' . $this->newline . $this->newline
                        . '--' . $this->altBoundary . $this->newline
                        . 'Content-Type: text/plain; charset=' . $this->charset . $this->newline
                        . 'Content-Transfer-Encoding: ' . $this->getEncoding() . $this->newline . $this->newline
                        . $this->getAltMessage() . $this->newline . $this->newline . '--' . $this->altBoundary . $this->newline
                        . 'Content-Type: text/html; charset=' . $this->charset . $this->newline
                        . 'Content-Transfer-Encoding: quoted-printable' . $this->newline . $this->newline
                        . $this->prepQuotedPrintable($this->body) . $this->newline . $this->newline
                        . '--' . $this->altBoundary . '--' . $this->newline . $this->newline;

                break;
        }

        $attachment = array();
        for ($i = 0, $c = count($this->attachments), $z = 0; $i < $c; $i++) {
            $filename = $this->attachments[$i]['name'][0];
            $basename = ($this->attachments[$i]['name'][1] === NULL) ? basename($filename) : $this->attachments[$i]['name'][1];
            $ctype = $this->attachments[$i]['type'];
            $fileContent = '';

            if ($ctype === '') {
                if (!file_exists($filename)) {
                    $this->setError('Email attachment missing', $filename);
                    return FALSE;
                }

                $file = filesize($filename) + 1;

                if (!$fp = fopen($filename, FOPEN_READ)) {
                    $this->setError('Email attachment unreadable', $filename);
                    return FALSE;
                }

                $ctype = $this->mimeTypes(pathinfo($filename, PATHINFO_EXTENSION));
                $fileContent = fread($fp, $file);
                fclose($fp);
            } else {
                $fileContent = & $this->attachments[$i]['name'][0];
            }

            $attachment[$z++] = '--' . $this->atcBoundary . $this->newline
                    . 'Content-type: ' . $ctype . '; '
                    . 'name="' . $basename . '"' . $this->newline
                    . 'Content-Disposition: ' . $this->attachments[$i]['disposition'] . ';' . $this->newline
                    . 'Content-Transfer-Encoding: base64' . $this->newline;

            $attachment[$z++] = chunk_split(base64_encode($fileContent));
        }

        $body .= implode($this->newline, $attachment) . $this->newline . '--' . $this->atcBoundary . '--';
        $this->finalbody = ($this->getProtocol() === 'mail') ? $body : $hdr . $body;
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Prep Quoted Printable
     *
     * Prepares string for Quoted-Printable Content-Transfer-Encoding
     * Refer to RFC 2045 http://www.ietf.org/rfc/rfc2045.txt
     *
     * @param	string
     * @return	string
     */
    protected function prepQuotedPrintable($str) {
        // We are intentionally wrapping so mail servers will encode characters
        // properly and MUAs will behave, so {unwrap} must go!
        $str = str_replace(array('{unwrap}', '{/unwrap}'), '', $str);

        // RFC 2045 specifies CRLF as "\r\n".
        // However, many developers choose to override that and violate
        // the RFC rules due to (apparently) a bug in MS Exchange,
        // which only works with "\n".
        if ($this->crlf === "\r\n") {
            if (is_php('5.3')) {
                return quoted_printable_encode($str);
            } elseif (function_exists('imap_8bit')) {
                return imap_8bit($str);
            }
        }

        // Reduce multiple spaces & remove nulls
        $str = preg_replace(array('| +|', '/\x00+/'), array(' ', ''), $str);

        // Standardize newlines
        if (strpos($str, "\r") !== FALSE) {
            $str = str_replace(array("\r\n", "\r"), "\n", $str);
        }

        $escape = '=';
        $output = '';

        foreach (explode("\n", $str) as $line) {
            $length = strlen($line);
            $temp = '';

            // Loop through each character in the line to add soft-wrap
            // characters at the end of a line " =\r\n" and add the newly
            // processed line(s) to the output (see comment on $crlf class property)
            for ($i = 0; $i < $length; $i++) {
                // Grab the next character
                $char = $line[$i];
                $ascii = ord($char);

                // Convert spaces and tabs but only if it's the end of the line
                if ($i === ($length - 1) && ($ascii === 32 OR $ascii === 9)) {
                    $char = $escape . sprintf('%02s', dechex($ascii));
                } elseif ($ascii === 61) { // encode = signs
                    $char = $escape . strtoupper(sprintf('%02s', dechex($ascii)));  // =3D
                }

                // If we're at the character limit, add the line to the output,
                // reset our temp variable, and keep on chuggin'
                if ((strlen($temp) + strlen($char)) >= 76) {
                    $output .= $temp . $escape . $this->crlf;
                    $temp = '';
                }

                // Add the character to our temporary line
                $temp .= $char;
            }

            // Add our completed line to the output
            $output .= $temp . $this->crlf;
        }

        // get rid of extra CRLF tacked onto the end
        return substr($output, 0, strlen($this->crlf) * -1);
    }

    // --------------------------------------------------------------------

    /**
     * Prep Q Encoding
     *
     * Performs "Q Encoding" on a string for use in email headers.
     * It's related but not identical to quoted-printable, so it has its
     * own method.
     *
     * @param	string
     * @return	string
     */
    protected function prepQEncoding($str) {
        $str = str_replace(array("\r", "\n"), '', $str);

        if ($this->charset === 'UTF-8') {
            if (extension_loaded('mbstring')) {
                return mb_encode_mimeheader($str, $this->charset, 'Q', $this->crlf);
            } elseif (extension_loaded('iconv')) {
                $output = @iconv_mime_encode('', $str, array(
                            'scheme' => 'Q',
                            'line-length' => 76,
                            'input-charset' => $this->charset,
                            'output-charset' => $this->charset,
                            'line-break-chars' => $this->crlf
                                )
                );

                // There are reports that iconv_mime_encode() might fail and return FALSE
                if ($output !== FALSE) {
                    // iconv_mime_encode() will always put a header field name.
                    // We've passed it an empty one, but it still prepends our
                    // encoded string with ': ', so we need to strip it.
                    return substr($output, 2);
                }

                $chars = iconv_strlen($str, 'UTF-8');
            }
        }

        // We might already have this set for UTF-8
        isset($chars) OR $chars = strlen($str);

        $output = '=?' . $this->charset . '?Q?';
        for ($i = 0, $length = strlen($output), $iconv = extension_loaded('iconv'); $i < $chars; $i++) {
            $chr = ($this->charset === 'UTF-8' && $iconv === TRUE) ? '=' . implode('=', str_split(strtoupper(bin2hex(iconv_substr($str, $i, 1, $this->charset))), 2)) : '=' . strtoupper(bin2hex($str[$i]));

            // RFC 2045 sets a limit of 76 characters per line.
            // We'll append ?= to the end of each line though.
            if ($length + ($l = strlen($chr)) > 74) {
                $output .= '?=' . $this->crlf // EOL
                        . ' =?' . $this->charset . '?Q?' . $chr; // New line
                $length = 6 + strlen($this->charset) + $l; // Reset the length for the new line
            } else {
                $output .= $chr;
                $length += $l;
            }
        }

        // End the header
        return $output . '?=';
    }

    // --------------------------------------------------------------------

    /**
     * Send Email
     *
     * @param	bool	$auto_clear = TRUE
     * @return	bool
     */
    public function send($autoClear = TRUE) {
        if ($this->replytoFlag === FALSE) {
            $this->replyTo($this->headers['From']);
        }

        if (!isset($this->recipients) && !isset($this->headers['To'])
                && !isset($this->bccArray) && !isset($this->headers['Bcc'])
                && !isset($this->headers['Cc'])) {
            $this->setError('No recipients specified');
            return FALSE;
        }

        $this->buildHeaders();

        if ($this->bccBatchMode && count($this->bccArray) > $this->bccBatchSize) {
            $result = $this->batchBccSend();

            if ($result && $autoClear) {
                $this->clear();
            }

            return $result;
        }

        if ($this->buildMessage() === FALSE) {
            return FALSE;
        }

        $result = $this->spoolEmail();

        if ($result && $autoClear) {
            $this->clear();
        }

        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * Batch Bcc Send. Sends groups of BCCs in batches
     *
     * @return	void
     */
    public function batchBccSend() {
        $float = $this->bccBatchSize - 1;
        $set = '';
        $chunk = array();

        for ($i = 0, $c = count($this->bccArray); $i < $c; $i++) {
            if (isset($this->bccArray[$i])) {
                $set .= ', ' . $this->bccArray[$i];
            }

            if ($i === $float) {
                $chunk[] = substr($set, 1);
                $float += $this->bccBatchSize;
                $set = '';
            }

            if ($i === $c - 1) {
                $chunk[] = substr($set, 1);
            }
        }

        for ($i = 0, $c = count($chunk); $i < $c; $i++) {

            unset($this->headers['Bcc']);
            $bcc = $this->cleanEmail($this->strToArray($chunk[$i]));

            if ($this->protocol !== 'smtp') {
                $this->setHeader('Bcc', implode(', ', $bcc));
            } else {
                $this->bccArray = $bcc;
            }

            if ($this->buildEessage() === FALSE) {
                return FALSE;
            }

            $this->spoolEmail();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Unwrap special elements
     *
     * @return	void
     */
    protected function unwrapSpecials() {
        $this->finalbody = preg_replace_callback('/\{unwrap\}(.*?)\{\/unwrap\}/si', array($this, 'removeNlCallback'), $this->finalbody);
    }

    // --------------------------------------------------------------------

    /**
     * Strip line-breaks via callback
     *
     * @param	string	$matches
     * @return	string
     */
    protected function removeNlCallback($matches) {
        if (strpos($matches[1], "\r") !== FALSE OR strpos($matches[1], "\n") !== FALSE) {
            $matches[1] = str_replace(array("\r\n", "\r", "\n"), '', $matches[1]);
        }

        return $matches[1];
    }

    // --------------------------------------------------------------------

    /**
     * Spool mail to the mail server
     *
     * @return	bool
     */
    protected function spoolEmail() {
        $this->unwrapSpecials();
        $protocol = $this->getProtocol();
        $method = 'sendWith' . ucfirst($protocol);
        if (!$this->$method()) {
            $this->setError('Could not send the message with ' . ($this->getProtocol() === 'mail' ? 'phpmail' : $this->getProtocol()));
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Send using mail()
     *
     * @return	bool
     */
    protected function sendWithMail() {
        if (is_array($this->recipients)) {
            $this->recipients = implode(', ', $this->recipients);
        }

        // most documentation of sendmail using the "-f" flag lacks a space after it, however
        // we've encountered servers that seem to require it to be in place.
        return mail($this->recipients, $this->subject, $this->finalbody, $this->headerStr, '-f ' . $this->cleanEmail($this->headers['Return-Path']));
    }

    // --------------------------------------------------------------------

    /**
     * Send using Sendmail
     *
     * @return	bool
     */
    protected function sendWithSendmail() {
        // is popen() enabled?
        if (!function_exists('popen')
                OR FALSE === ($fp = @popen(
                        $this->mailpath . ' -oi -f ' . $this->cleanEmail($this->headers['From'])
                        . ' -t -r ' . $this->cleanEmail($this->headers['Return-Path'])
                        , 'w'))
        ) { // server probably has popen disabled, so nothing we can do to get a verbose error.
            return FALSE;
        }

        fputs($fp, $this->headerStr);
        fputs($fp, $this->finalbody);

        $status = pclose($fp);

        if ($status !== 0) {
            $this->setError('lang:email_exit_status', $status);
            $this->setError('lang:email_no_socket');
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Send using SMTP
     *
     * @return	bool
     */
    protected function sendWithSmtp() {
        if ($this->smtpHost === '') {
            $this->setError('lang:email_no_hostname');
            return FALSE;
        }

        if (!$this->smtpConnect() OR !$this->smtpAuthenticate()) {
            return FALSE;
        }

        $this->sendCommand('from', $this->cleanEmail($this->headers['From']));

        foreach ($this->recipients as $val) {
            $this->sendCommand('to', $val);
        }

        if (count($this->ccArray) > 0) {
            foreach ($this->ccArray as $val) {
                if ($val !== '') {
                    $this->sendCommand('to', $val);
                }
            }
        }

        if (count($this->bccArray) > 0) {
            foreach ($this->bccArray as $val) {
                if ($val !== '') {
                    $this->sendCommand('to', $val);
                }
            }
        }

        $this->sendCommand('data');
        // perform dot transformation on any lines that begin with a dot
        $this->sendData($this->headerStr . preg_replace('/^\./m', '..$1', $this->finalbody));
        $this->sendData('.');

        $reply = $this->getSmtpData();

        //$this->setError($reply);

        if (strpos($reply, '250') !== 0) {
            $this->setError('lang:email_smtp_error', $reply);
            return FALSE;
        }

        if ($this->smtpKeepalive) {
            $this->sendCommand('reset');
        } else {
            $this->sendCommand('quit');
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * SMTP Connect
     *
     * @return	string
     */
    protected function smtpConnect() {
        if (is_resource($this->smtpConnect)) {
            return TRUE;
        }
        $scheme = ($this->smtpCrypto === 'ssl') ? 'ssl://' : (($this->smtpCrypto === 'tls') ? 'tsl://' : null);
        $port   = ($this->smtpPort > 0)? ":{$this->smtpPort}" : '';
        $errNo  = PLATFORM_ERROR;
        $errStr = "Could not connect to {$this->smtpHost}"; 
        $socket = $scheme . $this->smtpHost.$port;
        
        $this->smtpConnect = stream_socket_client ($socket, $errNo, $errStr, $this->smtpTimeout);
        
        
        if (!is_resource($this->smtpConnect)) {
            $this->setError('lang:email_smtp_error');
            return FALSE;
        }
                
        stream_set_timeout($this->smtpConnect, $this->smtpTimeout);
        
        if ($this->smtpCrypto === 'tls') {
            $this->sendCommand('hello');
            $this->sendCommand('starttls');

            $crypto = stream_socket_enable_crypto($this->smtpConnect, TRUE, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        
            if ($crypto !== TRUE) {
                $this->setError('lang:email_smtp_error', $this->getSmtpData());
                return FALSE;
            }
        }
        
        return $this->sendCommand('hello');
    }

    // --------------------------------------------------------------------

    /**
     * Send SMTP command
     *
     * @param	string
     * @param	string
     * @return	string
     */
    protected function sendCommand($cmd, $data = '') {
        switch ($cmd) {
            case 'hello' :

                if ($this->smtpAuth OR $this->getEncoding() === '8bit') {
                    $this->sendData('HELO ' . $this->getHostname());
                } else {
                    $this->sendData('HELO ' . $this->getHostname());
                }

                $resp = 250;
                break;
            case 'starttls' :

                $this->sendData('STARTTLS');
                $resp = 220;
                break;
            case 'from' :

                $this->sendData('MAIL FROM:<' . $data . '>');
                $resp = 250;
                break;
            case 'to' :

                if ($this->dsn) {
                    $this->sendData('RCPT TO:<' . $data . '> NOTIFY=SUCCESS,DELAY,FAILURE ORCPT=rfc822;' . $data);
                } else {
                    $this->sendData('RCPT TO:<' . $data . '>');
                }

                $resp = 250;
                break;
            case 'data' :

                $this->sendData('DATA');
                $resp = 354;
                break;
            case 'reset':

                $this->sendData('RSET');
                $resp = 250;
                break;
            case 'quit' :

                $this->sendData('QUIT');
                $resp = 221;
                break;
        }

        $reply = $this->getSmtpData();
       
        if ((int) substr($reply, 0, 3) !== $resp) {
            $this->setError('lang:email_smtp_error', $reply);
            return FALSE;
        }

        if ($cmd === 'quit') {
            fclose($this->smtpConnect);
        }
        
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * SMTP Authenticate
     *
     * @return	bool
     */
    protected function smtpAuthenticate() {
        if (!$this->smtpAuth) {
            return TRUE;
        }

        if ($this->smtpUser === '' && $this->smtpPass === '') {
            $this->setError('lang:email_no_smtp_unpw');
            return FALSE;
        }

        $this->sendData('AUTH LOGIN');

        $reply = $this->getSmtpData();

        if (strpos($reply, '503') === 0) { // Already authenticated
            return TRUE;
        } elseif (strpos($reply, '334') !== 0) {
            $this->setError('lang:email_failed_smtp_login', $reply);
            return FALSE;
        }

        $this->sendData(base64_encode($this->smtpUser));

        $reply = $this->getSmtpData();

        if (strpos($reply, '334') !== 0) {
            $this->setError('lang:email_smtp_auth_un', $reply);
            return FALSE;
        }

        $this->sendData(base64_encode($this->smtpPass));

        $reply = $this->getSmtpData();

        if (strpos($reply, '235') !== 0) {
            $this->setError('lang:email_smtp_auth_pw', $reply);
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Send SMTP data
     *
     * @param	string	$data
     * @return	bool
     */
    protected function sendData($data) {
        if (!fwrite($this->smtpConnect, $data . $this->newline)) {
            $this->setError('lang:email_smtp_data_failure', $data);
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Get SMTP data
     *
     * @return	string
     */
    protected function getSmtpData() {
        $data = '';

        while ($str = fgets($this->smtpConnect, 512)) {
            $data .= $str;

            if ($str[3] === ' ') {
                break;
            }
        }

        return $data;
    }

    // --------------------------------------------------------------------

    /**
     * Get Hostname
     *
     * @return	string
     */
    protected function getHostname() {
        return isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost.localdomain';
    }

    /**
     * Mime Types
     *
     * @param	string
     * @return	string
     */
    protected function mimeTypes($ext = '') {

        static $mimes;

        /**
         * needs to rework this app based on attachments.ini mime types;
         */
        return 'application/x-unknown-content-type';
    }

    /**
     *
     * @staticvar Loader $instance
     * @param type $namespace
     * @param type $dir
     * @return Loader 
     */
    public static function getInstance($namespace = '', $dir = '') {

        static $instance;
        //If the class was already instantiated, just return it
        if (isset($instance))
            return $instance;
        $instance = new self;

        return $instance;
    }

}
