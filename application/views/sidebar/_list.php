<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Sidebar <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-sort-amount-desc"></i> Sidebar
            </li>
        </ol>

        <div class="row">
            <div class="col-sm-12">
                <form action="<?php echo base_url('index.php/sidebar');?>" method="post">
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
                            <th>Judul IND</th>
                            <th>Judul ING</th>
                            <th>Urutan</th>
                            <th>Keyword</th>
                            <th>Created By</th>
                            <th></th>
                        </tr>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript">

    
    $(document).ready(function() {
        var table = $('#example').dataTable( {
            "ajax": BASE_URL+"index.php/sidebar/json",
            "columns": [
               
                { "data": "sidebar_ind" },
                { "data": "sidebar_ing" },
                { "data": "sidebar_urutan" },
                { "data": "keyword" },
                { "data": "users_nama" },
                { 
                    "className": 'text-center',
                    "data": "sidebar_id",
                    "render": function ( data, type, row ) {
                        var name  = "<?php echo $this->security->get_csrf_token_name();?>";
                        var value = "<?php echo $this->security->get_csrf_hash();?>";
                        var url   = "<?php echo base_url('index.php/sidebar');?>";
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
      
    });
</script>