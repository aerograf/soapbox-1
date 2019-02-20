<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_SOAPBOX_COLUMNID}></th>
        <th><{$smarty.const.MB_SOAPBOX_AUTHOR}></th>
        <th><{$smarty.const.MB_SOAPBOX_NAME}></th>
        <th><{$smarty.const.MB_SOAPBOX_DESCRIPTION}></th>
        <th><{$smarty.const.MB_SOAPBOX_TOTAL}></th>
        <th><{$smarty.const.MB_SOAPBOX_WEIGHT}></th>
        <th><{$smarty.const.MB_SOAPBOX_COLIMAGE}></th>
        <th><{$smarty.const.MB_SOAPBOX_CREATED}></th>
    </tr>
    <{foreach item=sbcolumns from=$block}>
        <tr class = "<{cycle values = 'even,odd'}>">
            <td>
            <{$sbcolumns.columnID}>
            <{$sbcolumns.author}>
            <{$sbcolumns.name}>
            <{$sbcolumns.description}>
            <{$sbcolumns.total}>
            <{$sbcolumns.weight}>
            <{$sbcolumns.colimage}>
            <{$sbcolumns.created}>
            </td>
        </tr>
    <{/foreach}>
</table>