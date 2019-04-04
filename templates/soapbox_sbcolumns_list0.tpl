<{include file="db:soapbox_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Sbcolumns</strong> </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                    <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_COLUMNID}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_AUTHOR}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_NAME}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_DESCRIPTION}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_TOTAL}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_WEIGHT}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_COLIMAGE}></th>  <th><{$smarty.const.MD_SOAPBOX_SBCOLUMNS_CREATED}></th><th  width="10%"><{$smarty.const.MD_SOAPBOX_ACTION}></th>
            </tr>
            </thead>
        <{foreach item=sbcolumns from=$sbcolumns}>
            <tbody>
            <tr>

                             <td><{$sbcolumns.columnID}></td>
                    <td><{$sbcolumns.author}></td>
                    <td><{$sbcolumns.name}></td>
                    <td><{$sbcolumns.description}></td>
                    <td><{$sbcolumns.total}></td>
                    <td><{$sbcolumns.weight}></td>
                    <td><img src="<{$xoops_url}>/uploads/soapbox/thumbs/<{$sbcolumns.colimage}>" style="max-width:100px" alt="sbcolumns"></td>
                   <td><{$sbcolumns.created}></td>
                                <td>
                       <a href="sbcolumns.php?op=view&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;
                       <{if $xoops_isadmin == true}>
                       <a href="admin/sbcolumns.php?op=edit&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" /></a>
                       &nbsp;<a href="admin/sbcolumns.php?op=delete&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
