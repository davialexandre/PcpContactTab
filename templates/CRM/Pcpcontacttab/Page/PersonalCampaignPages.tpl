<div class="crm-results-block">
    {* show browse table for any action *}
    <div id="pcpcontacttab">
        {strip}
            <table id="options" class="display crm-sortable" data-order='[[3,"desc"]]'>
                <thead>
                    <tr>
                        <th>{ts}Page Title{/ts}</th>
                        <th>{ts}Status{/ts}</th>
                        <th>{ts}Contribution Page / Event{/ts}</th>
                        <th>{ts}No. Contributions{/ts}</th>
                        <th>{ts}Amount Raised{/ts}</th>
                        <th>{ts}Target Amount{/ts}</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>

                {foreach from=$pages item=page}
                    <tr class="{cycle values="odd-row,even-row"}">
                        <td><a href="{crmURL p='civicrm/pcp/info' q="reset=1&id=`$page.id`" fe='true'}" title="{ts}View Personal Campaign Page{/ts}" target="_blank">{$page.title}</a></td>
                        <td>{$page.status}</td>
                        <td>{$page.page_title}</td>
                        <td>{$page.number_of_contributions}</td>
                        <td>{$page.amount_raised|crmMoney}</td>
                        <td>{$page.goal_amount|crmMoney}</td>
                        <td class="nowrap">{$page.actions}</td>
                    </tr>
                {/foreach}
            </table>
        {/strip}
    </div>
</div>
