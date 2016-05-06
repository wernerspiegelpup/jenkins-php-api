<?php
namespace JenkinsApi\Item;

use JenkinsApi\AbstractItem;
use JenkinsApi\Jenkins;

class Workspace extends AbstractItem
{
    public function __construct($jobName, Jenkins $jenkins)
    {
        $this->_jobName = $jobName;
        $this->_jenkins = $jenkins;
    }

    public function wipeOut()
    {
    	if(!$this->getJenkins()->head($this->getUrl())) {
            throw new RuntimeException(sprintf('Error cleaning workspace of job %s on %s', $this->_jobName, $this->getJenkins()->getBaseUrl()));
        }
    }

    protected function getUrl()
    {
        return sprintf('job/%s/doWipeOutWorkspace', rawurlencode($this->_jobName));
    }
}
