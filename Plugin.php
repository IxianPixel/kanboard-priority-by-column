<?php

namespace Kanboard\Plugin\PriorityByColumn;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\PriorityByColumn\Action\PriorityByColumn;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new PriorityByColumn($this->container));
    }

  public function getPluginName() {
    return 'Priority By Column';
  }
  
  public function getPluginAuthor() {
    return 'IxianPixel';
  }
  
  public function getPluginVersion() {
    return '1.0.0';
  }
  
  public function getPluginDescription() {
    return t('Change the task priority when the task is moved to another column');
  }
  
  public function getPluginHomepage() {
    return 'https://malgra.com';
  }
}
