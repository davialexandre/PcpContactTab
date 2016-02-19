<?php

require_once 'pcpcontacttab.civix.php';

function pcpcontacttab_civicrm_tabset($tabsetName, &$tabs, $context) {
  if($tabsetName == 'civicrm/contact/view' && isset($context['contact_id'])) {
    $contact_id = (int)$context['contact_id'];
    $tabs['personal_campaign_pages'] = array(
      'title' => ts('Personal Campaign Pages'),
      'url' => CRM_Utils_System::url(
          'civicrm/pcpcontacttab/view',
          'reset=1&cid='.$contact_id
      ),
      'count' => CRM_Pcpcontacttab_BAO_PCP::getContactPageCount($contact_id),
    );
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function pcpcontacttab_civicrm_config(&$config) {
  _pcpcontacttab_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function pcpcontacttab_civicrm_xmlMenu(&$files) {
  _pcpcontacttab_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function pcpcontacttab_civicrm_install() {
  _pcpcontacttab_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function pcpcontacttab_civicrm_uninstall() {
  _pcpcontacttab_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function pcpcontacttab_civicrm_enable() {
  _pcpcontacttab_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function pcpcontacttab_civicrm_disable() {
  _pcpcontacttab_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function pcpcontacttab_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _pcpcontacttab_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function pcpcontacttab_civicrm_managed(&$entities) {
  _pcpcontacttab_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function pcpcontacttab_civicrm_caseTypes(&$caseTypes) {
  _pcpcontacttab_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function pcpcontacttab_civicrm_angularModules(&$angularModules) {
_pcpcontacttab_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function pcpcontacttab_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _pcpcontacttab_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function pcpcontacttab_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function pcpcontacttab_civicrm_navigationMenu(&$menu) {
  _pcpcontacttab_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'br.com.davialexandre.pcpcontacttab')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _pcpcontacttab_civix_navigationMenu($menu);
} // */
