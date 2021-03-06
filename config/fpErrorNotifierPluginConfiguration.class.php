<?php

/** 
 *
 * @package    fpErrorNotifier
 * @subpackage config 
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class fpErrorNotifierPluginConfiguration extends sfPluginConfiguration
{
  /**
   * 
   * @return void
   */
  public function initialize()
  {
    $this->_initializeConfig();

    $this->notifier()->handler()->initialize();
  }
  
  /**
   * 
   * @return fpErrorNotifier
   */
  protected function notifier()
  {
    fpErrorNotifier::setInstance(
      new fpErrorNotifier($this->configuration->getEventDispatcher()));
      
    return fpErrorNotifier::getInstance();
  }
  
  /**
   * 
   * @return void
   */
  protected function _initializeConfig()
  {
    $configFiles = $this->configuration->getConfigPaths('config/notify.yml');
    $config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);
    
    foreach ($config as $name => $value) {
      sfConfig::set("sf_notify_{$name}", $value);  
    }
  }
}