<{if $sbcolumnsRows > 0}>
    <div class="outer">
         <form name="select" action="sbcolumns.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbcolumnsId[]');} else if (isOneChecked('sbcolumnsId[]')) {return true;} else {alert('<{$smarty.const.AM_SBCOLUMNS_SELECTED_ERROR}>'); return false;}">
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



          <table class="$sbcolumns" cellpadding="0" cellspacing="0" width="100%">
            <tr><th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorcolumnID}></th>  <th class="left"><{$selectorauthor}></th>  <th class="left"><{$selectorname}></th>  <th class="left"><{$selectordescription}></th>  <th class="left"><{$selectortotal}></th>  <th class="left"><{$selectorweight}></th>  <th class="left"><{$selectorcolimage}></th>  <th class="left"><{$selectorcreated}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<{foreach item=sbcolumnsArray from=$sbcolumnsArrays}>
<tr class="<{cycle values="odd,even"}>">

<td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbcolumns_id[]"  title ="sbcolumns_id[]" id="sbcolumns_id[]" value="<{$sbcolumnsArray.sbcolumns_id}>" /></td>
<td class='left'><{$sbcolumnsArray.columnID}></td>
<td class='left'><{$sbcolumnsArray.author}></td>
<td class='left'><{$sbcolumnsArray.name}></td>
<td class='left'><{$sbcolumnsArray.description}></td>
<td class='left'><{$sbcolumnsArray.total}></td>
<td class='left'><{$sbcolumnsArray.weight}></td>
<td class='left'><{$sbcolumnsArray.colimage}></td>
<td class='left'><{$sbcolumnsArray.created}></td>


<td class="center width5"><{$sbcolumnsArray.edit_delete}></td>
</tr>
<{/foreach}>
</table>
<br>
<br>
<{else}>
<table width="100%" cellspacing="1" class="outer">
<tr>

<th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorcolumnID}></th>  <th class="left"><{$selectorauthor}></th>  <th class="left"><{$selectorname}></th>  <th class="left"><{$selectordescription}></th>  <th class="left"><{$selectortotal}></th>  <th class="left"><{$selectorweight}></th>  <th class="left"><{$selectorcolimage}></th>  <th class="left"><{$selectorcreated}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<tr>
<td class="errorMsg" colspan="11">There are no $sbcolumns</td>
</tr>
</table>
</div>
<br>
<br>
<{/if}>
