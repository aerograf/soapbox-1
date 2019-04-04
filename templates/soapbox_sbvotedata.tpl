<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Sbvotedata </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                  </tr>
            </thead><tbody>
            <tr>

                        <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGID}></td>       <td><{$sbvotedata.ratingid}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_LID}></td>       <td><{$sbvotedata.lid}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGUSER}></td>       <td><{$sbvotedata.ratinguser}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATING}></td>       <td><{$sbvotedata.rating}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGHOSTNAME}></td>       <td><{$sbvotedata.ratinghostname}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBVOTEDATA_RATINGTIMESTAMP}></td>       <td><{$sbvotedata.ratingtimestamp}></td>
             </tr>
        <tr><td><{$smarty.const.MD_SOAPBOX_ACTION}></td>                   <td>
                       <!--<a href="sbvotedata.php?op=view&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbvotedata.php?op=edit&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbvotedata.php?op=delete&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                       <{/if}>
                   </td>
                </tr>
               </tbody>

    </table>
</div>
    <div id="pagenav"><{$pagenav}></div>
    <{$commentsnav}> <{$lang_notice}>
    <{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:soapbox_footer.tpl"}>
