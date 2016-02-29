Personal Campaign Pages Contact Tab
===================================

This extension adds a tab to the the Contact summary, which shows 
all the PCPs the contact has created.

Known issues
------------
This extension contains an incomplete implementation of the PCP API. It is just an example of how it could be implemented and it has some actions specific to the extension.

I found that CiviCRM has some problems dealing with APIs which the entity name is all in uppercase. This extension's API will work, but it will thrown some Notices about a missing p_c_p_id index. For it to work perfectly, it would be necessary a small change to the `_civicrm_api_get_entity_name_from_camel` function, inside `civicrm/api/api.php`, and then change the `p_c_p` part in the API function names to `pcp`.
