<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 26/08/19
 * Time: 20:42
 */

namespace App;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Database\ConfigurationUrlParser;

class ConnectionResolver extends DatabaseManager
{

    protected function configuration($name)
    {
        try {
            $config = parent::configuration($name);
        } catch ( InvalidArgumentException $e ) {

            // if connection doesn't exist then create it on the fly
            if( $name == DYNAMIC_DB ) {
                $connId = session($this->app['config']['database']['dynamic_connections']['param']);
                if( empty( $connId ) ) {
                    throw new InvalidArgumentException('Unable to retrieve db connection from session!');
                }
                $connections = $this->app['config']['database.connections'];
                $newCon = Arr::get($connections, 'mysql');
                $dbPrefix = $this->app['config']['database']['dynamic_connections']['prefix'];
                $newCon['database'] = $dbPrefix.$connId;
                $config = $newCon;
            }
            else throw $e;
        }

        return (new ConfigurationUrlParser)
            ->parseConfiguration($config);
    }
}