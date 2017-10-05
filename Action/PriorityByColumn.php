<?php

namespace Kanboard\Plugin\PriorityByColumn\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Change Task Priority
 *
 * @package action
 * @author  IxianPixel
 */
class PriorityByColumn extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Change the task priority when the task is moved to another column');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_MOVE_COLUMN,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'priority' => t('Priority'),
            'column_name' => t('Column Name'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'project_id',
            'task_id',
            'column_id',
        );
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        return $this->taskModificationModel->update(array('id' => $data['task_id'], 'priority' => $this->getParam('priority')));
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        $column_id = $this->columnModel->getColumnIdByTitle($data['project_id'], $this->getParam('column_name'));

        if ($data['column_id'] == $column_id) {
            return true;
        }
        else {
            return false;
        }
    }
}
