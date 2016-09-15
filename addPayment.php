<?php
require 'lib/functions.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['payment_amount'])){
        $payment_amount = $_POST['payment_amount'];
    }else {
        $payment_amount = '';
    }

    if(isset($_POST['payment_date'])){
        $payment_date = $_POST['payment_date'];
    }else {
        $payment_date = '';
    }

    if(isset($_POST['balance'])){
        $balance= $_POST['balance'];
    }else {
        $balance = '';
    }

    if(isset($_POST['notes'])){
        $notes = $_POST['notes'];
    }else {
        $notes = '';
    }

    if(isset($_POST['acct_id'])){
        $acct_id = $_POST['acct_id'];
    }else {
        $acct_id = '';
    }

    $newPayment = array(
        "payment_amount" => $payment_amount,
        "payment_date" => $payment_date,
        "balance" => $balance,
        "notes" => $notes,
        "acct_id" => $acct_id
    );


    save_payment($newPayment);
    header('Location: /debtControl/acctView.php?id=' . $acct_id );
    die;
}else {
    $id = $_GET['id'];
    $creditor = $creditorManager->getCreditor($id);
}
require 'layout/header.php';


?>
    <div class="container">
        <h2>Add Payment to <?php echo $creditor['company_name'] ?></h2>

        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" action="/debtControl/addPayment.php" method="POST">
                    <input name="acct_id" class="hidden" value="<?php echo $id ?>"/>
                    <div class="form-group">
                        <label for="payment_amount" class="col-sm-3 control-label">Amount: </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input name="payment_amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_date" class="col-sm-3 control-label">Date:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="payment_date" id="payment_date" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="balance" class="col-sm-3 control-label">Balance:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input name="balance" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="balance" class="col-sm-3 control-label">Notes:</label>
                        <div class="col-sm-9">
                          <textarea name="notes" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Add Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require 'layout/footer.php'; ?>