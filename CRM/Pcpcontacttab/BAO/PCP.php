<?php

class CRM_Pcpcontacttab_BAO_PCP extends CRM_PCP_BAO_PCP {

    public static function getContactPageCount($contact_id) {
        $query = "SELECT count(*) FROM civicrm_pcp WHERE contact_id = %0";
        return CRM_Core_DAO::singleValueQuery($query, [0 => [$contact_id, 'Positive']]);
    }

}