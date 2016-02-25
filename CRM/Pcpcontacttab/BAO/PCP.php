<?php

class CRM_Pcpcontacttab_BAO_PCP extends CRM_PCP_BAO_PCP {

    public static function getContactPageCount($contact_id) {
        try {
            $page_count = civicrm_api3('PCP', 'getcount', array('contact_id' => $contact_id));
        } catch(Exception $e) {
            $page_count = 0;
        }

        return $page_count;
    }

    /**
     * Get pcp block target entity type and id
     *
     * @param int $pcp_id
     * @param $component
     *
     * @return string
     */
    public static function getPcpBlockTargetEntityInfo($pcp_id, $component) {
        $entity_table = self::getPcpEntityTable($component);

        $query = "
SELECT pb.target_entity_type, pb.target_entity_id
FROM civicrm_pcp pcp
LEFT JOIN civicrm_pcp_block pb ON ( pb.entity_id = pcp.page_id AND pb.entity_table = %1 )
WHERE pcp.id = %2 AND pcp.page_type = %3";

        $params = array(
            1 => array($entity_table, 'String'),
            2 => array($pcp_id, 'Integer'),
            3 => array($component, 'String')
        );
        $dao = CRM_Core_DAO::executeQuery($query, $params);
        if ($dao->fetch()) {
            return array(
                'type' => $dao->target_entity_type,
                'id' => $dao->target_entity_id
            );
        }

        return array();
    }

    public static function getNumberOfContributions($pcp_id) {
        try {
            $api_result = civicrm_api3(
                'PCP',
                'getcontributionscount',
                array('pcp_id' => $pcp_id)
            );
            $number_of_contributions = $api_result['result'];
        } catch(\Exception $e) {
            $number_of_contributions = 0;
        }

        return $number_of_contributions;
    }

    public static function getAmountRaised($pcp_id) {
        try {
            $api_result = civicrm_api3(
                'PCP',
                'getamountraised',
                array('pcp_id' => $pcp_id)
            );
            $amount_raised = $api_result['result'];
        } catch(\Exception $e) {
            $amount_raised = 0;
        }

        return $amount_raised;
    }
}