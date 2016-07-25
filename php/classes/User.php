<?php
namespace Edu\Cnm\dbeets\InstagramDataDesign;

/**
* accessor method for user id
*
* @return int|null value of user id
**/
public function getUserId() {
	return($this->userId);
}

/**
 * mutator method for user id
 *
 * @param int|null $newUserId new value of user id
 * @throws \RangeException if $newUserId is not positive
 * @throws \TypeError if $newUserId is not an integer
 **/
public function setUserId(int $newUserId = null) {
	// if the user id is null, this is a new user id
	if(newUserId === null) {
		$this-> userId = null;
		return;
	}
	// verify that the user id is positive
	if(newUserId <= 0) {
		throw(new \RangeException("user id is not positive"));
	}
	// assign the new user id
	$this->userId = $newUserId;
}
