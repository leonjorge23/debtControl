<?php
require 'lib/functions.php';

$creditorStatuses = $creditorManager->getCreditorStatus();
$totalDebt = $creditorManager->sumTotalDebt($creditorStatuses);

?>

<?php require 'layout/header.php'; ?>


<div class="container">
    <h1>Debt Overview</h1>
    <h3>Creditor listing and current balances</h3>
    <div class="row">
        <div class="col-sm-10">
            <div id="totalBalace" class="text-right  mb-20 mt-20">
                <strong>Total Debt: <span class="red-text">$<?php echo $totalDebt ?></span></strong>
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                <tr class="custom-primary ">
                    <th class="hidden"></th>
                    <th>Company Name</th>
                    <th>Last Payment Date</th>
                    <th>Last Payment Amount</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($creditorStatuses as $credior) { ?>
                    <tr>
                        <th class="$id hidden" scope="row"><?php echo $credior['acct_id'] ?></th>
                        <td><?php echo $credior['company_name'] ?></td>
                        <td>
                            <?php if($credior['payment_date']) {
                             echo $credior['payment_date'];
                            }else {
                                echo '';
                            }
                            ?>
                         </td>
                        <td>
                            <?php if($credior['payment_amount']) {
                                echo '$'.$credior['payment_amount'];
                            }else {
                                echo '';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if($credior['balance']) {
                                echo '$'.$credior['balance'];
                            }else {
                              echo  '<a href="/debtControl/acctView.php?id='. $credior['acct_id'] . '">Add balance</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $credior['status']; ?>
                        </td>
                        <td><a href="/debtControl/acctView.php?id=<?php echo $credior['acct_id'] ?>" class="btn btn-sm btn-success">Acct. Details</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
                <a href="/debtControl/addCreditor.php" class="btn btn-primary">Add Creditor</a>
        </div>

    </div>

    <hr>
</div>

<?php require 'layout/footer.php'; ?>