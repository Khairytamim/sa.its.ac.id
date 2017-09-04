<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Artikel <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-align-left"></i> Artikel
            </li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <form action="<?php echo base_url('index.php/artikel');?>" method="post">
                <input type="hidden" name="task" value="1" />
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <button type="submit" class="btn btn-primary btn-sm" name="tambah" value="1"><i class="fa fa-plus"></i> Tambah</button>
                </form>
            </div>
        </div>


        <div class="row" style="margin-top:10px;">
            <div class="col-sm-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Judul IND</th>
                            <!-- <th>Judul ING</th>
                            <th>Post Date</th> -->
                            <th>Post By</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    function format (oTable, nTr) {
        // `d` is the original data object for the row
        var d = oTable.fnGetData( nTr );
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr >'+
                '<td style="width: 100px;"><strong>Content Ing:</strong></td>'+
                '<td style="padding-top:10px;padding-left:10px;">'+d.artikel_ing+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td style="width: 100px;"><strong>Content Ind:</strong></td>'+
                '<td style="padding-top:10px;padding-left:10px;">'+d.artikel_ind+'</td>'+
            '</tr>'+
        '</table>';
    }

    $(document).ready(function() {
        var table = $('#example').dataTable( {
            "ajax": BASE_URL+"index.php/artikel/json",
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data":   null,
                    "defaultContent": ''
                },
                { "data": "judul_ind", "width": 600 },
                // { "data": "judul_ing" },
                {  "data": "artikel_time",
                    render:function(data, full, row){
                        var tanggal = data.split(" ");
                        return tanggal[0];
                    }
                },
                // { "data": "users_nama" },
                {
                    "className": 'text-center',
                    "data": "artikel_id",
                    "render": function ( data, type, row ) {
                        var name  = "<?php echo $this->security->get_csrf_token_name();?>";
                        var value = "<?php echo $this->security->get_csrf_hash();?>";
                        var url   = "<?php echo base_url('index.php/artikel');?>";
                        var form  = '<form action="'+url+'" method="post">';
                            form += '<input type="hidden" name="task" value="3" />';
                            form += '<input type="hidden" name="'+name+'" value="'+value+'" />';
                            form += '<input type="hidden" name="id" value="'+data+'" />';
                            form += '<button type="submit" name="ubah"  value="ubah"  class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Ubah</button>';
                            form += '&nbsp;';
                            form += '<button type="submit" name="hapus" value="hapus" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
                            form += '</form>';
                        return form;
                    },
                    "targets": 0
                },
            ],
            "order": [[1, 'asc']]
        });

        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr')[0];
            if ( table.fnIsOpen(tr) ) {
                // This row is already open - close it
                table.fnClose( tr );
                $(this).parents('tr').removeClass('shown');
            }
            else {
                // Open this row
                table.fnOpen( tr, format(table, tr), 'details' );
                $(this).parents('tr').addClass('shown');
            }
        });
    });
</script>
