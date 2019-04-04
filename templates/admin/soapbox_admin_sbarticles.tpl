<{if $sbarticlesRows > 0}>
    <div class="outer">
         <form name="select" action="sbarticles.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbarticlesId[]');} else if (isOneChecked('sbarticlesId[]')) {return true;} else {alert('<{$smarty.const.AM_SBARTICLES_SELECTED_ERROR}>'); return false;}">
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



          <table class="$sbarticles" cellpadding="0" cellspacing="0" width="100%">
            <tr><th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorarticleID}></th>  <th class="left"><{$selectorcolumnID}></th>  <th class="left"><{$selectorheadline}></th>  <th class="left"><{$selectorlead}></th>  <th class="left"><{$selectorbodytext}></th>  <th class="left"><{$selectorteaser}></th>  <th class="left"><{$selectoruid}></th>  <th class="left"><{$selectorsubmit}></th>  <th class="left"><{$selectordatesub}></th>  <th class="left"><{$selectorcounter}></th>  <th class="left"><{$selectorweight}></th>  <th class="left"><{$selectorhtml}></th>  <th class="left"><{$selectorsmiley}></th>  <th class="left"><{$selectorxcodes}></th>  <th class="left"><{$selectorbreaks}></th>  <th class="left"><{$selectorblock}></th>  <th class="left"><{$selectorartimage}></th>  <th class="left"><{$selectorvotes}></th>  <th class="left"><{$selectorrating}></th>  <th class="left"><{$selectorcommentable}></th>  <th class="left"><{$selectoroffline}></th>  <th class="left"><{$selectornotifypub}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<{foreach item=sbarticlesArray from=$sbarticlesArrays}>
<tr class="<{cycle values="odd,even"}>">

<td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbarticles_id[]"  title ="sbarticles_id[]" id="sbarticles_id[]" value="<{$sbarticlesArray.sbarticles_id}>" /></td>
<td class='left'><{$sbarticlesArray.articleID}></td>
<td class='left'><{$sbarticlesArray.columnID}></td>
<td class='left'><{$sbarticlesArray.headline}></td>
<td class='left'><{$sbarticlesArray.lead}></td>
<td class='left'><{$sbarticlesArray.bodytext}></td>
<td class='left'><{$sbarticlesArray.teaser}></td>
<td class='left'><{$sbarticlesArray.uid}></td>
<td class='left'><{$sbarticlesArray.submit}></td>
<td class='left'><{$sbarticlesArray.datesub}></td>
<td class='left'><{$sbarticlesArray.counter}></td>
<td class='left'><{$sbarticlesArray.weight}></td>
<td class='left'><{$sbarticlesArray.html}></td>
<td class='left'><{$sbarticlesArray.smiley}></td>
<td class='left'><{$sbarticlesArray.xcodes}></td>
<td class='left'><{$sbarticlesArray.breaks}></td>
<td class='left'><{$sbarticlesArray.block}></td>
<td class='left'><{$sbarticlesArray.artimage}></td>
<td class='left'><{$sbarticlesArray.votes}></td>
<td class='left'><{$sbarticlesArray.rating}></td>
<td class='left'><{$sbarticlesArray.commentable}></td>
<td class='left'><{$sbarticlesArray.offline}></td>
<td class='left'><{$sbarticlesArray.notifypub}></td>


<td class="center width5"><{$sbarticlesArray.edit_delete}></td>
</tr>
<{/foreach}>
</table>
<br>
<br>
<{else}>
<table width="100%" cellspacing="1" class="outer">
<tr>

<th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All"  value="Check All" /></th>  <th class="left"><{$selectorarticleID}></th>  <th class="left"><{$selectorcolumnID}></th>  <th class="left"><{$selectorheadline}></th>  <th class="left"><{$selectorlead}></th>  <th class="left"><{$selectorbodytext}></th>  <th class="left"><{$selectorteaser}></th>  <th class="left"><{$selectoruid}></th>  <th class="left"><{$selectorsubmit}></th>  <th class="left"><{$selectordatesub}></th>  <th class="left"><{$selectorcounter}></th>  <th class="left"><{$selectorweight}></th>  <th class="left"><{$selectorhtml}></th>  <th class="left"><{$selectorsmiley}></th>  <th class="left"><{$selectorxcodes}></th>  <th class="left"><{$selectorbreaks}></th>  <th class="left"><{$selectorblock}></th>  <th class="left"><{$selectorartimage}></th>  <th class="left"><{$selectorvotes}></th>  <th class="left"><{$selectorrating}></th>  <th class="left"><{$selectorcommentable}></th>  <th class="left"><{$selectoroffline}></th>  <th class="left"><{$selectornotifypub}></th>

<th class="center width5"><{$smarty.const.AM_SOAPBOX_FORM_ACTION}></th>
</tr>
<tr>
<td class="errorMsg" colspan="11">There are no $sbarticles</td>
</tr>
</table>
</div>
<br>
<br>
<{/if}>
