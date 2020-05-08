<?php 
 /**
 * @category   sms sender
 * @author   Hosein_Beheshti
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use mysqli;
use Thread;

/** 
* DatabaseController is a class that include 
* connect() and report() functions
* for connect to database and work with it
*/

class DatabaseController extends Controller
{
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $databaseName = "db_sytado";

	//a constructor for DatabaseControll$r class
	//that create a database and a table if there is not exist
	public function __construct(){
		//Our database specifications

		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//Create database
		$sql = "CREATE DATABASE db_sytado CHARACTER SET utf8 COLLATE utf8_general_ci";
		if ($conn->query($sql) === TRUE) {
		    // echo "database created successfully";
		    $conn->close();

		} else {
		    // echo "Error creating database: " . $conn->error;
		    $conn->close();
		}
		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->databaseName);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//*************************************************************************CREATE TABLES

		// Create table customer
		$sql = 
		"CREATE table customer (
		customer_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		firstName varchar(255) NOT NULL,
		lastName varchar(255) NOT NULL,
		nationalCode varchar(255) NOT NULL,
		phoneNumber varchar(255) NOT NULL,
		age int(3) NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table customer created successfully";
		} else {
		   echo "Error creating customer table: " . $conn->error;
		}
		// Create table address
		$sql = 
		"CREATE table address (
		address_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		addressName varchar(255) NOT NULL,
		address varchar(255) NOT NULL,
		phone bigint(20) NOT NULL,
		customer_id bigint(10) NOT NULL,
		Foreign key(customer_id ) references customer(customer_id) on delete cascade
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table address created successfully";
		} else {
		   echo "Error creating address table: " . $conn->error;
		}		
		// Create table delivery
		$sql = 
		"CREATE table delivery(
		delivery_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		firstName varchar(255) NOT NULL,
		lastName varchar(255) NOT NULL,
		nationalCode varchar(255) NOT NULL,
		phoneNumber varchar(255) NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table delivery created successfully";
		} else {
		   echo "Error creating delivery table: " . $conn->error;
		}	
		// Create table order_factor
		$sql = 
		"CREATE table order_factor(
		factor_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		address_id bigint(10) ,
		customer_id bigint(10) ,
		delivery_id bigint(10) ,
		totalPrice varchar(255) NOT NULL default 0,
		date DATE not null,
		Foreign key(customer_id) references customer(customer_id) ON DELETE SET NULL,
		Foreign key(address_id) references address(address_id) ON DELETE SET NULL,
		Foreign key(delivery_id) references delivery(delivery_id) ON DELETE SET NULL
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table order_factor created successfully";
		} else {
		   echo "Error creating order_factor table: " . $conn->error;
		}	
		// Create table food_list
		$sql = 
		"CREATE table food_list(
		factor_id bigint(10) NOT NULL,
		food varchar(255) NOT NULL,
		price varchar(255) NOT NULL,
		Foreign key(factor_id) references order_factor(factor_id)
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table food_list created successfully";
		} else {
		   echo "Error creating food_list table: " . $conn->error;
		}	
		// Create table menu
		$sql = 
		"CREATE table menu(
		food varchar(255) PRIMARY KEY,
		price varchar(255) NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table menu created successfully";
		} else {
		   echo "Error creating menu table: " . $conn->error;
		}	
		// Create table store
		$sql = 
		"CREATE table store(
		store_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		storeName varchar(255) NOT NULL,
		valid boolean NOT NULL DEFAULT 1
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table store created successfully";
		} else {
		   echo "Error creating store table: " . $conn->error;
		}	
		// Create table material_factor
		$sql = 
		"CREATE table material_factor(
		material_factor_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
		store_id bigint(10) NOT NULL,
		totalPrice varchar(255) NOT NULL default 0,
		date DATE not null,
		Foreign key(store_id) references store(store_id)
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table material_factor created successfully";
		} else {
		   echo "Error creating store material_factor: " . $conn->error;
		}	
		// Create table material_list
		$sql = 
		"CREATE table material_list(
		material_factor_id bigint(10) NOT NULL,
		material varchar(255) NOT NULL,
		price varchar(255) NOT NULL,
		Foreign key(material_factor_id) references material_factor(material_factor_id)
		)";

		if ($conn->query($sql) === TRUE) {
		     echo "Table material_list created successfully";
		} else {
		   echo "Error creating store material_list: " . $conn->error;
		}	
		//*************************************************************************CREATE TABLES


	}
	/**
	* this function connect to our database
	*
	* @param $servername 
	* @param $username
	* @param $password
	* @param $databaseName
	* @return $conn an object
	*/
	public function connect(){

	$conn = new mysqli($this->servername, $this->username, $this->password, $this->databaseName);

	if($conn->connect_error){
		die(" connection failed " . $conn->connect_error);
	}
	else{
		//echo "connected to database successfully"
	}
	return $conn;
	}

	
	//*************************************************************************INSERT
	//insert into customer table
	public function insert_customer($firstName, $lastName, $nationalCode, $phoneNumber, $age){
	$conn = $this->connect();
	$sql = "INSERT INTO customer(firstName, lastName, nationalCode, phoneNumber, age) VALUES('$firstName', '$lastName' , '$nationalCode', '$phoneNumber',  $age)";
	if ($conn->query($sql) === TRUE){
		echo " inserted to customer table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in customer table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into address table
	public function insert_address($addressName, $address, $phone, $customer_id){
	$conn = $this->connect();
	$sql = "INSERT INTO address(addressName, address, phone, customer_id) VALUES('$addressName', '$address' , '$phone', '$customer_id')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to address table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in address table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into delivery table
	public function insert_delivery($firstName, $lastName, $nationalCode, $phoneNumber){
	$conn = $this->connect();
	$sql = "INSERT INTO delivery(firstName, lastName, nationalCode, phoneNumber) VALUES('$firstName', '$lastName' , '$nationalCode', '$phoneNumber')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to delivery table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in delivery table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into order_factor table
	public function insert_order_factor($address_id, $customer_id, $delivery_id, $totalPrice, $date){
	$conn = $this->connect();

	$address_id = !empty($address_id) ? "'$address_id'" : "NULL";
	$customer_id = !empty($customer_id) ? "'$customer_id'" : "NULL";
	$delivery_id = !empty($delivery_id) ? "'$delivery_id'" : "NULL";


	$sql = "INSERT INTO order_factor(address_id, customer_id, delivery_id, totalPrice, date) VALUES($address_id, $customer_id , $delivery_id, '$totalPrice', '$date')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to order_factor table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in order_factor table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into food_list table
	public function insert_food_list($factor_id, $food, $price){
	$conn = $this->connect();

	$sql = "INSERT INTO food_list(factor_id, food, price) VALUES($factor_id, '$food' , '$price')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to food_list table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in food_list table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into menu table
	public function insert_menu($food, $price){
	$conn = $this->connect();

	$sql = "INSERT INTO menu(food, price) VALUES('$food' , '$price')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to menu table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in menu table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into store table
	public function insert_store($storeName){
	$conn = $this->connect();

	$sql = "INSERT INTO store(storeName) VALUES('$storeName')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to store table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in store table ";
	}
	$conn->close();

	return new Response();
	}

	//insert into material_factor table
	public function insert_material_factor($store_id, $totalPrice, $date){
	$conn = $this->connect();

	$sql = "INSERT INTO material_factor(store_id, totalPrice, date) VALUES($store_id, '$totalPrice', '$date')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to material_factor table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in material_factor table ";
	}
	$conn->close();

	return new Response();
	}
	
	//insert into material_list table
	public function insert_material_list($material_factor_id, $material, $price){
	$conn = $this->connect();

	$sql = "INSERT INTO material_list(material_factor_id, material, price) VALUES($material_factor_id, '$material' , '$price')";
	if ($conn->query($sql) === TRUE){
		echo " inserted to material_list table ";

	} else{
		echo $conn->query($sql);
		echo " can not insert in material_list table ";
	}
	$conn->close();

	return new Response();
	}


	//*************************************************************************Update
	//update customer table
	public function update_customer($customer_id, $firstName, $lastName, $nationalCode, $phoneNumber, $age){
	$conn = $this->connect();
	$sql = "UPDATE customer SET firstName = '$firstName' , lastName = '$lastName' , nationalCode = '$nationalCode', phoneNumber = '$phoneNumber' , age = $age WHERE customer_id = $customer_id";
	if ($conn->query($sql) === TRUE){
		echo " updated customer table ";

	} else{
		echo $conn->query($sql);
		echo " can not update customer table ";
	}
	$conn->close();

	return new Response();
	}

	//update menu table
	public function update_menu($food, $price){
	$conn = $this->connect();

	$sql = "UPDATE menu SET price = '$price' WHERE food = '$food'";
	if ($conn->query($sql) === TRUE){
		echo " updated menu table ";

	} else{
		echo $conn->query($sql);
		echo " can not update menu table ";
	}
	$conn->close();

	return new Response();
	}

	//update store
	public function update_store($storeName){
	$conn = $this->connect();

	$sql = "UPDATE store SET valid = 0 where storeName = '$storeName'";
	if ($conn->query($sql) === TRUE){
		echo " update store table ";

	} else{
		echo $conn->query($sql);
		echo " can not update store table ";
	}
	$conn->close();

	return new Response();
	}
	//update delivery table
	public function update_delivery($delivery_id, $firstName, $lastName, $nationalCode, $phoneNumber){
	$conn = $this->connect();
	$sql =  "UPDATE delivery SET firstName = '$firstName' , lastName = '$lastName' , nationalCode = '$nationalCode', phoneNumber = '$phoneNumber'WHERE delivery_id = $delivery_id";
	if ($conn->query($sql) === TRUE){
		echo " updated delivery table ";

	} else{
		echo $conn->query($sql);
		echo " can not update delivery table ";
	}
	$conn->close();

	return new Response();
	}
	//**************************************************************************Delete
	//delete from customer table
	public function delete_customer($customer_id){
	$conn = $this->connect();
	$sql = "DELETE FROM customer WHERE customer_id = $customer_id";
	if ($conn->query($sql) === TRUE){
		echo " delete from customer ";

	} else{
		echo $conn->query($sql);
		echo " can not delete from customer table ";
	}
	$conn->close();

	return new Response();
	}

	//delete menu table
	public function delete_menu($food){
	$conn = $this->connect();

	$sql = "DELETE from menu WHERE food = '$food'";
	if ($conn->query($sql) === TRUE){
		echo " delete from menu table ";

	} else{
		echo $conn->query($sql);
		echo " can not delete from menu table ";
	}
	$conn->close();

	return new Response();
	}

	// //update store
	// public function delete_store($storeName){
	// $conn = $this->connect();

	// $sql = "UPDATE store SET valid = 0 where storeName = '$storeName'";
	// if ($conn->query($sql) === TRUE){
	// 	echo " update store table ";

	// } else{
	// 	echo $conn->query($sql);
	// 	echo " can not update store table ";
	// }
	// $conn->close();

	// return new Response();
	// }
	//delete delivery table
	public function delete_delivery($delivery_id){
	$conn = $this->connect();
	$sql =  "DELETE FROM delivery WHERE delivery_id = $delivery_id";
	if ($conn->query($sql) === TRUE){
		echo " delete from delivery table ";

	} else{
		echo $conn->query($sql);
		echo " can not delete from delivery table ";
	}
	$conn->close();

	return new Response();
	}
	//**************************************************************************Select
	//get total purchase for a customer
	public function select_totalPurchase($customer_id){
	$conn = $this->connect();

	$sql = "SELECT SUM(totalPrice) as value_sum
			FROM order_factor
			where customer_id = $customer_id";

	$sum = 0;
	if ($result = $conn->query($sql)){
		// echo " inserted to order_factor table ";
			while ($row = $result->fetch_assoc()) {
			$sum += $row['value_sum'];
			}	
		//echo "result is = ";
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $sum;
	}
	//get favorite food for a customer
	public function select_favoriteFood($customer_id){
	$conn = $this->connect();

	$sql = "SELECT food , MAX(c) as max
			from (select list.food as food , COUNT(*) as c
					from food_list as list , order_factor as factor
					where list.factor_id = factor.factor_id and factor.customer_id = 1
					GROUP BY list.food) as tbl
    		";

	$favorite;
	if ($result = $conn->query($sql)){
		// echo " inserted to order_factor table ";
			while ($row = $result->fetch_assoc()) {
			$favorite = $row['food'];
			}	
		//echo "result is = ";
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $favorite;
	}
	//get daily sales
	public function select_totalDailySales($date){
	$conn = $this->connect();

	$sql = "SELECT SUM(totalPrice) as value_sum
			FROM order_factor
			where date = '$date'";

	$sum = 0;
	if ($result = $conn->query($sql)){
		// echo " inserted to order_factor table ";
			while ($row = $result->fetch_assoc()) {
			$sum += $row['value_sum'];
			}	
		echo "total daily sales is = ";
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $sum;
	}

	//get daily sales
	public function select_listOfDailySales($date){
	$conn = $this->connect();

	$sql = "SELECT list.food as food , list.price as price
			from order_factor as factor , food_list as list
			where factor.factor_id = list.factor_id and factor.date = '$date'";

	$food ;
	$price ;
	if ($result = $conn->query($sql)){
		echo "select_listOfDailySales :" ;
			while ($row = $result->fetch_assoc()) {
			$food = $row['food'];
			echo $food;
			$price =  $row['price'];
			echo $price;
			}	
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return new Response();
	}

	//get daily sales
	public function select_totalDailyPurchase($date){
	$conn = $this->connect();

	$sql = "SELECT SUM(totalPrice) as value_sum
			FROM material_factor
			where date = '$date'";

	$sum = 0;
	if ($result = $conn->query($sql)){
		// echo " inserted to order_factor table ";
			while ($row = $result->fetch_assoc()) {
			$sum += $row['value_sum'];
			}	
		echo "total daily purchase is = ";
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $sum;
	}
	//select list of daily purchase
	public function select_listOfDailyPurchase($date){
	$conn = $this->connect();

	$sql = "SELECT list.material as material , list.price as price
			from material_factor as factor , material_list as list
			where factor.material_factor_id = list.material_factor_id and factor.date = '$date'";

	$material ;
	$price ;
	if ($result = $conn->query($sql)){
		echo "select_listOfDailyPurchase :" ;
			while ($row = $result->fetch_assoc()) {
			$material = $row['material'];
			echo $material;
			$price =  $row['price'];
			echo $price;
			}	
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return new Response();
	}
	//select customers
	public function select_allCustomers(){
	$conn = $this->connect();

	$sql = "SELECT * from customer";

	$rec = array();
	$records = array();
	if ($result = $conn->query($sql)){
		echo "selected all customer",
  			  $counter =0;
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['customer_id'];
			$count++;
			$rec[$count] = $row['firstName'];
			$count++;
			$rec[$count] = $row['lastName'];
			$count++;
			$rec[$count] = $row['phoneNumber'];
			$count++;
			$rec[$count] = $row['nationalCode'];
			$count++;
			$rec[$count] = $row['age'];
			$records[$counter] = $rec;
			$counter++;
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $records;
	}
	//select deliveries
	public function select_allDeliveries(){
	$conn = $this->connect();

	$sql = "SELECT * from delivery";

	$rec = array();
	$records = array();
	if ($result = $conn->query($sql)){
		echo "selected all delivery",
  			  $counter =0;
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['delivery_id'];
			$count++;
			$rec[$count] = $row['firstName'];
			$count++;
			$rec[$count] = $row['lastName'];
			$count++;
			$rec[$count] = $row['phoneNumber'];
			$count++;
			$rec[$count] = $row['nationalCode'];
			$records[$counter] = $rec;
			$counter++;
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $records;
	}

	//select customer with id
	public function select_customers($customer_id){
	$conn = $this->connect();

	$sql = "SELECT * from customer where customer_id = $customer_id";

	$rec = array();
	if ($result = $conn->query($sql)){
		echo "selected all customer";
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['customer_id'];
			$count++;
			$rec[$count] = $row['firstName'];
			$count++;
			$rec[$count] = $row['lastName'];
			$count++;
			$rec[$count] = $row['phoneNumber'];
			$count++;
			$rec[$count] = $row['nationalCode'];
			$count++;
			$rec[$count] = $row['age'];
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $rec;
	}
	//select delivery with id
	public function select_delivery($delivery_id){
	$conn = $this->connect();

	$sql = "SELECT * from delivery where delivery_id = $delivery_id";

	$rec = array();
	if ($result = $conn->query($sql)){
		echo "selected one delivery";
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['delivery_id'];
			$count++;
			$rec[$count] = $row['firstName'];
			$count++;
			$rec[$count] = $row['lastName'];
			$count++;
			$rec[$count] = $row['phoneNumber'];
			$count++;
			$rec[$count] = $row['nationalCode'];
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $rec;
	}
	//select customer_id
	public function select_customer_id($phoneNumber){
	$conn = $this->connect();

	$sql = "SELECT customer_id from customer where phoneNumber = '$phoneNumber' ";

	$customer_id;
	if ($result = $conn->query($sql)){
			while ($row = $result->fetch_assoc()) {
				$customer_id = $row['customer_id'];
				// echo "roowww";
				// echo $row;
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $customer_id;
	}
	//select menu
	public function select_allMenu(){
	$conn = $this->connect();

	$sql = "SELECT * from menu ";

	$rec = array();
	$records = array();
	if ($result = $conn->query($sql)){
		echo "selected all menu",
  			  $counter =0;
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['food'];
			$count++;
			$rec[$count] = $row['price'];
			$records[$counter] = $rec;
			$counter++;
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $records;
	}

	//select all address
	public function select_allAddress(){
	$conn = $this->connect();

	$sql = "SELECT * from address ";

	$rec = array();
	$records = array();
	if ($result = $conn->query($sql)){
		echo "selected all address",
  			  $counter =0;
			while ($row = $result->fetch_assoc()) {
				$count = 0;
			$rec[$count] = $row['address_id'];
			$count++;
			$rec[$count] = $row['addressName'];
			$count++;
			$rec[$count] = $row['address'];
			$records[$counter] = $rec;
			$count++;
			$rec[$count] = $row['phone'];
			$records[$counter] = $rec;
			$count++;
			$rec[$count] = $row['customer_id'];
			$records[$counter] = $rec;
			$counter++;
			}
		}
	 else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $records;
	}

	//select price with name of food
	public function select_foodPrice($food){
	$conn = $this->connect();

	$sql = "SELECT price
			FROM menu
			where food = '$food'";
	$price = 0;	
	if ($result = $conn->query($sql)){
		// echo " inserted to order_factor table ";
			while ($row = $result->fetch_assoc()) {
			$price = $row['price'];
			}	
		//echo $sum;

	} else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $price;
	}
	//select factor id
	public function select_order_factor_id(){
	$conn = $this->connect();

	$sql = "SELECT *FROM order_factor ";
    if ($result = $conn->query($sql)){
    	$last_id = mysqli_num_rows($result);
    } else{
		// echo $conn->query($sql);
		// echo " can not insert in order_factor table ";
	}
	$conn->close();

	return $last_id;
	}






	//***************************************************************************************



    /**
     * @Route("/report")
     *
     * this function get datas from database and returns a html page to show reports
	 * @return a html page
     */  
    public function report()
    {
    //call connect function
	$conn = $this->connect();

	//select from database
	$sql = "SELECT *FROM tbl_sms ";
    if ($result = $conn->query($sql)){
    	$last_id = mysqli_num_rows($result);
    }
    //number used from API_1
    $serverone = 0 ;
    //number used from API_2
    $servertwo = 0 ;
	//API_1 error percentage
	$serveronefaults = 0;
	//API_2 error percentage
    $servertwofaults = 0;

    //select datas from database
    $sql = "SELECT serverstatus FROM tbl_sms where serverstatus = 1 ";
    if ($result = $conn->query($sql)){
    	$serverone = mysqli_num_rows($result);
    }
    $sql = "SELECT serverstatus FROM tbl_sms where serverstatus = 2 ";
    if ($result = $conn->query($sql)){
    	$servertwo = mysqli_num_rows($result);
    	$serveronefaults = mysqli_num_rows($result);
    }
    $servertwofaults += $last_id - ($serverone + $servertwo);
   	$serveronefaults += $last_id - ($serverone + $servertwo);

    //calculate percentage
    $serveronefaults = 100 * $serveronefaults/($serverone + $serveronefaults);
    if($servertwofaults > 0)
    $servertwofaults = 100 * $servertwofaults/($servertwofaults + $servertwo);

    //select data from database and use of GROUP BY to get 10 most used phone numbers
    $sql = "SELECT mobile,COUNT(message)
			FROM tbl_sms  
			GROUP BY mobile 
			";

	$number_arr = array();
	$topNumbers = array();
	if ($result = $conn->query($sql)){
		
		while ($row = $result->fetch_assoc()) {
			$number_arr += [$row['mobile'] => $row['COUNT(message)']];
			}	
		arsort($number_arr);

    }

    $counter =0;
	foreach ($number_arr as $key => $value) {
		$topNumbers[$counter] = array($key,$value);
		    $counter++;
	    if ($counter>9){
	    	break;
	    }
    }
    // var_dump($topNumbers);

	$conn->close();

	 //render report page and passing variables to show
	 return $this->render('view/report.html.twig',['last_id' => $last_id , 'serverone' => $serverone , 'servertwo' => $servertwo 
	 	, 'serveronefaults' => $serveronefaults , 'servertwofaults' => $servertwofaults , 'topnumbers' => $topNumbers ]);
  	} 
  	
 	



}
 ?>