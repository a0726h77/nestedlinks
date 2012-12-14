<?php

class NestedlinksWebModule extends WebModule {
    protected $id = 'nestedlinks';

    protected function getModuleAdminSections()
    {
        $sections = parent::getModuleAdminSections();

        foreach ($this->getFeedGroups() as $feedgroup=>$data)
        {
            $sections['feeds-'.$feedgroup] = array(
                /* 'title'=>$data['title'], */
                'title'=>$feedgroup,
                'type'=>'module hidden'
            );
        }

        return $sections;
    }

    protected function getModuleAdminConfig()
    {
        $configData = parent::getModuleAdminConfig();

        foreach ($this->getFeedGroups() as $feedgroup=>$data)
        {
            $feedData = $configData['feed'];
            $feedData['title'] = $data['title'];
            $feedData['config'] = 'feeds-' . $feedgroup;
            $feedData['configMode'] = ConfigFile::OPTION_CREATE_EMPTY;
            $configData['feeds-'.$feedgroup] = $feedData;
        }
        unset($configData['feed']);

        return $configData;
    }

    public function getFeedGroups()
    {
        return $this->getModuleSections('feedgroups');
    }

    protected function getLinks()
    {
        $groupData = array();
        foreach ($this->getFeedGroups() as $groupID => $groupSettings)
        {
            $configName = "feeds-$groupID";
            $groupData[$groupSettings['title']] = $this->getModuleSections($configName);
        }
        return $groupData;
    }

    protected function initializeForPage()
    {
        switch ($this->page)
        {
        case 'index':
            $linkGroups = $this->getLinks();
            $this->assign('linkGroups', $linkGroups);
            break;
        }
    }
}
