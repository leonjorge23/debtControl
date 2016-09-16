<?php

require_once __DIR__.'/creditorManager.php';

$creditorManager = new creditorManager();

function get_connection(){
    $config = require('config.php');
    // example how to get data from file:
    //$petsJson = file_get_contents('data/pets.json');
    //$pets = json_decode($petsJson, true);

    $pdo = new PDO(
        $config['database_dsg'],
        $config['database_user'],
        $config['database_pass']
    );
    // let us know if there are query errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function save_payment($payment){
    $pdo = get_connection();

    $timestamp = strtotime($payment['payment_date']);

    $statement = $pdo->prepare("INSERT INTO payment(payment_amount, payment_date, notes, balance, acct_id)
    VALUES(:fpayment_amount, from_unixtime($timestamp), :fnotes, :fbalance, :facct_id)");
    $statement->execute(array(
        "fpayment_amount" => $payment['payment_amount'],
        "fnotes" => $payment['notes'],
        "fbalance" => $payment['balance'],
        "facct_id" => $payment['acct_id']
    ));
}

function delete_payment($payment_id){
    $pdo = get_connection();
    $query = 'DELETE FROM payment WHERE payment_id = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $payment_id);
    $stmt->execute();
}

function get_payments($id){
    $pdo = get_connection();

    $query = 'SELECT * from payment WHERE acct_id=' . $id . ' ORDER BY payment_id DESC';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $payments = $stmt->fetchAll();

    return $payments;
}

