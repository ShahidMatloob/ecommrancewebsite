<?php
$title = "Cupon Code";



?>
        <!-- ============================================================== -->
        <!-- Header  -->
        <!-- ============================================================== -->

        <?php include 'inc/header.php' ?>  

        <!-- ============================================================== -->
        <!-- End Header  -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Sidebar  -->
        <!-- ============================================================== -->
        <?php include 'inc/sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- End Sidebar  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?php echo $title ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="deashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="m-t-15">Cupon Code </label>
                                        <input type="text" name="coupon_code" class="form-control" placeholder="-">
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="m-t-15">Click To Generate</label>
                                        <input type="button" value="Generate Cupon Code" class="btn btn-default" onclick="randomStringToInput(this)">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="m-t-15">Discount Ammount</label>
                                        <input type="number" class="form-control" placeholder="-">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-3 m-t-15">Discount Type</label>
                                        <select class="form-control" style="width: 100%; height:36px;">
                                                <option value="No Value Selected" Style="display:none">--Select--</option>
                                                <option value="fixed ammount">Fixed Ammount (Rs)</option>
                                                <option value="percent">Percent (%)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="m-t-15">Usage Limit per Cupon</label>
                                        <input type="number" class="form-control" placeholder="-">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-3 m-t-15">Usage Limit per User</label>
                                        <input type="number" class="form-control" placeholder="-">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="m-t-15">Cupon Expiry Date</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body text-right">
                                    <button type="button" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Cupon Codes</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for($count = 0; $count <= 9; $count++) { ?>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->











            
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
<script>
function randomStringToInput(clicked_element)
{
    var self = $(clicked_element);
    var random_string = generateRandomString(6);
    $('input[name=coupon_code]').val(random_string);
}

function generateRandomString(string_length)
{
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var string = '';

    for(var i = 0; i <= string_length; i++)
    {
        var rand = Math.round(Math.random() * (characters.length - 1));
        var character = characters.substr(rand, 1);
        string = string + character;
    }

    return string;
}
</script>