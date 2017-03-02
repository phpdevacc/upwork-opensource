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
                <!--<h2><?php echo $title; ?></h2>-->
                <div class="first">
                    <h3><?php echo $title; ?></h3>
                    <h4> Search by user name   </h4>
                    <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">A</div>
                        <div class="btn-group" role="group" aria-label="...">B</div>
                        <div class="btn-group" role="group" aria-label="...">C</div>
                        <div class="btn-group" role="group" aria-label="...">D</div>
                        <div class="btn-group" role="group" aria-label="...">E</div>
                        <div class="btn-group" role="group" aria-label="...">F</div>
                        <div class="btn-group" role="group" aria-label="...">G</div>
                        <div class="btn-group" role="group" aria-label="...">H</div>
                        <div class="btn-group" role="group" aria-label="...">I</div>
                        <div class="btn-group" role="group" aria-label="...">J</div>
                        <div class="btn-group" role="group" aria-label="...">K</div>
                        <div class="btn-group" role="group" aria-label="...">L</div>
                        <div class="btn-group" role="group" aria-label="...">M</div>
                        <div class="btn-group" role="group" aria-label="...">N</div>
                        <div class="btn-group" role="group" aria-label="...">O</div>
                        <div class="btn-group" role="group" aria-label="...">P</div>
                        <div class="btn-group" role="group" aria-label="...">Q</div>
                        <div class="btn-group" role="group" aria-label="...">R</div>
                        <div class="btn-group" role="group" aria-label="...">S</div>
                        <div class="btn-group" role="group" aria-label="...">T</div>
                        <div class="btn-group" role="group" aria-label="...">U</div>
                        <div class="btn-group" role="group" aria-label="...">V</div>
                        <div class="btn-group" role="group" aria-label="...">W</div>
                        <div class="btn-group" role="group" aria-label="...">X</div>
                        <div class="btn-group" role="group" aria-label="...">Y</div>
                        <div class="btn-group" role="group" aria-label="...">Z</div>



                    </div>

                </div>
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <div class="secound">
                    <div class="fabb">
                        Date
                    </div>

                    <div class="fad">
                        To
                    </div>

                    <div class="fabb">
                        Date
                    </div>

                    <div class="faff">
                        SEARCH
                    </div>
                </div>
                <div class="third">
                    <div class="fab">
                        <div class="selector" id="uniform-user_type" style="width: 100px;">
                            <select id="user_type" name="user_type" class="form-control">
                                <option value="">ID</option>

                                <option value="3">
                                    Username</option>
                                <option value="2">Email</option>


                            </select>
                        </div>
                    </div>

                    <div class="fad">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </div>

                    <div class="fae">
                    </div>

                    <div class="faf">
                        SEARCH
                    </div>
                </div>

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
                                    <td><?= date('m/d/Y', strtotime($value['date'])); ?></td>
                                    <td>
                                        <table>
                                            <tr><td>

                                                <b>Name:</b>
                                                <?= $value['name']; ?>
                                            </td>
                                            </tr>
                                            <tr><td>

                                                <b>Account Balance:</b>
                                                2
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
                                        <input type="checkbox" data-toggle="toggle" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-circle-o'></i>" data-size="normal" id="<?="check-".$value['id']?>" value="<?="check-".$value['id']?>" class="status-toggle" >
                                    </td>
                                    <td>
                                        <div class="selector" id="uniform-user_type" style="width: 100px;">
                                            <select id="user_type" name="user_type" class="form-control status-select" key="<?= $value['id'] ?>">
                                                <option value="">Select value</option>
                                                <option value="1" >Edit</option>

                                                <option value="3">Pending</option>
                                                <option value="2">Processed</option>
                                            </select>
                                        </div>
                                        <h5>Pay Now</h5>
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
;
}
</style>
