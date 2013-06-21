<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * consumer.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @category   Utility
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Platform\Authenticate\OAuth;

use Platform\Authenticate;
use Platform;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Utility
 * @author     Phil Sturgeon (Original Author)
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @license    http://philsturgeon.co.uk/code/dbad-license
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/libraries/authenticate/oauth
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
class Consumer {

    /**
     * @var  string  consumer key
     */
    protected $key;

    /**
     * @var  string  consumer secret
     */
    protected $secret;

    /**
     * @var  string  callback URL for OAuth authorization completion
     */
    protected $callback;

    /**
     * @var  string  scope for OAuth authorization completion
     */
    protected $scope;

    /**
     * Sets the consumer key and secret.
     *
     * @param   array  consumer options, key and secret are required
     * @return  void
     */
    public function __construct(array $options = NULL) {
        
        if (empty($options['key'])) {
            throw new Platform\Exception('Required option not provided: key');
        }

        /* TODO Erm? YouTube doesnt need this 
          if ( ! isset($options['secret']))
          {
          throw new Platform\Exception('Required option not provided: secret');
          }
         */
        $this->key = $options['key'];
        $this->secret = $options['secret'];

        if (isset($options['callback'])) {
            $this->callback = $options['callback'];
        }
        
        if (isset($options['scope'])) {
            $this->scope = $options['scope'];
        }
    }

    /**
     * Return the value of any protected class variable.
     *
     *     // Get the consumer key
     *     $key = $consumer->key;
     *
     * @param   string  variable name
     * @return  mixed
     */
    public function __get($key) {
        return $this->$key;
    }

    /**
     * Change the consumer callback.
     *
     * @param   string  new consumer callback
     * @return  $this
     */
    public function callback($callback) {
        $this->callback = $callback;

        return $this;
    }
}
