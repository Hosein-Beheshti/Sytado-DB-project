<?php 
 /**
 * @category   restaurant management
 * @author   Hosein Beheshti
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use mysqli;
use Thread;
use Exception;



class SendingController extends Controller
{
	
	/**
	 * @Route("/")
	 *
	 * this function returns welcome page
	 * @return html file
	 */
    public function welcomePage()
    {
        return $this->render('view/welcome.html.twig');
    }
    	/**
	 * @Route("/welcome")
	 *
	 * this function returns welcome page
	 * @return html file
	 */
    public function welcomePage2()
    {
    	 $databaseController = new DatabaseController();
    	 $databaseController->select_allCustomers();
       return $this->render('view/welcome.html.twig');
    }
    //************************************************************************************User
    /**
	 * @Route("/addUserPage")
	 *
	 * this function returns add user page
	 * @return html file
	 */
    public function addUserPage()
    {
        return $this->render('view/addUser.html.twig');
    }
        /**
	 * @Route("/removeUserPage")
	 *
	 * this function returns remove user page
	 * @return html file
	 */
    public function removeUserPage()
    {
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_allCustomers();
        return $this->render('view/removeUser.html.twig', ['records' => $records]);
    }
     /**
	 * @Route("/updateUserPage1")
	 *
	 * this function returns update user page
	 * @return html file
	 */
    public function updateUserPage1()
    {
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_allCustomers();
        return $this->render('view/updateUser1.html.twig', ['records' => $records]);
    }
     /**
	 * @Route("/updateUserPage2")
	 *
	 * this function returns update user page
	 * @return html file
	 */
    public function updateUserPage2(Request $request)
    {
    	$customer_id = $request->get('id');
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_customers($customer_id);
    	$id = $records[0];
    	$firstName = $records[1];
    	$lastName = $records[2];
    	$phoneNumber = $records[3];
    	$nationalCode = $records[4];
    	$age = $records[5];

     return $this->render('view/updateUser2.html.twig', ['firstName' => $firstName , 'lastName' => $lastName , 
     	'phoneNumber' => $phoneNumber ,'nationalCode' => $nationalCode ,'age' => $age, 'customer_id' => $id]);
    }
     /**
	 * @Route("/updateUser")
	 *
	 * this function returns remove user page
	 * @return html file
	 */
    public function updateUser(Request $request)
    {
    	$databaseController = new DatabaseController();
    	$number = $request->get('Number');
		$firstName = $request->get('firstName');
		$lastName = $request->get('lastName');
		$nationalCode = $request->get('nationalCode');
		$age = $request->get('age');
		$customer_id = $request->get('id');



	$databaseController->update_customer($customer_id, $firstName, $lastName, $nationalCode, $number, $age);


        return $this->render('view/welcome.html.twig');
    }

     /**
	 * @Route("/removeUser")
	 *
	 * this function returns remove user page
	 * @return html file
	 */
    public function removeUser(Request $request)
    {
		$customer_id = $request->get('id');
		echo $customer_id;
    	$databaseController = new DatabaseController();
    	$databaseController->delete_customer($customer_id);
    	$records =  $databaseController->select_allCustomers();
    	return $this->render('view/removeUser.html.twig', ['records' => $records]);
    }

    /**
	 * @Route("/addUser")
	 *
	 * @param $request is an object
	 * @return html file
	 */
    public function addUser(Request $request)
    {
    $databaseController = new DatabaseController();

    //geting phone number and text message from request that sent from our welcome page
	$number = $request->get('Number');
	$firstName = $request->get('firstName');
	$lastName = $request->get('lastName');
	$nationalCode = $request->get('nationalCode');
	$age = $request->get('age');

	$databaseController->insert_customer($firstName, $lastName, $nationalCode, $number, $age);

	$customer_id = $databaseController->select_customer_id($number);
	$addressName = $request->get('addressName');
	$address = $request->get('address');
	$phone = $request->get('phone');

	$databaseController->insert_address($addressName, $address, $phone, $customer_id);
	       return $this->render('view/addUser.html.twig');
	}


	//****************************************************************************************delivery
	    /**
	 * @Route("/addDeliveryPage")
	 *
	 * this function returns add delivery page
	 * @return html file
	 */
    public function addDeliveryPage()
    {
        return $this->render('view/addDelivery.html.twig');
    }
        /**
	 * @Route("/removeDeliveryPage")
	 *
	 * this function returns remove Delivery page
	 * @return html file
	 */
    public function removeDeliveryPage()
    {
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_allDeliveries();
        return $this->render('view/removeDelivery.html.twig', ['records' => $records]);
    }
     /**
	 * @Route("/updateDeliveryPage1")
	 *
	 * this function returns update user page
	 * @return html file
	 */
    public function updateDeliveryPage1()
    {
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_allDeliveries();
        return $this->render('view/updateDelivery1.html.twig', ['records' => $records]);
    }
     /**
	 * @Route("/updateDeliveryPage2")
	 *
	 * this function returns update user page
	 * @return html file
	 */
    public function updateDeliveryPage2(Request $request)
    {
    	$delivery_id = $request->get('id');
    	$records = array();
    	$databaseController = new DatabaseController();
    	$records =  $databaseController->select_delivery($delivery_id);
    	$id = $records[0];
    	$firstName = $records[1];
    	$lastName = $records[2];
    	$phoneNumber = $records[3];
    	$nationalCode = $records[4];

     return $this->render('view/updateDelivery2.html.twig', ['firstName' => $firstName , 'lastName' => $lastName , 
     	'phoneNumber' => $phoneNumber ,'nationalCode' => $nationalCode , 'delivery_id' => $id]);
    }
     /**
	 * @Route("/updateDelivery")
	 *
	 * this function returns remove user page
	 * @return html file
	 */
    public function updateDelivery(Request $request)
    {
    	$databaseController = new DatabaseController();
    	$number = $request->get('Number');
		$firstName = $request->get('firstName');
		$lastName = $request->get('lastName');
		$nationalCode = $request->get('nationalCode');
		$customer_id = $request->get('id');



	$databaseController->update_delivery($customer_id, $firstName, $lastName, $nationalCode, $number);


        return $this->render('view/welcome.html.twig');
    }

     /**
	 * @Route("/removeDelivery")
	 *
	 * this function returns remove user page
	 * @return html file
	 */
    public function removeDelivery(Request $request)
    {
		$delivery_id = $request->get('id');
		echo $delivery_id;
    	$databaseController = new DatabaseController();
    	$databaseController->delete_delivery($delivery_id);
    	$records =  $databaseController->select_allDeliveries();
    	return $this->render('view/removeDelivery.html.twig', ['records' => $records]);
    }

    /**
	 * @Route("/addDelivery")
	 *
	 * @param $request is an object
	 * @return html file
	 */
    public function addDelivery(Request $request)
    {
    $databaseController = new DatabaseController();

    //geting phone number and text message from request that sent from our welcome page
	$number = $request->get('Number');
	$firstName = $request->get('firstName');
	$lastName = $request->get('lastName');
	$nationalCode = $request->get('nationalCode');

	$databaseController->insert_delivery($firstName, $lastName, $nationalCode, $number);

	       return $this->render('view/addDelivery.html.twig');
	}

	//******************************************************************************Order
	 /**
	 * @Route("/orderPage")
	 *
	 * this function returns add user page
	 * @return html file
	 */
    public function orderPage()
    {
    	$customer_records = array();
    	$delivery_records = array();
    	$address_records = array();
    	$menu_records = array();


    	$databaseController = new DatabaseController();
    	$customer_records =  $databaseController->select_allCustomers();
    	$delivery_records =  $databaseController->select_allDeliveries();
    	$menu_records =  $databaseController->select_allMenu();
    	$address_records =  $databaseController->select_allAddress();


        return $this->render('view/order.html.twig', ['customer_records' => $customer_records , 'delivery_records' => $delivery_records,
        	'menu_records' => $menu_records , 'address_records' => $address_records ]);
    }


        /**
	 * @Route("/order")
	 *
	 * @param $request is an object
	 * @return html file
	 */
    public function order(Request $request)
    {
    $databaseController = new DatabaseController();

    //geting phone number and text message from request that sent from our welcome page
    $customer_id = $request->get('customer_id');
    $address_id = $request->get('address_id');
    $delivery_id = $request->get('delivery_id');
    $totalPrice = 0;
    $name = 1;
    for ($x = 1; $x <= 6; $x++) {
	$food = $request->get($x);
	if($food != NULL)
	{
		$totalPrice += $databaseController->select_foodPrice($food);
	}
	}
	echo "totalPrice = ";
	//echo $totalPrice;

	$currentDate = date('Y-m-d');

    $databaseController->insert_order_factor($address_id, $customer_id, $delivery_id, $totalPrice, $currentDate);
    $factor_id = $databaseController->select_order_factor_id();
    for ($x = 1; $x <= 6; $x++) {
	$food = $request->get($x);
	if($food != NULL)
	{
		$price = $databaseController->select_foodPrice($food);
		$databaseController->insert_food_list($factor_id, $food, $price);
	}
	}

	// $databaseController->insert_customer($firstName, $lastName, $nationalCode, $number, $age);

	// $customer_id = $databaseController->select_customer_id($number);
	// $addressName = $request->get('addressName');
	// $address = $request->get('address');
	// $phone = $request->get('phone');

	// $databaseController->insert_address($addressName, $address, $phone, $customer_id);
	       return $this->render('view/welcome.html.twig');
	}




	//instants of DatabaseController class

	//call insert function and passing variables

	// $databaseController->insert_customer('hosein', 'beheshti', '56484', '09123273259', 20);
	// $databaseController->insert_address('home', 'hakimie', '02177000000', 1);
	// $databaseController->insert_delivery('aref', 'motamedi', '56484', '09000000000');
	// $databaseController->insert_order_factor(1, 1, NULL, '1220000', '2018-01-11');
	// $databaseController->insert_food_list(1, "hotdog" , '120000');
	// $databaseController->insert_menu("hotdog" , '120000');
	// $databaseController->insert_store("hypermarket");
	// $databaseController->insert_material_factor(1, "2000000", '2018-01-11');
	// $databaseController->insert_material_list(1, "tey" , "20000");

	// $databaseController->update_customer(1, 'ali', 'beheshti', '99', '09123273259', 23);
	// $databaseController->update_menu("hotdog", "10000");
	// $databaseController->update_store("hypermarket");
	// $databaseController->update_delivery(1, 'ali', 'beheshti', '99', '09123273259');

	// // $databaseController->delete_customer(1);
	// // $databaseController->delete_menu("hotdog");
	// // $databaseController->delete_delivery(1);

	// $databaseController->insert_order_factor(NULL, 1, NULL, '1120000', '2018-01-11');
	// $databaseController->insert_order_factor(NULL, 1, NULL, '1220000', '2018-01-11');
	// $databaseController->insert_order_factor(NULL, 1, NULL, '1220000', '2018-01-11');


	// echo $databaseController->select_totalPurchase(1);
	// echo $databaseController->select_favoriteFood(1);
	// echo $databaseController->select_totalDailySales('2018-01-11');
	// echo $databaseController->select_totalDailyPurchase('2018-01-11');
	// $databaseController->select_listOfDailySales('2018-01-11');
	// $databaseController->select_listOfDailyPurchase('2018-01-11');



       // return $this->render('view/1.html.twig' ,['topnumbers' => $topNumbers]);
   	
}
 ?>