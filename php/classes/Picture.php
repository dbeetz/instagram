<?php
namespace Edu\Cnm\Dbeets\InstagramDataDesign;

require_once("autoload.php");

/**
 * Example class modeled after the picture entity of Instagram
 *
 * This should successfully model some of the state variables that Instagram uses for it's picture posting processes.
 *
 * @author Devon Beets <dbeetzz@gmail.com>
 * @version 3.0.0
 **/
class Picture {
	use ValidateDate;
	/**
	 * id for this Picture; this is the primary key
	 * @var int $pictureId
	 **/
	private $pictureId;
	/**
	 * id for the user who posted the Picture; this is a foreign key
	 * @var int $pictureUserId
	 **/
	private $pictureUserId;
	/**
	 * caption provided by the user who posted the Picture
	 * @var string $pictureCaption
	 **/
	private $pictureCaption;
	/**
	 * path of the Picture posted
	 * @var string $picturePath
	 **/
	private $picturePath;
	/**
	 * time and date the Picture was taken, in a PHP DateTime object
	 * @var \DateTime $pictureTimestamp
	 **/
	private $pictureTimestamp;

	/**
	 * constructor for this Picture
	 *
	 * @param int|null $newPictureId id of this Picture or null if a new Picture
	 * @param int $newPictureUserId id of the User that posted this Picture
	 * @param string $newPictureCaption string containing the caption data the User posted with a new Picture
	 * @param \DateTime|string|null $newPictureTimestamp date and time Picture was posted or null if set to current date and time
	 * @param string $newPicturePath data containing the Picture
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (strings are too long, negative integers, etc.)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newPictureId = null, int $newPictureUserId, string $newPictureCaption, $newPictureTimestamp = null, string $newPicturePath) {
		try {
				$this->setPictureId($newPictureId);
				$this->setPictureUserId($newPictureUserId);
				$this->setPictureCaption($newPictureCaption);
				$this->setPictureTimestamp($newPictureTimestamp);
				$this->setPicturePath($newPicturePath);
		} catch(\InvalidArgumentException $invalidArgument) {
				//rethrow the exception to the caller
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0,$invalidArgument));
		} catch(\RangeException $range) {
				//rethrow the exception to the caller
				throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
				//rethrow the exception to the caller
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
				//rethrow the exception to the caller
				throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for picture id
	 *
	 * @return int|null value of picture id
	 **/
	public function getPictureId() {
			return($this->pictureId);
	}
	/**
	 * mutator function for picture id
	 *
	 * @param int|null $newPictureId value of new picture id
	 * @throws \RangeException if $newPictureId is not positive
	 * @throws \TypeError if $newPictureId is not an integer
	 **/
	public function setPictureId(int $newPictureId = null) {
			//if the picture id is null, this is a new picture without a mySQL assigned id (yet)
			if($newPictureId === null) {
					$this->pictureId = null;
					return;
			}

			//verify that the picture id is positive
			if ($newPictureId <= 0) {
					throw(new \RangeException("picture id is not positive"));
			}

			//convert and store the picture id
			$this->pictureId = $newPictureId;
	}
	/**
	 * accessor method for picture user id
	 *
	 * @return int|null $newPictureUserId value of new user picture id
	 **/
	public function getPictureUserId() {
		return($this->pictureUserId);
	}
	/**
	 * mutator method for picture user id
	 *
	 * @param int|null $newPictureUserId value of new picture user id
	 * @throws \RangeException if new picture user id is not positive
	 * @throws \TypeError if new picture user id is not an integer
	 **/
	public function setPictureUserId(int $newPictureUserId = null) {
		//if the picture user id is null, this is a new picture user id without a mySQL assigned id (yet)
		if($newPictureUserId === null) {
			$this->pictureUserId = null;
			return;
		}

		//verify that the picture user id is positive
		if($newPictureUserId <= 0) {
				throw(new \RangeException("picture user id is not positive"));
		}

		//convert and store the picture user id
		$this->pictureUserId = $newPictureUserId;
	}
	/**
	 * accessor method for picture caption
	 *
	 * @return string value of picture caption conten
	 **/
	public function getPictureCaption() {
		return($this->pictureCaption);
	}
	/**
	 * mutator method for picture caption
	 *
	 * @param string $newPictureCaption new value of picture caption
	 * @throws \InvalidArgumentException if $newPictureCaption is not a string or insecure
	 * @throws \RangeException if $newPictureCaption is > 100 characters
	 * @throws \TypeError if $newPictureCaption is not a string
	 **/
	public function setPictureCaption(string $newPictureCaption) {
		//verify the picture caption is secure
		$newPictureCaption = trim($newPictureCaption);
		$newPictureCaption = filter_var($newPictureCaption, FILTER_SANITIZE_STRING);
		if(empty($newPictureCaption) === true) {
				throw (new \InvalidArgumentException("picture caption is empty or insecure"));
		}

		//verify the picture caption will fit in the database
		if(strlen($newPictureCaption) > 100) {
				throw (new \RangeException("picture caption is too large"));
		}

		//store the picture caption
		$this->pictureCaption = $newPictureCaption;
	}
	/**
	 * accessor method for picture timestamp
	 *
	 * @return \DateTime value for picture timestamp
	 **/
	public function getPictureTimestamp() {
		return($this->pictureTimestamp);
	}
	/**
	 * mutator method for picture timestamp
	 *
	 * @param \DateTime|string|null $newPictureTimestamp picture timestamp as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPictureTimestamp is not a valid object or a string
	 * @throws \RangeException if $newPictureTimestamp is a date that does not exist
	 **/
	public function setPictureTimestamp($newPictureTimestamp = null) {
		//base case: if the date is null, use the current date and time
		if($newPictureTimestamp === null) {
			$this->pictureTimestamp = new \DateTime();
			return;
		}

		//store the picture date
		try {
				$newPictureTimestamp = self::validateDateTime($newPictureTimestamp);
		} catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
				throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->pictureTimestamp = $newPictureTimestamp;
	}
	/**
	 * accessor method for picture path
	 *
	 * @return string value of picture path
	 **/
	public function getPicturePath() {
		return($this->pictureCaption);
	}
	/**
	 * mutator method for picture path
	 *
	 * @param string $newPicturePath new value of picture path
	 * @throws \InvalidArgumentException if $newPicturePath is not a string or insecure
	 * @throws \RangeException if $newPicturePath is > 255 characters
	 * @throws \TypeError if $newPicturePath is not a string
	 **/
	public function setPicturePath(string $newPicturePath) {
		//verify the picture path is secure
		$newPicturePath = trim($newPicturePath);
		$newPicturePath = filter_var($newPicturePath, FILTER_SANITIZE_STRING);
		if(empty($newPicturePath) === true) {
			throw(new \InvalidArgumentException("picture path is empty or insecure"));
		}

		//verify the picture path will fit in the database
		if(strlen($newPicturePath) > 255) {
			throw(new \RangeException("picture path is too large"));
		}

		//store the picture path
		$this->picturePath = $newPicturePath;
	}
	/**
	 * inserts this picture in mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce the picture id is null (i.e. don't insert a picture that already exists)
		if($this->pictureId !== null) {
				throw(new \PDOException("not a new picture"));
		}

		//create query template
		$query = "INSERT INTO picture(pictureUserId, pictureCaption, picturePath, pictureTimestamp) VALUES(:pictureUserId, :pictureCaption, :picturePath, :pictureTimestamp)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->pictureTimestamp->format("Y-m-d H:i:s");
		$parameters = ["pictureUserId" => $this->pictureUserId, "pictureCaption" => $this->pictureCaption, "picturePath" => $this->picturePath,  "pictureTimestamp" => $formattedDate];
		$statement->execute($parameters);

		//update the null pictureId with what mySQL just gave us
		$this->pictureId = intval($pdo->lastInsertId());
		}
	/**
	 * deletes this picture in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//enforce that the pictureId is not null (i.e. don't delete a picture that hasn't been inserted)
		if($this->pictureId === null) {
				throw(new \PDOException("unable to delete a picture that does not exist"));
		}
		//create query template
		$query = "DELETE FROM picture WHERE pictureId = :pictureId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["pictureId" => $this->pictureId];
		$statement->execute($parameters);
	}
	/**
	 * updates this picture in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//enforce the pictureId is not null (i.e. don't update a picture that hasn't been inserted)
		if($this->pictureId === null) {
				throw(new \PDOException("unable to update a picture that does not exist"));
		}
		//create query template
		$query = "UPDATE picture SET pictureUserId = :pictureUserId, pictureCaption = :pictureCaption, picturePath = :picturePath, pictureTimestamp = :pictureTimestamp WHERE pictureId = :pictureId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in the template
		$formattedDate = $this->pictureTimestamp->format("Y-m-d H:i:s");
		$parameters = ["pictureUserId" => $this->pictureUserId, "pictureCaption" => $this->pictureCaption, "picturePath" => $this->picturePath, "pictureTimestamp" => $formattedDate, "pictureId" => $this->pictureId];
		$statement->execute($parameters);
	}
	/**
	 * gets the Picture by caption
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $pictureCaption picture caption to search for
	 * @return \SplFixedArray SplFixedArray of pictures found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPictureByPictureCaption(\PDO $pdo, string $pictureCaption) {
		//sanitize the description before searching
		$pictureCaption = trim($pictureCaption);
		$pictureCaption = filter_var($pictureCaption, FILTER_SANITIZE_STRING);
		if(empty($pictureCaption) === true) {
			throw(new \PDOException("picture caption is invalid"));
		}

		//create query template
		$query = "SELECT pictureId, pictureUserId, pictureCaption, pictureTimestamp, pictureTimestamp FROM picture WHERE pictureCaption LIKE :pictureCaption";
		$statement = $pdo->prepare($query);

		//bind the picture caption to the placeholder in the template
		$pictureCaption = "%$pictureCaption%";
		$parameters = ["pictureCaption" => $pictureCaption];
		$statement->execute($parameters);

		//build an array of pictures
		$pictures = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
					$picture = new Picture($row["pictureId"], $row["pictureUserId"], $row["pictureCaption"], $row["picturePath"], $row["pictureTimestamp"]);
					$pictures[$pictures->key()] = $picture;
					$pictures->next();
			} catch(\Exception $exception) {
					//if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($pictures);
	}
	/**
	 * gets the picture by user id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $pictureUserId user id to search by
	 * @return \SplFixedArray SplFixedArray of pictures found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPictureByPictureUserId(\PDO $pdo, int $pictureUserId) {
		//sanitize the user id before searching
		if($pictureUserId <= 0) {
				throw(new \RangeException("picture user id must be positive"));
		}

		//create query template
		$query = "SELECT pictureId, pictureUserId, pictureCaption, picturePath, pictureTimestamp FROM picture WHERE pictureUserId = :pictureUserId";
		$statement = $pdo->prepare($query);

		//bind the picture user id to the placeholder in the template
		$parameters = ["pictureUserId" => $pictureUserId];
		$statement->execute($parameters);

		//build an array of pictures
		$pictures = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
				try{
					$picture = new Picture($row["pictureId"], $row["pictureUserId"], $row["pictureCaption"], $row["picturePath"], $row["pictureTimestamp"]);
					$pictures[$pictures->key()] = $picture;
					$pictures->next();
				} catch(\Exception $exception) {
					//if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
		}
		return($pictures);
	}
	/**
	 * gets all pictures
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Pictures found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllPictures(\PDO $pdo) {
		//create query template
		$query = "SELECT pictureId, pictureUserId, pictureCaption, picturePath, pictureTimestamp FROM picture";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of pictures
		$pictures = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
				try {
					$picture = new Picture($row["pictureId"], $row["pictureUserId"], $row["pictureCaption"], $row["picturePath"], $row["pictureTimestamp"]);
					$pictures[$pictures->key()] = $picture;
					$pictures->next();
				} catch(\Exception $exception) {
					//if the row could not be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
		}
		return($pictures);
	}
}
