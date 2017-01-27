<!-- BEGIN: main -->
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="20px">{LANG.select}</th>
            <th>{LANG.quession_title}</th>
            <th width="150px" class="text-center">{LANG.album_feature}</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: row -->
        <tr>
            <td class="text-center"><input type='checkbox' class='filelist' value="{id}"></td>
            <td>{title}</td>
            <td class="text-center">
                <a class='editfile btn btn-xs btn-info' href="{URL_EDIT}"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;{LANG.edit}</a>
                <a class='delfile btn btn-xs btn-danger' href="{URL_DEL_ONE}"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;{LANG.album_delete}</a>
            </td>
        </tr>
        <!-- END: row -->
    </tbody>
</table>
</div>
<div class="m-top">
    <a href='javascript:void(0);' id='checkall' class="btn btn-xs btn-default"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;{LANG.album_checkall}</a>
    <a href='javascript:void(0);' id='uncheckall' class="btn btn-xs btn-default"><i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp;{LANG.album_uncheckall}</a>
    <a href="{LINK_ADD}" class="addfile btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{LANG.album_add}</a>
    <a id='delfilelist' href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;{LANG.album_delete}</a>
</div>
<script type="text/javascript">
$(function() {
    $('#checkall').click(function() {
        $('input:checkbox').each(function() {
            $(this).attr('checked', 'checked');
        });
    });

    $('#uncheckall').click(function() {
        $('input:checkbox').each(function() {
            $(this).removeAttr('checked');
        });
    });

    $('#delfilelist').click(function() {
        if (confirm("{LANG.album_del_confirm}")) {
            var listall = [];
            $('input.filelist:checked').each(function() {
                listall.push($(this).val());
            });
            if (listall.length < 1) {
                alert("{LANG.album_error_file}");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{URL_DEL}',
                data: 'listall=' + listall,
                success: function(data) {
                    alert(data);
                    window.location = '{URL_DEL_BACK}';
                }
            });
        }
    });
    $('a.delfile').click(function(event) {
        event.preventDefault();
        if (confirm("{LANG.album_del_confirm}")) {
            var href = $(this).attr('href');
            $.ajax({
                type: 'POST',
                url: href,
                data: '',
                success: function(data) {
                    alert(data);
                    window.location = '{URL_DEL_BACK}';
                }
            });
        }
    });
});
</script>
<!-- END: main -->
