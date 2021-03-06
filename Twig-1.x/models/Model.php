<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author h14sshak
 */
class Model {
    public function getAllCars() {
        try {
        //vilken databasserver och databasnamn ska användas
        $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
        $username = 'db06';
        $password = 'Oy9CkDSJ';
        //1.öppnar uppkoppling, en "connection" mot databasen
        $pdocon = new PDO($dsn, $username, $password);
        //2. preparerar en sql fråga med hjälp av PDO(pdocon) objekt
        //och dess metod prepare som returnerar ett pdoStatement objekt
        //$pdoStatement = $pdocon->prepare('SELECT * FROM bilar');
        // anrop av stored procedures
        $pdoStatement = $pdocon->prepare('CALL getAllaBilar()');
        //3. exekverar frågan med hjälp av pdoStatementobjektet och dess metod execute
        $pdoStatement->execute();
        //.4 hämtar resultatet till en array med hjälp av pdoStatement objekt
        //och dess metod fetchAll
        $cars = $pdoStatement->fetchAll();
        //5. stänger uppkopplingen
        return $cars;
        }catch (PDOException $pdoexp) {
        //vid fel kastas ett nytt som kontroller får ta hand om
        $pdocon = NULL;
        throw new Exception('Databasfel - gick inte att hämta alla bilar');
    }
}
}
