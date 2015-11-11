<?php
/**
 * Trail Quail user class -- this is where user information is stored
 * This is part of the Trail Quail web application.  This feature will determine who the registered users
 * are and what level of access they have.  It will also store the userId, the user's name, their email address,
 * their browsing information, and datetime stamp when their account was set up.
 *
 * author Jeff Saul <scaleup13@gmail.com>
 */
Class user  {
	/**
	 * user Id is an unsigned integer; this is the primary key for class user
	 * @var integer $userId
	 */
	private $userId;

	/**
	 * This indicates what type of account and what type of access each user has
	 * @var string $userAccountType
	 */
	private $userAccountType;

	/**
	 * This is the user's email address
	 * @var string $userEmail
	 */
	private $userEmail;

	/**
	 * This is the 128 byte hash variable for user authentication
	 * @var string $userHash
	 */
	private $userHash;

	/**
	 * This is the user's username
	 * @var string $userName
	 */
	private $userName;

	/**
	 * This is the 64 byte salt variable for user authentication
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 * Constructor for user information storage
	 * This set of methods will check the input data for each user
	 *
	 * @param mixed $newUserId -- id of this user is null if they are a new user
	 * @param string $newUserAccountType -- string containing the type of user account
	 * @param string $newUserEmail -- string containing the user's email address
	 * @param string $newUserHash -- string containing hash
	 * @param string $newUserName -- string containing username
	 * @param string $newUserSalt -- string containing salt
	 *
	 * @throws invalidArgumentException if data types are not valid
	 * @throws rangeException if data values are out of bounds (e.g. strings too long or too short)
	 * @throws Exception if some other exception is thrown
	 */
	public function _construct($newUserId, $newUserAccountType, $newUserEmail, $newUserHash, $newUserName, $newUserSalt = null) {
		try {
			$this->setUserID($newUserId);
			$this->setUserAccountType($newUserAccountType);
			$this->setUserEmail($newUserEmail);
			$this->setUserHash($newUserHash);
			$this->setUserName($newUserName);
			$this->setUserSalt($newUserSalt);
		} catch(InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			// rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0,$range));
		} catch(Exception $exception) {
			// rethrow generic exception 
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * These are the data validation accessors and mutators for user
	 */

	/**
	 * accessor method for user id
	 *
	 * @return mixed value of user id
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * mutator method for user id
	 *
	 * @param mixed $newUserId new value of user id
	 * @throws InvalidArgumentException if $newUserId is not an integer
	 * @throws RangeException if $newUserId is not positive
	 */
	public function setUserId($newUserId) {
		//  base case:  if the user id is null, this a new user without a mySQL assigned id at this time
		if($newUserId === null) {
			$this->userId = null;
			return;
		}

		// verify that the user id is an integer
		$newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
		if($newUserId === false) {
			throw(new InvalidArgumentException("user id is not a valid integer"));
		}

		// verify that the user id is positive
		if($newUserId <= 0) {
			throw(new RangeException("user id is not positive"));
		}
	}
	/**
	 * accessor method for user account type (regular-r, poweruser-p, suspended-x)
	 *
	 * @return string $newUserAccountType - 1 byte string value of user account type
	 */
	public function getUserAccountType($newUserAccountType) {
		return ($this->UserAccountType);
		}

	/**
	 * mutator method for user account type (regular-r, power user-p, suspended-x)
	 *
	 * @param string $newUserAccountType - 1 byte string value of user account type
	 * @throws InvalidArgumentException if $newUserAccountType is not a string or is insecure
	 * @throws RangeException if $newUserAccountType is > 1 character
	 */
	public function setUserAccountType($newUserAccountType) {
		// verify that the user account type is secure
		$newUserAccountType = trim($newUserAccountType);
		$newUserAccountType = filter_var($newUserAccountType, FILTER_SANITIZE_STRING);
		if(empty($newUserAccountType) === true) {
			throw(new InvalidArgumentException("User account type is empty or insecure"));
		}

		// verify the user account type will fit in the database
		if(strlen($newUserAccountType) > 1) {
			throw(new RangeException("User account type is too large"));
		}

		//store user account type
		$this->userAccountType = $newUserAccountType;
	}

}