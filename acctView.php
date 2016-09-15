<?php
require 'lib/functions.php';

//var_dump(isset($_GET['payment_id'])); die;
if(isset($_GET['payment_id'])){
    delete_payment($_GET['payment_id']);
}
$id = $_GET['id'];
$acctInfo =  $creditorManager->getCreditor($id);

$payments = get_payments($id);

require 'layout/header.php';

?>

<div class="container">
    <h2><?php echo $acctInfo['company_name']?> Account Overview</h2>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">Acct General Info</h3></div>
                <div class="panel-body">
                    <p><strong>Company Name: </strong> <?php echo $acctInfo['company_name']?> </p>
                    <p><strong>Acct No.: </strong> <?php echo $acctInfo['acct_no']?> </p>
                    <p><strong>Phone No.: </strong> <?php echo $acctInfo['phone']?> </p>
                    <p><strong>Web Site: </strong> <?php echo $acctInfo['website']?> </p>
                    <p><strong>Payment Amount: </strong> <?php echo $acctInfo['payment_amount']?> </p>
                    <p><strong>Payment Cycle: </strong> <?php echo $acctInfo['payment_cycle']?> </p>
                    <p><strong>Due Date: </strong> <?php echo $acctInfo['due_date']?> </p>
                    <p><strong>Status: </strong> <?php echo $acctInfo['status']?> </p>
                </div>
            </div>
            <a class="btn btn-primary" href="/debtControl/editCreditor.php?id=<?php echo $id ?>">Edit Creditor</a>
        </div>
    </div>
    <hr>
    <h2>Account History</h2>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-hover table-bordered">
                <thead>
                <tr class="active">
                    <th>Payment Amount</th>
                    <th>Date</th>
                    <th>Balance</th>
                    <th>Notes:</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($payments as $payment) { ?>
                <tr>
                    <th scope="row">$<?php echo $payment['payment_amount']?></th>
                    <td><?php echo $payment['payment_date']?></td>
                    <td>$<?php echo $payment['balance']?></td>
                    <td><?php echo $payment['notes']?></td>
                    <td class="text-center"><a href="/debtControl/acctView.php?id=<?php echo $id ?>&payment_id=<?php echo $payment['payment_id']?>" >
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="/debtControl/addPayment.php?id=<?php echo $id ?>" class="btn btn-primary mb-20">Add Payment</a>
            <a href="/debtControl/addPayment.php?id=<?php echo $id ?>" class="btn btn-primary mb-20">Edit Balance</a>
        </div>
    </div>
</div>
<?php require 'layout/footer.php'; ?>
