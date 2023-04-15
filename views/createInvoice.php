<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm" data-sidebar-image="none">

<head>

    <title>Invoice</title>
    <?php include('incHeader.php'); ?>
    <link rel="stylesheet" type="text/css" media="print" href="mystyle.css">
    <style>
        @media print {
            p.bodyText {
                font-family: georgia, times, serif;
            }

            .staticRow {
                display: none;
            }

            .printInvoice {
                display: none;
            }

            #dynamic_field tr th:last-child,
            #dynamic_field tr td:last-child {
                display: none;
            }

            .disctype {
                display: none;
            }

            input {
                border: none;
            }

            .table>:not(caption)>*>* {
                background-color: #f06548 !important;
            }
        }
    </style>
</head>

<body>

    <div id="layout-wrapper">

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box align-items-center justify-content-between">
                                <h4 class="mb-sm-0 text-center">Create Invoice</h4>


                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xxl-9">
                            <div class="card p-3" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <span class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded" style="width: 200px;">
                                                <img src="https://www.polussoftware.com/wp-content/uploads/thegem-logos/logo_fc174601fa452742244829a9945bb221_1x.png" class="card-logo card-logo-dark user-profile-image img-fluid" alt="logo dark">
                                                <img src="https://www.polussoftware.com/wp-content/uploads/thegem-logos/logo_fc174601fa452742244829a9945bb221_1x.png" class="card-logo card-logo-light user-profile-image img-fluid" alt="logo light">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <td width="50%">Product Name</td>
                                                <td width="10%">Qty</td>
                                                <td width="10%">Price (in $)</td>
                                                <td width="10%">Tax %</td>
                                                <td width="15%">Total Price</td>
                                                <td width="5%"></td>
                                            </tr>
                                        </table>

                                        <table class="table staticRow">
                                            <tr class="odd dynamic_row gradeA">
                                                <td width="50%">
                                                    <input type="text" class="form-control" id="productName" name="productName" value="<?php echo set_value('productName'); ?>">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control unitPrice" id="unitPrice" name="unitPrice" value="<?php echo set_value('unitPrice'); ?>" onkeyup="showNetAmount()">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control qty" id="qty" name="qty" value="<?php echo set_value('qty'); ?>" onkeyup="showNetAmount()">
                                                </td>
                                                <td width="10%">
                                                    <select name="taxP" id="taxP" class="form-control taxP" onchange="showNetAmount()">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control totalAmount" id="totalAmount" name="totalAmount" value="<?php echo set_value('totalAmount'); ?>" readonly>
                                                </td>
                                                <td width="5%">
                                                    <button type="button" name="add" id="add" class="btn btn-success">+</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <div class="row float-right">
                                    <div class="col-lg-6 col-xl-6">
                                        <table class="table table-borderless table-sm table-nowrap align-middle mb-0 f-td-r">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Sub Total $<small class="text-muted"></small></th>
                                                    <td>
                                                        <input type="hidden" class="form-control border-0" id="subTotalH" value="0" />
                                                        <input type="hidden" class="form-control border-0" id="subTotalWTH" value="0" />
                                                        <input type="text" class="form-control border-0" id="subTotal" name="subTotal" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Discount $<small class="text-muted"></small><br><br>
                                                        <div class="disctype">
                                                            <input type="radio" name="discType" id="discPerc" value="%" checked><label for="discPerc">%</label>
                                                            <input type="radio" name="discType" id="discAmnt" value="$"><label for="discAmnt">$</label>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <input type="text" class="form-control border-0" id="discount" name="discount" placeholder="0.00" onkeyup="calculateTotal()" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub Total with Tax $<small class="text-muted"></small></th>
                                                    <td>
                                                        <input type="text" class="form-control border-0" id="subTotalWT" name="subTotalWT" placeholder="0.00" readonly />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="alert" role="alert" id="validateMsg"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-end">
                                            <button type="button" id="printInvoice" value="submit" class="btn btn-primary printInvoice" onclick="window.print()">Generate invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>



    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <?php include('incScript.php'); ?>
    <script type="text/javascript">
        function showNetAmount() {
            var unitPrice = $('#unitPrice').val();
            var qty = $('#qty').val();
            var taxP = $('#taxP').val();
            var totalAmount = Number(unitPrice) * Number(qty);

            var net_amount = totalAmount + (totalAmount * taxP / 100);
            $('#totalAmount').val(net_amount.toFixed(2));
        }

        $(document).ready(function() {
            var i = 0;
            $('#add').click(function() {
                i++;
                var productName = $('#productName').val();
                var unitPrice = $('#unitPrice').val();
                var qty = $('#qty').val();
                var taxP = $('#taxP').val();
                var totalAmount = Number(unitPrice) * Number(qty);
                var net_amount = totalAmount + (totalAmount * taxP / 100);

                var subTotal = $('#subTotal').val();
                var subTotalWT = $('#subTotalWT').val();
                var discAmnt = ($('#discAmnt').val() > 0) ? $('#discAmnt').val() : 0;
                var grandTotal = $('#grandTotal').val();

                if (productName.trim().length == 0) {
                    alert('Please Enter Product Name.');
                    return false;
                }
                if (unitPrice.trim().length == 0 || isNaN(unitPrice)) {
                    alert('Please Enter Unit Price.');
                    return false;
                }
                if (qty.trim().length == 0 || isNaN(qty)) {
                    alert('Please Enter Quantity.');
                    return false;
                }

                console.log(subTotal)
                console.log(subTotalWT)
                console.log(totalAmount)
                console.log(net_amount)

                $('#dynamic_field').append(`
                <tr id="row` + i + `" class="odd dynamic_row gradeA">
                    <td title="` + productName + `">
                        <input type="text" class="form-control" id="productName[]" name="productName[]" value="` + productName + `" readonly />
                    </td>
                    <td>
                        <input type="text"  class="form-control unitPrice" id="unitPrice[]" name="unitPrice[]" value=` + unitPrice + ` readonly />
                    </td>
                    <td>
                        <input type="text"  class="form-control qty" id="qty[]" name="qty[]" value=` + qty + ` readonly />
                    </td>
                    <td width="10%"> 
                    <input type="text"  class="form-control taxP" id="taxP[]" name="taxP[]" value=` + taxP + ` readonly />

                    </td>
                    <td>
                        <input type="text"  class="form-control net_amount" id="net_amount` + i + `" name="net_amount[]" value=` + net_amount + ` readonly />
                    </td>
                    <td>
                        <button type="button" name="remove" id="` + i + `" class="btn btn-danger btn_remove" style="background-color: #f06548;">X</button>
                    </td>
                </tr>
            `);
                calculateTotal();


                $('#productName').val('');
                $('#unitPrice').val('');
                $('#qty').val('');
                $('#taxP').val('0');
                $('#totalAmount').val('');

            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                calculateTotal();
            });

        });
        $('input[name=discType]').change(function() {
            calculateTotal();
        })

        function calculateTotal() {
            var subTotal = 0,
                totalTax = 0;

            $('#dynamic_field .dynamic_row').each(function(i, row) {
                var $tr = $(row);

                var qty = +$tr.find('.qty').val();
                var price = +$tr.find('.unitPrice').val();
                var tax = +$tr.find('.taxP').val();

                var total = price * qty;
                var tax = total * tax / 100;

                subTotal += total;
                totalTax += tax;
            });

            var discAmnt = (+$('#discount').val() > 0 && !isNaN($('#discount').val())) ? +$('#discount').val() : 0;
            var discType = $('input[name=discType]:checked').val();
            if (discType == '%') {
                discAmnt = subTotal * discAmnt / 100;
            }

            $('#subTotal').val((subTotal - discAmnt).toFixed(2));
            $('#subTotalWT').val((subTotal + totalTax - discAmnt).toFixed(2));
        }
    </script>
</body>

</html>