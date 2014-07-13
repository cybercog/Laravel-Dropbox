<?php

/**
 * This file is part of Laravel Dropbox by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Dropbox\Factories;

use Dropbox\Client;

/**
 * This is the dropbox factory class.
 *
 * @package    Laravel-Dropbox
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Dropbox
 */
class DropboxFactory
{
    /**
     * Make a new dropbox client.
     *
     * @param  array  $config
     * @return \Dropbox\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param  array  $config
     * @return array
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('token', $config) || !array_key_exists('app', $config)) {
            throw new \InvalidArgumentException('The dropbox client requires authentication.');
        }

        return array_only($config, array('token', 'app'));
    }

    /**
     * Get the dropbox client.
     *
     * @param  array  $auth
     * @return \Dropbox\Client
     */
    protected function getClient(array $auth)
    {
        return new Client($auth['token'], $auth['app']);
    }
}