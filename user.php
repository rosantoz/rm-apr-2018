<?


class User{

	public $db;

	private $states = [
		'NSW',
		'ACT',
		'VIC',
		'QLD',
		'TAS',
		'WA'
	]

	function __construct()
	{
		$this->db = new mysqli('127.0.0.1', 'root', 'password', 'users');

	}

	function check_Postcode($postcode) {
		//.... call some external api
		$res = external_api_call();
		if (!$res) {
			throw new \Exception("invalid post code");
		}
		return true;
	}


	function register($name, $password, $email, $phone = null, $postal_address = null, $postalState = null
			, $billing_address = null, $billingState = null)
	{
		global $validator;

		//check for an existing account
		$q = "SELECT * FROM user WHERE email = '$email'";
		$result = $this->db->query($q);
		while ($row = $result->fetch_assoc()) {
		    if ($row['email'] == $email) {
		    	return false;
		    }
		}

		//Check for valid postal and billing states
		$found = false;
		foreach ($this->states as $s) {
			if ($s == $postalState) {
				$found = true;
			}
		}
		if (!$found) {
			throw \Exception('Invalid state');
		}

		$found = false;
		foreach ($this->states as $s) {
			if ($s == $billingState) {
				$found = true;
			}
		}
		if (!$found) {
			throw \Exception('Invalid state');
		}

		//run additional validation checks
		check_Postcode($postal_address);
		check_Postcode($billing_address);
		$validator->checkEmail($email);

		//insert user record
		mysqli_query($this->db, "INSERT INTO user (name, password, email) VALUES ($name, $password, $email)") or die(mysqli_error($this->db));

		$userId = $this->db->insert_id;
		
		//insert address records
		$res = mysqli_query($this->db, "INSERT INTO address (address, state, user_id) VALUES ($postal_address, $postalState, $userId)");
		if (!$res) {
			//delete record because we failed to insert address
			mysqli_query($this->db, "DELETE FROM user WHERE id = $userId");
		}

		$res = mysqli_query($this->db, "INSERT INTO address (address, state, user_id) VALUES ($billing_address, $billingState, $userId)");
		if (!$res) {
			//delete record because we failed to insert address
			mysqli_query($this->db, "DELETE FROM user WHERE id = $userId");
		}

		return $userId;

	}


}


$user = new User();
$id = $user->register($_POST["name"], $_POST["password"], $_POST["email"], null
		, $_POST["postal_address"], $_POST["postal_state"], $_POST["billing_address"], $_POST["billing_state"]);
if (!$id) {
	echo "There was an error";
}

echo "Welcome {$_POST["name"]}!";


