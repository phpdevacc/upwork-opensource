<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<div class="page animsition">
    <div class="page-header">
        <div class="page-header">
            <h1 class="page-title"><?php echo $title; ?></h1>
            <div class="page-header-actions">
                <ol class="breadcrumb">
                    <li>
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><?php echo $loadpage; ?></a>
                    </li>
                    <li class="active">
                        <?php echo $title; ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="page-content">
            <!-- Panel -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <form class="col-xs-12" action="" method="get" id="searchfilter" style="padding-left: 0;">
                    <div class="row">
                        <div class="col-sm-12 col-md-11">
                            <div class="col-md-3 col-sm-3" style="padding-left: 0;">
                                <label class="col-xs-12">From</label>
                                <input type="text" class="form-control"   id="selectedDate-1" name="from" value='<?= $from ?>'/>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label class="col-xs-12">To</label>
                                <input type="text" class="form-control"   id="selectedDate-2" name="to" value='<?= $to ?>' />
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label class="col-xs-12">&nbsp;</label>
                                <div class="selector" id="uniform-user_type">
                                    <select id="user_type" name="user_type" class="form-control">
                                        <option value="1" <?= ($user_type == 1 ? 'selected' : '' ) ?>>ID</option>
                                        <option value="3" <?= ($user_type == 3 ? 'selected' : '' ) ?>>Username</option>
                                        <option value="2" <?= ($user_type == 2 ? 'selected' : '' ) ?>>Email</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label class="col-xs-12">&nbsp;</label>
                                <input type="text" class="form-control"   name="criteria" value='<?= $criteria ?>' />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-1 text-center" style="padding-left: 0;">
                            <label class="col-xs-12">&nbsp;</label>
                            <button class="btn btn-primary" id="payfilter" type="submit">Search</button>
                        </div>
                    </div>
                </form>    
                
                <div class="table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th> No </th>
                                <th> ID </th>
                                <th> Date </th>
                                <th width="30%"> Details </th>
                                <th> Username/email </th>
                                <th> Transaction
                                    <br/>Through </th>
                                <th> Amount $</th>
                                <th>status</th>
                                <th>Action
                                    <br/>payment
                                    <br>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($record as $key => $value) : ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><?= $key+1; ?></td>
                                    <td><?= $value['id']; ?></td>
                                    <td><?= date('m/d/Y', strtotime( ( strtolower($value['status_payment']) == WITHDRAW_PROCESSED ? $value['operation_date'] : $value['date'] ) ) ); ?></td>
                                    <td>
                                        <table>
                                            <tr><td>

                                                <b>Name:</b>
                                                <?= $value['name']; ?>
                                            </td>
                                            </tr>
                                            <tr><td>

                                                <b>Account Balance:</b>
                                                <?= '$' . $payment_model->get_amount_available( $value['webuser_id'] );  ?>
                                            </td>
                                            </tr>
                                            <tr><td>

                                                <b><?= $value['payment_type']; ?> Account:</b>
                                               <?= $value['email_payment']; ?>
                                            </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= $value['payment_type']; ?></td>
                                    <td><?= $value['amount']; ?></td>
                                    <td>
                                        <span id="<?= 'td'.$value['id'];?>"><?= ucwords($value['status_payment']); ?></span>
                                        <?php if(strtolower($value['status_payment']) == WITHDRAW_PENDING): ?>
                                            <input type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-circle-o'></i>" data-size="normal" id="<?="check-".$value['id']?>" value="<?="check-".$value['id']?>" class="status-toggle" >
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="selector" id="uniform-user_type" style="width: 100px;">
                                            <?php if(strtolower($value['status_payment']) == WITHDRAW_PENDING): ?>
                                            <select id="user_type" name="user_type" class="form-control status-select" key="<?= $value['id'] ?>">
                                                <option value="">Select value</option>
                                                <option value="1" >Edit</option>
                                                <option value="3">Pending</option>
                                                <option value="2">Processed</option>
                                            </select>
                                        </div>
                                        <h5>Pay Now</h5>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        
        $('#selectedDate-1').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom'
        });
        
        $('#selectedDate-2').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom'
        });
        
        $('#example').DataTable({
            bFilter: false,
        });

        $('.status-select').on("change", function(){
            var id = this.getAttribute("key");
            var flag = false;
            if(this.value == 2 && !$('#check-'+id).checked)
                flag = changestatus(id);

            if(!flag)
                $(this).val("");
            else{
                $(this).prop('disabled',true);
                $("#td"+id).html('Processed');
                $('#check-'+id).bootstrapToggle('on');
                $('#check-'+id).bootstrapToggle('disable');
            }
        });

    } );



    $('.status-toggle').on("change",function(){
        if(this.checked){
            var op = $(this).val().split("-");
            var flag = false;

            if($("[key="+op[1]+"]").val() != 2)
               flag = changestatus(op[1]);

            if(!flag)
                this.bootstrapToggle('off');
            else{
                $("[key="+op[1]+"]").val(2);
                $("[key="+op[1]+"]").prop('disabled',true);
                $("#td"+op[1]).html('Processed');
                $(this).bootstrapToggle('disable');
            }
        }
    });

    function changestatus(id){
        var result = confirm('Are you sure ?');

            if(result){

                $.ajax({
                url:"<?php echo site_url('withdraw/withdrawstatus'); ?>",
                type: "post",
                dataType: "html",
                data: ({id: id}),
                success: function (data) {
                    var json = $.parseJSON(data);
                    if (json.success) {
                            $('.form-loader').hide();
                            $('.result-msg').html(json.message);
                            $(".result-msg").show().delay(5000).fadeIn();
                            //var total = $('#total_work_time').val();
                            $('#check-'+id).attr('disabled',true);
                        }
                        else {
                            alert('nada');
                            $('.result-msg').html(json.message);
                            $(".result-msg").show().delay(5000).fadeOut();
                            alert('Opps!! Something went wrong.');
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
                return true;
            }else{
                return false;
            }
    }



</script>
<style>
    .dataTables_length {
  display: none;
}
.dataTables_info {
  float: left;
  margin-bottom: 25px;
}
.dataTables_paginate.paging_simple_numbers {
  float: right;
  position: relative;
  top: 0;
  width: auto;
}
#example_paginate a {
  padding: 5px;
}
.facd {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border-bottom: 1px solid #929292;
  border-right: 1px solid #929292;
  border-top: 1px solid #929292;
  display: block;
  float: none;
  overflow: hidden;
  padding: 0;
}
td {
    vertical-align: middle !important;
}
</style>
