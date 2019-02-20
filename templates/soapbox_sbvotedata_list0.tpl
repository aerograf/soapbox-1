<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Sbvotedata</strong> </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                    <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_LID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGUSER}></th>  <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATING}></th>  <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGHOSTNAME}></th>  <th><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGTIMESTAMP}></th><th  width="10%"><{$smarty.const.MD_SOAPBOX_ACTION}></th>
            </tr>
            </thead>
        <{foreach item=sbvotedata from=$sbvotedata}>
            <tbody>
            <tr>

                             <td><{$sbvotedata.ratingid}></td>
                    <td><{$sbvotedata.lid}></td>
                    <td><{$sbvotedata.ratinguser}></td>
                    <td><{$sbvotedata.rating}></td>
                    <td><{$sbvotedata.ratinghostname}></td>
                    <td><{$sbvotedata.ratingtimestamp}></td>
                                <td>
                       <a href="sbvotedata.php?op=view&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbvotedata.php?op=edit&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbvotedata.php?op=delete&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                       <{/if}>
                   </td>
                </tr>
               </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav}>
    <{$commentsnav}> <{$lang_notice}>
    <{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:soapbox_footer.tpl"}>
