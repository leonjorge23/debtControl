<?php
require 'lib/functions.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['company_name'])){
        $company_name = $_POST['company_name'];
    }else {
        $company_name = '';
    }

    if(isset($_POST['acct_no'])){
        $acct_no = $_POST['acct_no'];
    }else {
        $acct_no = '';
    }

    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
    }else {
        $phone = '';
    }

    if(isset($_POST['website'])){
        $website = $_POST['website'];
    }else {
        $website = '';
    }

    if(isset($_POST['payment_amount'])){
        $payment_amount = $_POST['payment_amount'];
    }else {
        $payment_amount= 0;
    }

    if(isset($_POST['payment_cycle'])){
        $payment_cycle = $_POST['payment_cycle'];
    }else {
        $payment_cycle = '';
    }

    if(isset($_POST['due_date'])){
        $due_date = $_POST['due_date'];
    }else {
        $due_date = '';
    }
    if(isset($_POST['status'])){
        $status = $_POST['status'];
    }else {
        $status = '';
    }


    $newCreditor = array(
        "company_name" => $company_name,
        "acct_no" => $acct_no,
        "phone" => $phone,
        "website" => $website,
        "payment_amount" => $payment_amount,
        "payment_cycle" => $payment_cycle,
        "due_date" => $due_date,
        "status" => $status
    );


    $creditorManager->saveCreditor($newCreditor);
    header('Location: /debtControl/debtOverview.php');
    die;
}


require 'layout/header.php';
?>
<div class="container">
    <h2>Add New Creditor</h2>

    <div class="row">
        <div class="col-sm-8">
            <form class="form-horizontal" action="/debtControl/addCreditor.php" method="POST">
                <div class="form-group">
                    <label for="company_name" class="col-sm-3 control-label">Company Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="acct_no" class="col-sm-3 control-label">Account No.:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="acct_no" id="acct_no" placeholder="Acct #">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Phone No.:</label>
                    <div class="col-sm-9">
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone #">
                    </div>
                </div>
                <div class="form-group">
                    <label for="website" class="col-sm-3 control-label">Website:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="website" id="website" placeholder="website">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_amount" class="col-sm-3 control-label">Payment Amount:</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="payment_amount" id="payment_amount" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_cycle" class="col-sm-3 control-label">Payment Cycle:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="payment_cycle" id="payment_cycle">
                            <option value="monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Bi-Weekly">Bi-Weekly</option>
                            <option value="one payment">one payment</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="due_date" class="col-sm-3 control-label">Due Date:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="due_date" id="due_date" placeholder="e.g. 8th">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Status:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status" id="status">
                            <option value="Outstanding">Outstanding</option>
                            <option value="Paid">Paid</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary">Save Creditor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'layout/footer.php'; ?>
