<?php

class creditorManager
{
    public function getCreditors(){
        $pdo = get_connection();

        $query = 'SELECT * from creditor';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $creditors = $stmt->fetchAll();

        return $creditors;

    }

    public function getCreditor($id){
        $pdo = get_connection();
        $query = 'SELECT * FROM creditor WHERE acct_id = :idVal';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('idVal', $id);
        $stmt->execute();

        $creditor = $stmt->fetch();

        return $creditor;
    }

    public function saveCreditor($creditor){

        $pdo = get_connection();

        $statement = $pdo->prepare("INSERT INTO creditor(company_name, acct_no, phone, website, payment_amount, payment_cycle, due_date, status)
    VALUES(:fcompany_name, :facct_no, :fphone, :fwebsite, :fpayment_amount, :fpayment_cycle, :fdue_date, :fstatus)");
        $statement->execute(array(
            "fcompany_name" => $creditor['company_name'],
            "facct_no" => $creditor['acct_no'],
            "fphone" => $creditor['phone'],
            "fwebsite" => $creditor['website'],
            "fpayment_amount" => $creditor['payment_amount'],
            "fpayment_cycle" => $creditor['payment_cycle'],
            "fdue_date" => $creditor['due_date'],
            "fstatus" => $creditor['status']
        ));
    }

    public function updateCreditor($creditor){

        $pdo = get_connection();

        $id = $creditor['acct_id'];
        $id = (int)$id;

        $statement = $pdo->prepare("UPDATE creditor SET 
    company_name = :fcompany_name,
    acct_no = :facct_no,
    phone = :fphone,
    website = :fwebsite,
    payment_amount = :fpayment_amount,
    payment_cycle = :fpayment_cycle,
    due_date = :fdue_date,
    status = :fstatus
    WHERE acct_id = :facct_id");
        $statement->bindValue(':facct_id', $id, PDO::PARAM_INT);
        $statement->bindValue(':fcompany_name', $creditor['company_name'], PDO::PARAM_STR);
        $statement->bindValue(':facct_no', $creditor['acct_no'], PDO::PARAM_STR);
        $statement->bindValue(':fphone', $creditor['phone'], PDO::PARAM_STR);
        $statement->bindValue(':fwebsite', $creditor['website'], PDO::PARAM_STR);
        $statement->bindValue(':fpayment_amount', $creditor['payment_amount'], PDO::PARAM_STR);
        $statement->bindValue(':fpayment_cycle', $creditor['payment_cycle'], PDO::PARAM_STR);
        $statement->bindValue(':fdue_date', $creditor['due_date'], PDO::PARAM_STR);
        $statement->bindValue(':fstatus', $creditor['status'], PDO::PARAM_STR);
        $statement->execute();
    }

    public function getCreditorStatus(){
        $pdo = get_connection();

        $query = 'SELECT t1.company_name, t1.acct_id, t2.payment_date, t2.payment_amount, t2.balance From creditor t1 LEFT JOIN payment t2 ON t1.acct_id = t2.acct_id ORDER BY t2.payment_date DESC';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $creditorStatuses = $stmt->fetchAll();

        return $creditorStatuses;
    }

    public function sumTotalDebt($debt){
        $total = 0;
        foreach($debt as $creditor){
            $total = $total  + $creditor['balance'];
        }
        return $total;
    }
}