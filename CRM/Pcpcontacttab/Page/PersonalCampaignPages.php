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
    $params[] = [$contact_id, 'Integer'];
    $result = CRM_Core_DAO::executeQuery("
      SELECT pcp.id,
        pcp.title,
        pcp.status_id,
        pcp.goal_amount,
        pcp.page_id,
        pcp.page_type,
        COALESCE(cp.title, e.title) as page_title,
        COUNT(cs.id) as number_of_contributions,
        SUM(cs.amount) as amount_raised
      FROM civicrm_pcp pcp
        LEFT JOIN civicrm_contribution_page cp ON pcp.page_id = cp.id AND pcp.page_type = 'contribute'
        LEFT JOIN civicrm_event e ON pcp.page_id = e.id AND pcp.page_type = 'event'
        LEFT JOIN civicrm_contribution_soft cs ON pcp.id = cs.pcp_id
      WHERE pcp.contact_id = %0
      GROUP BY pcp.id
    ", $params);
    $pages = array();
    while($result->fetch()) {
      $pages[$result->id] = array(
        'id' => $result->id,
        'title' => $result->title,
        'status' => $status[$result->status_id],
        'goal_amount' => $result->goal_amount,
        'page_id' => $result->page_id,
        'page_type' => $result->page_type,
        'page_title' => $result->page_title,
        'number_of_contributions' => $result->number_of_contributions,
        'amount_raised' => is_null($result->amount_raised) ? 0 : $result->amount_raised,
        'actions' => CRM_Core_Action::formLink($links, $action, array('id' => $result->id))
      );
    }
    $this->assign('pages', $pages);

    parent::run();
  }
}
