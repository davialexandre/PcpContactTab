<?php

require_once 'CRM/Core/Page.php';

class CRM_Pcpcontacttab_Page_PersonalCampaignPages extends CRM_Core_Page {
  public function run() {
    $status = CRM_PCP_BAO_PCP::buildOptions('status_id', 'create');

    $links = array(
        CRM_Core_Action::UPDATE => array(
            'name' => ts('Edit'),
            'url' => 'civicrm/pcp/info',
            'qs' => 'action=update&reset=1&id=%%id%%&context=dashboard',
            'title' => ts('Edit Personal Campaign Page'),
        )
    );
    $action = array_sum(array_keys($links));

    $contact_id = CRM_Utils_Request::retrieve('cid', 'Positive');
    $pcps = civicrm_api3('PCP', 'get', array('contact_id' => $contact_id));
    $pages = array();
    if(!empty($pcps['values'])) {
      foreach($pcps['values'] as $pcp) {
        $target_entity_info = CRM_Pcpcontacttab_BAO_PCP::getPcpBlockTargetEntityInfo($pcp['id'], $pcp['page_type']);
        $pages[$pcp['id']] = array(
            'id' => $pcp['id'],
            'title' => $pcp['title'],
            'status' => $status[$pcp['status_id']],
            'goal_amount' => $pcp['goal_amount'],
            'page_id' => $pcp['page_id'],
            'page_type' => $pcp['page_type'],
            'page_title' => CRM_PCP_BAO_PCP::getPcpPageTitle($pcp['id'], $pcp['page_type']),
            'number_of_contributions' => CRM_Pcpcontacttab_BAO_PCP::getNumberOfContributions($pcp['id']),
            'amount_raised' => CRM_Pcpcontacttab_BAO_PCP::getAmountRaised($pcp['id']),
            'actions' => CRM_Core_Action::formLink($links, $action, array('id' => $pcp['id'])),
            'target_type' => isset($target_entity_info['type']) ? $target_entity_info['type'] : null,
            'target_id' => isset($target_entity_info['id']) ? $target_entity_info['id'] : null
        );
      }
    }

    $this->assign('pages', $pages);

    parent::run();
  }
}
