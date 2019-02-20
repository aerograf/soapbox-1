<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Sbcolumns </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                  </tr>
            </thead><tbody>
            <tr>

                        <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_COLUMNID}></td>       <td><{$sbcolumns.columnID}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_AUTHOR}></td>       <td><{$sbcolumns.author}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_NAME}></td>       <td><{$sbcolumns.name}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_DESCRIPTION}></td>       <td><{$sbcolumns.description}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_TOTAL}></td>       <td><{$sbcolumns.total}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_WEIGHT}></td>       <td><{$sbcolumns.weight}></td>
             </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_COLIMAGE}></td>       <td><img src="<{$xoops_url}>/uploads/soapbox/images/<{$sbcolumns.colimage}>" alt="sbcolumns"></td>
            </tr>
        <tr>  <td><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_CREATED}></td>       <td><{$sbcolumns.created}></td>
             </tr>
        <tr><td><{$smarty.const.MD_SOAPBOX_ACTION}></td>                   <td>
                       <!--<a href="sbcolumns.php?op=view&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbcolumns.php?op=edit&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbcolumns.php?op=delete&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
