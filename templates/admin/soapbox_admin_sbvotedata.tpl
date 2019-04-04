<{if $sbvotedataRows > 0}>
    <div class="outer">
         <form name="select" action="sbvotedata.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbvotedataId[]');} else if (isOneChecked('sbvotedataId[]')) {return true;} else {alert('<{$smarty.const.AM_SBVOTEDATA_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1"/>
            <div class="floatleft">
                   <select name="op">
                       <option value=""><{$smarty.const.AM_SOAPBOX_SELECT}></option>
                       <option value="delete"><{$smarty.const.AM_SOAPBOX_SELECTED_DELETE}></option>
                   </select>
                   <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>"  />
               </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>



          <table class="$sbvotedata" cellpadding="0" cellspacing="0" width="100%">
            <tr><th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorratingid}></th>  <th class="left"><{$selectorlid}></th>  <th class="left"><{$selectorratinguser}></th>  <th class="left"><{$selectorrating}></th>  <th class="left"><{$selectorratinghostname}></th>  <th class="left"><{$selectorratingtimestamp}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<{foreach item=sbvotedataArray from=$sbvotedataArrays}>
<tr class="<{cycle values="odd,even"}>">

<td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbvotedata_id[]"  title ="sbvotedata_id[]" id="sbvotedata_id[]" value="<{$sbvotedataArray.sbvotedata_id}>" /></td>
<td class='left'><{$sbvotedataArray.ratingid}></td>
<td class='left'><{$sbvotedataArray.lid}></td>
<td class='left'><{$sbvotedataArray.ratinguser}></td>
<td class='left'><{$sbvotedataArray.rating}></td>
<td class='left'><{$sbvotedataArray.ratinghostname}></td>
<td class='left'><{$sbvotedataArray.ratingtimestamp}></td>


<td class="center width5"><{$sbvotedataArray.edit_delete}></td>
</tr>
<{/foreach}>
</table>
<br>
<br>
<{else}>
<table width="100%" cellspacing="1" class="outer">
<tr>

<th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorratingid}></th>  <th class="left"><{$selectorlid}></th>  <th class="left"><{$selectorratinguser}></th>  <th class="left"><{$selectorrating}></th>  <th class="left"><{$selectorratinghostname}></th>  <th class="left"><{$selectorratingtimestamp}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<tr>
<td class="errorMsg" colspan="11">There are no $sbvotedata</td>
</tr>
</table>
</div>
<br>
<br>
<{/if}>
